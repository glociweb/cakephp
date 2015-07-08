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
 * Comments Controller
 *
 * @property Comment $Comment
 */
class CommentsController extends AppController
{

    /**
     * Holds this controller's name
     * @var string 
     */
    public $name = 'Comments';

    public function admin_index()
    {
        $conditions = array('Comment.needsaction' => true);

        if (!empty($this->request->params['named']['status']))
        {
            switch ($this->request->params['named']['status'])
            {
                case 'completed':
                    $conditions = Hash::merge($conditions, array('completed_date !=' => null));
                    break;
                case 'pending':
                    $conditions = Hash::merge($conditions, array('completed_date' => null));
                    break;
            }
        }

        $this->paginate['Comment'] = array(
            'contain' => array('User', 'Attachment', 'Phase'),
            'conditions' => $conditions
        );
        $this->set('comments', $this->paginate('Comment'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($phase_id = null, $parent_id = null)
    {
        $this->layout = 'system_front';

        if ($this->request->is('post'))
        {
            if ($phase_id !== null)
                $this->request->data['Comment']['phase_id'] = $phase_id;
            if ($parent_id !== null)
                $this->request->data['Comment']['parent_id'] = $parent_id;
            else
                $this->request->data['Comment']['parent_id'] = null;

            if (!isset($this->request->data['Comment']['phase_id']) || !array_key_exists('parent_id', $this->request->data['Comment']))
                throw new MethodNotAllowedException();

            $this->Comment->create();
       
            if ($this->Comment->saveAll($this->request->data))
            {
                $this->Session->setFlash(__('The comment has been saved'), Flash::Success);

                if ($this->request->data['Comment']['send_activity'] === '1')
                {
                    $this->__sendNewCommentUpdate($this->Comment->field('phase_id'), $this->Comment->id, $this->Comment->field('needsaction'));
                }

                $this->redirect($this->Comment->getCommentRedirectUrl());
            }
            else
            {
                $this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
            }
        }
    }

    private function __sendNewCommentUpdate($phase_id = null, $comment_id = null, $istask = null)
    {
        $metadata = $this->Comment->Phase->getMetaDataForActivityEmail($phase_id);

        $emailBody = AppConfig::read('Email.commentactivity_text');
        $emailSubject = AppConfig::read('Email.activity_subject');
		
		$comment = $this->Comment->findById($comment_id);

        $replacementMap = array(
            '{ProjectName}' => $metadata['Project']['title'],
            '{ProjectUrl}' => Router::url(array('controller' => 'projects', 'action' => 'dashboard', $metadata['Project']['slug'], 'admin' => false), true),
            '{PhaseName}' => $metadata['Phase']['title'],
            '{PhaseUrl}' => Router::url(array('controller' => 'projects', 'action' => 'phase', $metadata['Phase']['slug'], 'admin' => false), true),
            '{CommentUrl}' => Router::url(array('controller' => 'projects', 'action' => 'phase', $metadata['Phase']['slug'], '#' => $comment_id, 'admin' => false), true),
            '{User}' => AppAuth::user('username'),
            '{CommentType}' => $istask ? __('task') : __('comment'),
            '{SystemName}' => AppConfig::read('System.name'),
			'{CommentBody}' => strip_tags($comment['Comment']['content'])
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

    private function __sendTaskUpdate($phase_id = null, $comment_id = null, $completed = null)
    {
        $metadata = $this->Comment->Phase->getMetaDataForActivityEmail($phase_id);

        $emailBody = AppConfig::read('Email.taskactivity_text');
        $emailSubject = AppConfig::read('Email.activity_subject');

        $replacementMap = array(
            '{ProjectName}' => $metadata['Project']['title'],
            '{ProjectUrl}' => Router::url(array('controller' => 'projects', 'action' => 'dashboard', $metadata['Project']['slug'], 'admin' => false), true),
            '{PhaseName}' => $metadata['Phase']['title'],
            '{PhaseUrl}' => Router::url(array('controller' => 'projects', 'action' => 'phase', $metadata['Phase']['slug'], 'admin' => false), true),
            '{CommentUrl}' => Router::url(array('controller' => 'projects', 'action' => 'phase', $metadata['Phase']['slug'], '#' => $comment_id, 'admin' => false), true),
            '{User}' => AppAuth::user('username'),
            '{TaskStatus}' => $completed ? __('completed') : __('uncompleted'),
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

    private function _getValidationErrors()
    {
        $errors = array();

        foreach ($this->Comment->validationErrors as $field)
            foreach ($field as $error)
                $errors[] = $error;

        return $errors;
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
        $this->Comment->id = $id;
        if (!$this->Comment->exists())
        {
            throw new NotFoundException(__('Invalid comment'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->Comment->save($this->request->data))
            {

                if ($this->request->data['Comment']['send_activity'] === '1')
                {
                    $this->__sendNewCommentUpdate($this->Comment->field('phase_id'), $this->Comment->id, $this->Comment->field('needsaction'));
                }

                $this->Session->setFlash(__('The comment has been saved'), Flash::Success);

                $this->redirect($this->Comment->getCommentRedirectUrl());
            }
            else
            {
                $this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
            }
        }
        else
        {
            $this->request->data = $this->Comment->read(null, $id);
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
        $this->Comment->id = $id;
        $redirectUrl = $this->Comment->getCommentRedirectUrl();
        if (!$this->Comment->exists())
        {
            throw new NotFoundException(__('Invalid comment'));
        }
        if ($this->Comment->delete())
        {
            $this->Session->setFlash(__('Comment deleted'));
            $this->redirect($redirectUrl);
        }
        $this->Session->setFlash(__('Comment was not deleted'));
        $this->redirect($redirectUrl);
    }

    /**
     *  Changes a comment's/task's completed status
     */
    public function statuschange()
    {

        if (!$this->request->is('post') || !isset($this->request->data['Comment']['id']) || !isset($this->request->data['Comment']['set_completed']))
        {
            $this->Session->setFlash(__('The task status could not be updated'), Flash::Error);
        }
        else
        {
            $this->Comment->id = $this->request->data['Comment']['id'];
            $completedDate = null;
            $completedIp = null;

            $boolCompleted = false;

            if ($this->request->data['Comment']['set_completed'] == "true")
            {
                $boolCompleted = true;
                $completedDate = date('Y-m-d H:i:s');
                $completedIp = $this->request->clientIp(true);
            }
            $this->Comment->set(array(
                'completed_date' => $completedDate,
                'completed_ip' => $completedIp,
				'user_id' => $this->Comment->field('user_id'),
                'modified' => $this->Comment->field('modified')
            ));

            if ($this->Comment->save())
            {
                if ($this->request->data['Comment']['send_activity'] === '1')
                {
                    $this->__sendTaskUpdate($this->Comment->field('phase_id'), $this->Comment->id, $boolCompleted);
                }
                $this->Session->setFlash(__('The task status was updated'), Flash::Success);
            }
            else
                $this->Session->setFlash(__('The task status could not be updated'), Flash::Error);
        }



        $this->redirect($this->referer() . '#' . $this->Comment->id);
    }

}
