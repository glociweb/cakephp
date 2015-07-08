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
 * Phases Controller
 *
 * @property Phase $Phase
 */
class PhasesController extends AppController
{

    /**
     * Holds this controller's name
     * @var string 
     */
    public $name = 'Phases';

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add($project_id = null)
    {
        if (!$this->Phase->Project->exists($project_id))
        {
            throw new NotFoundException(__('No project was passed'));
        }

        $project = $this->Phase->Project->find('first', array(
            'conditions' => array('Project.id' => $project_id),
            'contain' => array('Phase' => array('order' => 'Phase.position DESC', 'limit' => 1))
        ));

        if ($this->request->is('post'))
        {
            $this->request->data['Phase']['project_id'] = $project_id;
            $this->Phase->create();
            if ($this->Phase->save($this->request->data))
            {
                $this->Session->setFlash(__('The phase has been saved'), Flash::Success);
                if (isset($this->request->data['add_new']))
                    $this->redirect(array('controller' => 'phases', 'action' => 'add', $project_id));

                $this->redirect(array('controller' => 'projects', 'action' => 'view', $project_id));
            } else
            {
                $this->Session->setFlash(__('The phase could not be saved. Please, try again.'));
            }
        }
        else
        {
            $this->request->data['Phase']['date_start'] = date('Y-m-d');
            $this->request->data['Phase']['date_end'] = date('Y-m-d', strtotime('+1 day'));

            if (!empty($project['Phase']))
            {
                $this->set('previousPhase', $project['Phase'][0]);
                $this->request->data['Phase']['date_start'] = date('Y-m-d', strtotime(date('Y-m-d H:i:s', strtotime($project['Phase'][0]['date_end'])) . ' +1 day'));
                $this->request->data['Phase']['date_end'] = date('Y-m-d', strtotime(date('Y-m-d H:i:s', strtotime($this->request->data['Phase']['date_start'])) . ' +1 day'));
            }
        }



        $this->set(compact('project'));
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
        $this->Phase->id = $id;
        if (!$this->Phase->exists())
        {
            throw new NotFoundException(__('Invalid phase'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->Phase->save($this->request->data))
            {
                $this->Session->setFlash(__('The phase has been saved'), Flash::Success);
                $this->redirect(array('controller' => 'projects', 'action' => 'phase', $this->Phase->field('slug'), 'admin' => false));
            }
            else
            {
                $this->Session->setFlash(__('The phase could not be saved. Please, try again.'));
            }
        }
        else
        {
            App::import('Utility', 'CakeTime');
            $this->request->data = $this->Phase->read(null, $id);
            $this->request->data['Phase']['date_start'] = CakeTime::format($this->request->data['Phase']['date_start'], '%Y-%m-%d');
            $this->request->data['Phase']['date_end'] = CakeTime::format($this->request->data['Phase']['date_end'], '%Y-%m-%d');
        }
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
        $this->Phase->id = $id;
        if (!$this->Phase->exists())
        {
            throw new NotFoundException(__('Invalid phase'));
        }
        if ($this->Phase->delete())
        {
            $this->Session->setFlash(__('Phase deleted'));
            $this->redirect(array('controller' => 'projects', 'action' => 'index'));
        }
        $this->Session->setFlash(__('Phase was not deleted'));
        $this->redirect($this->referer());
    }

    /**
     * Updates a phase's percentage progress
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     */
    public function update_progress()
    {
        if (!$this->request->is('post') || !isset($this->request->data['Phase']['id']) || !isset($this->request->data['Phase']['percent_completed']))
        {
            throw new MethodNotAllowedException();
        }

        $this->Phase->id = $this->request->data['Phase']['id'];
        if (!$this->Phase->exists())
        {
            throw new NotFoundException(__('Invalid phase'));
        }

        $old = $this->Phase->field('percent_completed');
        if ($this->Phase->save(array(
                    'id' => $this->request->data['Phase']['id'],
                    'percent_completed' => $this->request->data['Phase']['percent_completed'])))
        {
            $this->Session->setFlash(__('Progress update succesful'), Flash::Success);

            if ($this->request->data['Phase']['send_activity'] === '1')
            {
                $new = $this->request->data['Phase']['percent_completed'];

                $this->__sendProgressUpdate($this->request->data['Phase']['id'], $old, $new);
            }
        }
        else
            $this->Session->setFlash(__('Progress update not successful: please try again'), Flash::Error);

        $this->redirect($this->referer('/'));
    }

    private function __sendProgressUpdate($phase_id = null, $old = null, $new = null)
    {
        $metadata = $this->Phase->getMetaDataForActivityEmail($phase_id);

        $emailBody = AppConfig::read('Email.progressactivity_text');
        $emailSubject = AppConfig::read('Email.activity_subject');

        $replacementMap = array(
            '{ProjectName}' => $metadata['Project']['title'],
            '{ProjectUrl}' => Router::url(array('controller' => 'projects', 'action' => 'dashboard', $metadata['Project']['slug'], 'admin' => false), true),
            '{PhaseName}' => $metadata['Phase']['title'],
            '{PhaseUrl}' => Router::url(array('controller' => 'projects', 'action' => 'phase', $metadata['Phase']['slug'], 'admin' => false), true),
            '{User}' => AppAuth::user('username'),
            '{OldPercentage}' => $old,
            '{NewPercentage}' => $new,
            '{SystemName}' => AppConfig::read('System.name')
        );

        foreach ($replacementMap as $placeholder => $replacement)
            $emailBody = str_replace($placeholder, $replacement, $emailBody);

        $emailContents = array();

        foreach ($metadata['User'] as $recipient)
        {
            $email = $emailBody;
            $email = str_replace('{UserName}', $recipient['username'], $email);

            $emailContents[] = array(
                'User' => $recipient,
                'Email' => $email
            );
        }

        foreach ($emailContents as $sendMail)
        {
            $email = AppLib::prepareEmail();

            $email->to($sendMail['User']['email'], $sendMail['User']['username'])
                    ->subject($emailSubject)
                    ->send($sendMail['Email']);
        }
    }

    /**
     * Moves the passed phase one position up
     * @param string $id Id of the phase
     */
    public function admin_moveup($id = null)
    {
        if (Configure::read('demo') === true)
        {
            AppController::$demoBlocked = true;
            $this->redirect($this->referer());
        }

        $this->Phase->moveHigher($id);
        $this->redirect($this->referer());
    }

    /**
     * Moves the passed phase one position down
     * @param string $id Id of the phase
     */
    public function admin_movedown($id = null)
    {
        if (Configure::read('demo') === true)
        {
            AppController::$demoBlocked = true;
            $this->redirect($this->referer());
        }

        $this->Phase->moveLower($id);
        $this->redirect($this->referer());
    }

}