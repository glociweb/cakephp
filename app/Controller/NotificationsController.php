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
 * Notifications Controller
 *
 * @property Notification $Notification
 */
class NotificationsController extends AppController
{

    /**
     * Holds this controller's name
     * @var string 
     */
    public $name = 'Notifications';

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
        $this->paginate['Notification'] = array('order' => 'Notification.created DESC', 'contain' => array('Project', 'Phase', 'User'));
        $this->set('notifications', $this->paginate('Notification'));
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
        $this->Notification->id = $id;
        if (!$this->Notification->exists())
        {
            throw new NotFoundException(__('Invalid notification'));
        }
        if ($this->Notification->delete())
        {
            $this->Session->setFlash(__('Notification deleted'));
            $this->redirect(Router::url('/', true));
        }
        $this->Session->setFlash(__('Notification was not deleted'));
        $this->redirect(Router::url('/', true));
    
    }
    
    public function markread()
    {
		$this->autoRender=false;
		$this->loadModel('Actionitems');
		$user=AuthComponent::user('username');

		if ($this->Actionitems->updateAll(array('Actionitems.read' => 1),array('Actionitems.username' => $user)))
		{
			echo 'save';
		}else
		{
			echo 'error';
		}
	}
	
	public function getnotesaction()
	{
		$notecode=$this->request->data['Actionitem']['note_code'];
		$this->loadModel('Actionitems');
		$mytactonitems = $this->Actionitems->find('all', array(
            'contain' => array(
                'Project','Notes'
            ),
            'conditions' => array(
                'AND' => array(
                array('Actionitems.note_code ' => $notecode),
                array('Actionitems.action_type' => 'action')
				)
            ),
            'order' => array(
                'Actionitems.created' => 'DESC'
            )
        ));
        
        //print_r($mytactonitems);
		$this->set(compact('mytactonitems'));
	}

}
