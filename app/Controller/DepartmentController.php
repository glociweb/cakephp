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
 * Clients Controller
 *
 * @property Client $Client
 */
class DepartmentController extends AppController
{
	
	public $components = array('Paginator');

	/**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
		//$this->paginate['Department'] = array('contain' => array('User'));
		$this->Paginator->settings = array(
			'limit' => 10,
			'order' => array(
				'id' => 'asc'
			),
			'contain' => array(
					'User'
			)
		);
		$departments = $this->paginate('Department');
        $this->set('departments', $departments);
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
			
            if ($this->Department->save($this->request->data))
            {
				
                $this->Session->setFlash(__('The Department has been created'), Flash::Success);
                if (isset($this->request->data['add_new']))
                    $this->redirect(array('controller' => 'department', 'action' => 'add'));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__('The Department could not be saved. Please, try again.'));
            }
        }
        $this->loadModel('User');
		$users = $this->User->find('list');
		$this->set(compact('users'));
    }
    
    public function admin_edit($id=null)
    {
		$this->Department->id = $id;
        if (!$this->Department->exists())
        {
            throw new NotFoundException(__('Invalid Department'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
     
            if ($this->Department->save($this->request->data))
            {
                $this->Session->setFlash(__('The department has been saved'), Flash::Success);
                $this->redirect(array('action' => 'view', $id));
            }
            else
            {
                $this->Session->setFlash(__('The department could not be saved. Please, try again.'));
            }
        }
        else
        {
            $this->request->data = $this->Department->read(null, $id);
        }
        $department = $this->Department->findById($id);
        $this->loadModel('User');
		$users = $this->User->find('list');
		$this->set(compact('department', 'users'));
	}
	public function admin_view($id = null)
    {
        $this->Department->id = $id;
        if (!$this->Department->exists())
        {
            throw new NotFoundException(__('Invalid department'));
        }

        $department = $this->Department->find('first', array(
            'conditions' => array('Department.id' => $id),
            'contain' => array('User')));
        $this->set('department', $department);
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
        $this->Department->id = $id;
        if (!$this->Department->exists())
        {
            throw new NotFoundException(__('Invalid Department'));
        }
		$this->loadModel('User');
       

        if ($this->Department->delete())
        {
            $this->Session->setFlash(__('Department deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Department was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
