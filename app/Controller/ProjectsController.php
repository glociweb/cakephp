<?php

/**
 * 
 * ClientEngage: ClientEngage Project Platform (http://www.clientengage.com)
 * Copyright 2012, ClientEngage (http://www.clientengage.com)
 *
 * You must have purchased a valid license from CodeCanyon in order to have 
 * the permission to use this file.
 * 
 * You may only use this file according to the respective licensing terms 
 * you agreed to when purchasing this item on CodeCanyon.
 * 
 * 
 * 
 *
 * @author          ClientEngage <contact@clientengage.com>
 * @copyright       Copyright 2012, ClientEngage (http://www.clientengage.com)
 * @link            http://www.clientengage.com ClientEngage
 * @since           ClientEngage - Project Platform v 1.0
 * 
 */
App::uses('AppController', 'Controller');

/**
 * Projects Controller
 *
 * @property Project $Project
 * @property Project $ProjectsUser
 * @property Client $Client
 */
class ProjectsController extends AppController
{

    /**
     * Holds this controller's name
     * @var string 
     */
    public $name = 'Projects';

    /**
     * Handles the authorisation logic
     * @param array $user The user to authorise
     * @return boolean Whether the user is authorised
     */
    public function isAuthorized($user = array())
    {
        if (AppAuth::is(UserRoles::Admin))
            return true;

        $action = $this->request->params['action'];

        switch ($action)
        {
            case 'phase':
            case 'history':
                return $this->Project->Phase->hasAccess($user, $this->request->params['pass'][0]);
                break;
            case 'dashboard':
                return $this->Project->hasAccess($user, $this->request->params['pass'][0]);
                break;
        }

        return parent::isAuthorized($user);
    }

    /**
     * Renders the individual phase display
     * @param string $phase_slug Slug of the phase to be displayed
     */
    public function phase($phase_slug = null)
    {
        $this->layout = 'project';

        $project = $this->Project->getPhase($phase_slug);
		//echo "<pre>";print_r($project);die;
        if (!$project)
        {
            $this->Session->setFlash(__('This phase does not exist'), Flash::Error);
            $this->redirect(array('action' => 'index'));
        }

        $this->set('title_for_layout', String::insert(__('Phase :phase_num: :phase_title'), array('phase_num' => $project['Phase']['position'], 'phase_title' => $project['Phase']['title'])));
        $this->set(compact('project'));
    }

    /**
     * Renders the notification history of the passed phase
     * @param string $phase_slug Slug of the phase
     */
    public function history($phase_slug = null)
    {
        $this->layout = 'project';

        $project = $this->Project->Phase->find('first', array(
            'conditions' => array('Phase.slug' => $phase_slug),
            'contain' => array(
                'Project' => array(
                    'Phase' => array(
                        'fields' => array('id', 'slug', 'title', 'description', 'date_start', 'date_end', 'percent_completed', 'position'),
                    )
        ))));

        $this->paginate['Notification'] = array('order' => 'Notification.created DESC', 'conditions' => array('Notification.phase_id' => $project['Phase']['id']), 'contain' => array('User', 'Phase'));
        $notifications = $this->paginate('Notification');

        if (!$project)
        {
            $this->Session->setFlash(__('This phase does not exist'), Flash::Error);
            $this->redirect(array('action' => 'index'));
        }

        $this->set('title_for_layout', String::insert(__('Phase :phase_num: :phase_title'), array('phase_num' => $project['Phase']['position'], 'phase_title' => $project['Phase']['title'])));
        $this->set(compact('project', 'notifications'));
    }

    /**
     * Renders the passed project's dashboard overview
     * @param string $project_slug The project's slug
     */
    public function dashboard($project_slug = null)
    {
        $this->layout = 'project';

        $project = $this->Project->getDashboard($project_slug);

        $this->paginate['Notification'] = array('order' => 'Notification.created DESC', 'conditions' => array('Notification.project_id' => $project['Project']['id']), 'contain' => array('User', 'Phase'));
        $notifications = $this->paginate('Notification');

        if (!$project)
        {
            $this->Session->setFlash(__('This project does not exist'), Flash::Error);
            $this->redirect(array('action' => 'index'));
        }

        $project['Project']['Phase'] = $project['Phase'];
        unset($project['Phase']);

        $this->set('title_for_layout', $project['Project']['title']);
        $this->set(compact('project', 'notifications'));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        if (empty($this->request->params['named']))
        {
            $this->redirect(array('action' => 'index', 'sort' => 'created', 'direction' => 'desc'));
        }

        $conditions = array('Project.archived' => false);

        if (isset($this->request->params['named']['archived']) && $this->request->params['named']['archived'] == true)
            $conditions = array();

        $this->paginate['Project'] = array(
            'conditions' => $conditions,
            'contain' => array(
                'Notification' => array(
                    'User',
                    'order' => 'Notification.created DESC',
                    'limit' => 5
                ),
                'Client', 'Phase', 'User' => array('fields' => array('id', 'username'))));

        $projects = $this->paginate('Project');
        foreach ($projects as &$project)
        {
            if (isset($project['Project']))
                foreach ($project['Project'] as $k => $v)
                    $project[$k] = $v;
            unset($project['Project']);
        }

        $this->set('projects', $projects);
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->layout = 'system_front';

        if (AppAuth::is(UserRoles::Admin))
            $this->redirect(array('controller' => 'projects', 'action' => 'index', 'admin' => true));

        $this->set('title_for_layout', __('Project Overview'));
        $this->set('overview', $this->Project->getUserProjects());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {
        $this->Project->id = $id;
        if (!$this->Project->exists())
        {
            throw new NotFoundException(__('Invalid project'));
        }
        $project = $this->Project->find('first', array(
            'conditions' => array('Project.id' => $id),
            'contain' => array('Client', 'Phase','Notes')));
            
        $this->set('project', $project);
    }

    /**
     * Sends-out formatted invitation emails for the passed project
     * @param string $id The project's Id
     * @throws NotFoundException
     */
    public function admin_prepareinvitation($id = null)
    {
        $this->Project->id = $id;
        if (!$this->Project->exists())
        {
            throw new NotFoundException(__('Invalid project'));
        }
        $project = $this->Project->find('first', array(
            'conditions' => array('Project.id' => $id),
            'contain' => array('Client' => 'User')));

        if ($this->request->is('post'))
        {
            if ($this->__sendInvitations($project, $this->request->data['Invitation']))
            {
                $this->Session->setFlash(__('The invitations were successfully sent.'), Flash::Success);
                $this->redirect(array('action' => 'view', $id));
            }
            else
            {
                $this->Session->setFlash(__('An error occured whilst sending the invitations. Please try again.'), Flash::Error);
            }
        }
        else
        {
            $this->request->data['Invitation']['body'] = AppConfig::read('Email.invitationtext_text');
            $this->request->data['Invitation']['subject'] = AppConfig::read('Email.invitationsubject');
        }

        $this->set('project', $project);
    }

    /**
     * Internally handles the email delivery
     * @param array $project
     * @param array $invitation
     * @return boolean Whether the send operation was successfull
     */
    private function __sendInvitations($project = null, $invitation = array())
    {
        if (Configure::read('demo') === true)
        {
            parent::$demoBlocked = true;
            return false;
        }
        if (!isset($invitation['body']) || !isset($invitation['subject']) || empty($invitation['recipients']))
        {
            return false;
        }

        $recipients = ClassRegistry::init('User')->find('all', array('conditions' => array('User.id' => $invitation['recipients'])));
        if (!$recipients)
            return false;

        $replacementMap = array(
            '{ProjectName}' => $project['Project']['title'],
            '{ProjectUrl}' => Router::url(array('controller' => 'projects', 'action' => 'dashboard', $project['Project']['slug'], 'admin' => false), true),
            '{SystemName}' => AppConfig::read('System.name')
        );
        foreach ($replacementMap as $placeholder => $replacement)
            $invitation['body'] = str_replace($placeholder, $replacement, $invitation['body']);

        $emailContents = array();

        foreach ($recipients as $recipient)
        {
            $email = $invitation['body'];
            $userReplacements = array(
                '{UserName}' => 'username',
                '{UserEmail}' => 'email',
                '{TempPassword}' => 'temp_password',
            );
            foreach ($userReplacements as $placeholder => $replacement)
                $email = str_replace($placeholder, $recipient['User'][$replacement], $email);

            $email = $this->__stripConditionalInvitationTag($recipient, $email);

            $emailContents[] = array(
                'User' => $recipient['User'],
                'Email' => $email
            );
        }

        foreach ($emailContents as $sendMail)
        {
            $email = AppLib::prepareEmail();

            $email->to($sendMail['User']['email'], $sendMail['User']['username'])
                    ->subject($invitation['subject'])
                    ->send($sendMail['Email']);
        }

        return true;
    }

    /**
     * Handles the conditional tags within the email
     * @param type $recipient
     * @param string $email The email's content before
     * @return string The email's content with inserted placeholders
     */
    private function __stripConditionalInvitationTag($recipient = array(), $email = '')
    {
        if (substr_count($email, '{StartIsNewUser}') != 1 || substr_count($email, '{EndIsNewUser}') != 1)
            return $email;

        if (trim($recipient['User']['temp_password'] != ''))
        {
            $email = str_replace('{StartIsNewUser}', '', $email);
            $email = str_replace('{EndIsNewUser}', '', $email);
            return $email;
        }
        else
        {
            if (strpos($email, '{StartIsNewUser}') < strpos($email, '{EndIsNewUser}'))
            {
                $part1 = substr($email, 0, strpos($email, '{StartIsNewUser}'));
                $part2 = substr($email, strpos($email, '{EndIsNewUser}') + strlen('{EndIsNewUser}'));
                return $part1 . $part2;
            }
            return $email;
        }
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post'))
        {
            $this->Project->create();
            if ($this->Project->save($this->request->data))
            {
                $this->Session->setFlash(__('The project has been saved'), Flash::Success);
                $this->redirect(array('action' => 'view', $this->Project->id));
            }
            else
            {
                $this->Session->setFlash(__('The project could not be saved. Please, try again.'));
            }
        }
        $clients = $this->Project->Client->find('list');
        $this->set(compact('clients'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        $this->Project->id = $id;
        if (!$this->Project->exists())
        {
            throw new NotFoundException(__('Invalid project'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->Project->save($this->request->data))
            {
                $this->Session->setFlash(__('The project has been saved'), Flash::Success);
                $this->redirect(array('action' => 'view', $id));
            }
            else
            {
                $this->Session->setFlash(__('The project could not be saved. Please, try again.'));
            }
        }
        else
        {
            $this->Project->recursive = 1;
            $this->request->data = $this->Project->read(null, $id);
        }
        $clients = $this->Project->Client->find('list');
        $this->set(compact('clients'));
    }

    /**
     * admin_delete method
     *
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null)
    {
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        $this->Project->id = $id;
        if (!$this->Project->exists())
        {
            throw new NotFoundException(__('Invalid project'));
        }
        if ($this->Project->delete())
        {
            $this->Session->setFlash(__('Project deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Project was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function admin_duplicate($project_id = null)
    {
        if ($this->Project->duplicate($project_id))
        {
            $this->Session->setFlash(__('The project was successfully duplicated.', Flash::Success));
            $this->redirect(array('action' => 'view', $this->Project->id));
        }
        else
        {
            $this->Session->setFlash(__('The project could not be duplicated.', Flash::Error));
            $this->redirect(array('action' => 'view', $project_id));
        }
    }

    public function admin_move($id = null)
    {
        $this->Project->id = $id;
        if (!$this->Project->exists())
        {
            throw new NotFoundException(__('Invalid project'));
        }

        $project = $this->Project->find('first', array(
            'conditions' => array('Project.id' => $id),
            'fields' => array('id', 'date_start', 'date_end'),
            'contain' => array('Phase.id', 'Phase.project_id', 'Phase.date_start', 'Phase.date_end')
        ));

        $this->set('project', $project);

        if ($this->request->is('post'))
        {

            $start = $this->request->data('Project.new_start');
            $end = $this->request->data('Project.new_end');

            if ((trim($start) != '' && trim($end) != '') || (trim($start) == '' && trim($end) == ''))
            {
                $this->Session->setFlash(__('When moving a project, you have to select either the new start date, OR the new end date.'), Flash::Error);
                return;
            }

            $delta = 0;

            if (trim($start) != '') // moving from start-date
            {
                $start = strtotime($start);
                $currentStart = strtotime($project['Project']['date_start']);

                $delta = $start - $currentStart;
            }
            else
            {
                $end = strtotime($end);
                $currentEnd = strtotime($project['Project']['date_end']);

                $delta = $end - $currentEnd;
            }

            App::import('Utility', 'CakeTime');
            $project['Project']['date_start'] = date('Y-m-d', strtotime($project['Project']['date_start']) + $delta);
            $project['Project']['date_end'] = date('Y-m-d', strtotime($project['Project']['date_end']) + $delta);

            foreach ($project['Phase'] as &$phase)
            {
                $phase['date_start'] = date('Y-m-d', strtotime($phase['date_start']) + $delta);
                $phase['date_end'] = date('Y-m-d', strtotime($phase['date_end']) + $delta);
            }


            if ($this->Project->saveAll($project))
            {
                $this->Session->setFlash(__('The project was moved successfully.'), Flash::Success);
                $this->redirect(array('action' => 'view', $id));
            }
            else
            {
                $this->Session->setFlash(__('An error occured whilst moving the project. Please try again'), Flash::Error);
            }
        }
    }

    /**
     * Accesses the Project model's getQuickLinks method
     * @return array
     */
    public function getQuickMenu()
    {
        if (empty($this->request->params['requested']))
        {
            throw new ForbiddenException();
        }
        return $this->Project->getQuickLinks((AppAuth::is(UserRoles::Admin) ? 'admin' : 'client'));
    }

    public function calendar()
    {
        $this->layout = 'system_front';
    }

    public function admin_calendar()
    {
        $this->render('calendar');
    }

    public function phasefeed()
    {
        $this->layout = 'ajax';
        $vars = $this->params['url'];
        App::uses('CakeTime', 'Utility');
        $start = CakeTime::format('Y-m-d H:i:s', date('Y-m-d H:i:s', $vars['start'] - (WEEK * 12)));
        $end = CakeTime::format('Y-m-d H:i:s', date('Y-m-d H:i:s', $vars['end'] + (WEEK * 12)));

        if (Configure::read('demo') === true)
        {
            $demoInstalled = strtotime('2012-07-14 15:02');
            $now = time();
            $diff = ($now - $demoInstalled);

            $start = date('Y-m-d H:i:s', strtotime($start) - $diff);
            $end = date('Y-m-d H:i:s', strtotime($end) - $diff);
        }

        $startsInWeek = array(
            'Phase.date_start >= ' => $start,
            'Phase.date_end <= ' => $end
        );

        $phases = $this->Project->Phase->getAllUserPhases($startsInWeek);
        $feed = array();
        foreach ($phases as $phase)
        {
            $feed[] = array(
                'id' => $phase['Phase']['id'],
                'title' => '<b>' . $phase['Project']['title'] . '</b>: ' . $phase['Phase']['title'],
                'start' => CakeTime::format('Y-m-d H:i:s', $phase['Phase']['date_start']),
                'end' => CakeTime::format('Y-m-d H:i:s', $phase['Phase']['date_end']),
                'allDay' => true,
                'url' => Router::url(array('controller' => 'projects', 'action' => 'phase', $phase['Phase']['slug']))
            );
        }

        $this->set('feed', $feed);
    }

    public function favourite($id = null)
    {
        if (!$this->request->is('post'))
        {
            throw new MethodNotAllowedException();
        }
        $this->Project->id = $id;
        if (!$this->Project->exists())
        {
            throw new NotFoundException(__('Invalid project'));
        }

        if (!isset($this->request->params['named']['type']))
            throw new InvalidArgumentException();

        if ($this->request->params['named']['type'] == 'remove')
        {
            if ($this->Project->ProjectsUser->deleteAll(array('ProjectsUser.project_id' => $id, 'ProjectsUser.user_id' => AppAuth::user('id')), true, true))
            {
                $this->Session->setFlash(__('You successfully removed the project from your favourites.'), Flash::Success);
            }
            else
            {
                $this->Session->setFlash(__('The project could not be removed from your favourites.'), Flash::Success);
            }
        }
        else
        {
            $newFavourite = array('ProjectsUser' => array(
                    'project_id' => $id,
                    'user_id' => AppAuth::user('id')
            ));
            $this->Project->ProjectsUser->create();
            if ($this->Project->ProjectsUser->save($newFavourite))
            {
                $this->Session->setFlash(__('You successfully added the project to your favourites.'), Flash::Success);
            }
            else
            {
                $this->Session->setFlash(__('The project could not be added to your favourites.'), Flash::Success);
            }
        }

        $this->redirect($this->referer());
    }

    public function getFavourites()
    {
        if (empty($this->request->params['requested']))
        {
            throw new ForbiddenException();
        }
        return $this->Project->getFavourites((AppAuth::is(UserRoles::Admin)));
    }

    public function search_suggestions()
    {
        $this->layout = 'ajax';
		$limit=5;
        $query = $this->request->data['Search']['query'];
        $results = $this->Project->search(trim($query), $limit);
		//print_r($results);
        $this->set('results', $results);
        $this->set('query', $query); 
        $this->set('limit', $limit);
    }
    public function searchall()
    {
        $this->layout = 'ajax';
		$limit='';
		$results=array();
        $query = $this->request->data['Search']['query'];
        $contain = $this->request->data['Search']['contain'];
        $results[$contain] = $this->Project->search(trim($query), $limit,$contain);
        $this->set('results', $results);
        $this->set('query', $query); 
        $this->set('limit', $limit);
    }
    
    public function searchresults($query)
    {
  
        $results = $this->Project->search(trim($query), '');
		//print_r($results);
        $this->set('results', $results);
        $this->set('query', $query);
    }

    public function search()
    {
        $this->layout = 'system_front';
        $this->set('error', false);
        $results = array();
        $query = '';

        if ($this->request->is('post'))
        {
            $query = $this->request->data['Search']['query'];

            if (strlen(trim($query)) > 1)
            {
                $results = $this->Project->search(trim($query), 15);
            }
            else
            {
                $this->set('error', true);
            }
        }
        $this->set('query', $query);
        $this->set('results', $results);
    }

    public function search_projects($query = '')
    {
        $this->layout = 'system_front';
        $this->set('error', false);
        $results = array();

        if (strlen(trim($query)) > 1)
        {
            $this->paginate = $this->Project->searchConditionsProject($query);
            $results = $this->paginate($this->Project);
        }
        else
        {
            $this->set('error', true);
        }

        $this->set('query', $query);
        $this->set('results', $results);
    }

    public function search_phases($query = '')
    {
        $this->layout = 'system_front';
        $this->set('error', false);
        $results = array();

        if (strlen(trim($query)) > 1)
        {
            $this->paginate = $this->Project->searchConditionsPhase($query);
            $results = $this->paginate($this->Project->Phase);
        }
        else
        {
            $this->set('error', true);
        }

        $this->set('query', $query);
        $this->set('results', $results);
    }

    public function search_comments($query = '')
    {
        $this->layout = 'system_front';
        $this->set('error', false);
        $results = array();

        if (strlen(trim($query)) > 1)
        {
            $this->paginate = $this->Project->searchConditionsComment($query);
            $results = $this->paginate($this->Project->Phase->Comment);
        }
        else
        {
            $this->set('error', true);
        }

        $this->set('query', $query);
        $this->set('results', $results);
    }

}
