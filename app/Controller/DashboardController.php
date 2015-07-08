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
class DashboardController extends AppController
{
    /**
     * Holds this controller's name
     * @var string 
     */
    public $name = 'Dashboard';
    
    /**
     * Renders the individual phase display
     * @param string $phase_slug Slug of the phase to be displayed
     */
    public function index()
    {
        $user= $this->Auth->user('username');
        $this->layout = 'system_front';
        $this->loadModel('Notification');
        //latest notifications
        
        $project = $this->Notification->find('all', array(
            'contain' => array(
                'User',
                'Phase',
                'Project'
            ),
            'order' => array(
                'Notification.created' => 'DESC'
            ),
            'limit' =>10
        ));
        
        // latest notes
        
        $this->loadModel('Notes');
        $latestnotes = $this->Notes->find('all', array(
            'order' => array(
                'Notes.created' => 'DESC'
            ),
            'limit' => 10
        ));
        $this->loadModel('Actionitems');
        //my latest action items
        
        $mytactonitems = $this->Actionitems->find('all', array(
            'contain' => array(
                'Project','Notes'
            ),
            'conditions' => array(
                'AND' => array(
                array('Actionitems.username' => $user),
                array('Actionitems.action_type' => 'action'),
                array('Actionitems.completed' => 0)
				)
            ),
            'order' => array(
                'Actionitems.created' => 'DESC'
            ),
            'limit' => 10
        ));
        //echo "<pre>";print_r($mytactonitems);die;
        $mytactonitems_completed = $this->Actionitems->find('all', array(
            'contain' => array(
                'Project','Notes'
            ),
            'conditions' => array(
                'AND' => array(
                array('Actionitems.username' => $user),
                array('Actionitems.action_type' => 'action'),
                array('Actionitems.completed' => 1)
				)
            ),
            'order' => array(
                'Actionitems.created' => 'DESC'
            ),
            'limit' => 10
        ));
        // echo "<pre>"; print_r($mytactonitems);
        $this->set(array(
            'p_notification' => $project,
            'latestnotes' => $latestnotes,
            'mytactonitems' => $mytactonitems,
            'mytactonitems_completed'=>$mytactonitems_completed
        ));
        
    }
    
    public function getmentions()
    {
		$user= $this->Auth->user('username');
		$this->loadModel('Actionitems');
		 $mentions = $this->Actionitems->find('all', array(
            'contain' => array(
                'Project','Notes'
            ),
            'conditions' => array(
                'AND' => array(
                array('Actionitems.username' => $user),
                array('Actionitems.action_type' => 'mention')
				)
            ),
            'order' => array(
                'Actionitems.created' => 'DESC'
            ),
            'limit' => 10
        ));
        return $mentions;
	}
	public function mymentions()
    {
		$user= $this->Auth->user('username');
		$this->loadModel('Actionitems');
		 $mentions = $this->Actionitems->find('all', array(
            'contain' => array(
                'Project'
            ),
            'conditions' => array(
                'AND' => array(
                array('Actionitems.username' => $user),
                array('Actionitems.action_type' => 'mention')
				)
            ),
            'order' => array(
                'Actionitems.created' => 'DESC'
            )
        ));
       $this->set(compact('mentions'));
	}
	
	public function unread()
	{
		$user= $this->Auth->user('username');
		$this->loadModel('Actionitems');
		 $mentions = $this->Actionitems->find('count', array(
            'contain' => array(
                'Project'
            ),
            'conditions' => array(
                'AND' => array(
                array('Actionitems.username' => $user),
                array('Actionitems.action_type' => 'mention'),
                 array('Actionitems.read' => 0)
				)
            ),
            'order' => array(
                'Actionitems.created' => 'DESC'
            )
        ));
        
        return $mentions==0?'':$mentions;
       //$this->set(compact('mentions'));
	}
    
    
    
}
