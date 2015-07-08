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
class ClientsController extends AppController
{

    /**
     * Holds this controller's name
     * @var string 
     */
    public $name = 'Clients';

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->Client->recursive = 0;
        $this->set('clients', $this->paginate());
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
        $this->Client->id = $id;
        if (!$this->Client->exists())
        {
            throw new NotFoundException(__('Invalid client'));
        }
        $client = $this->Client->find('first', array(
            'conditions' => array('Client.id' => $id),
            'contain' => array('User', 'Project')
                ));
        $this->set('client', $client);
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        $this->Client->id = $id;
        if (!$this->Client->exists())
        {
            throw new NotFoundException(__('Invalid client'));
        }
        $client = $this->Client->find('first', array(
            'conditions' => array('Client.id' => $id),
            'contain' => array('User')
                ));
        $this->set('client', $client);
    }

    /**
     * admin_add method
     * @param string $project_id The parent project's id
     * @return void
     */
    public function admin_add($project_id = null)
    {
        if ($this->request->is('post'))
        {
            $this->Client->create();
            if ($this->Client->save($this->request->data))
            {
                $this->Session->setFlash(__('The client has been saved'), Flash::Success);
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__('The client could not be saved. Please, try again.'));
            }
        }
        $projects = $this->Client->Project->find('list', array('conditions' => array('Project.archived' => false)));
        $this->request->data['Client']['active'] = true;
        $this->request->data['Project']['Project'] = $project_id;
        $this->set(compact('projects'));
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
        $this->Client->id = $id;
        if (!$this->Client->exists())
        {
            throw new NotFoundException(__('Invalid client'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if ($this->Client->save($this->request->data))
            {
                $this->Session->setFlash(__('The client has been saved'), Flash::Success);
                $this->redirect(array('action' => 'view', $id));
            } else
            {
                $this->Session->setFlash(__('The client could not be saved. Please, try again.'));
            }
        } else
        {
            $this->Client->recursive = 1;
            $this->request->data = $this->Client->read(null, $id);
        }
        $projects = $this->Client->Project->find('list', array('conditions' => array('Project.archived' => false)));
        $this->set(compact('projects'));
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
        $this->Client->id = $id;
        if (!$this->Client->exists())
        {
            throw new NotFoundException(__('Invalid client'));
        }
        if ($this->Client->delete())
        {
            $this->Session->setFlash(__('Client deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Client was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
