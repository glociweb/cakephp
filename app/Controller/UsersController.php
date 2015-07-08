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
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController
{

    /**
     * Holds this controller's name
     * @var string 
     */
    public $name = 'Users';

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $data=$this->paginate['User'] = array('contain' => array('Client','Department'), 'conditions' => array('User.role' => UserRoles::Client));
  
        $users = $this->paginate('User');
        
        $this->set('users', $users);
    }

    public function admin_administrators()
    {
        $this->paginate['User'] = array('conditions' => array('User.role' => UserRoles::Admin));
        $users = $this->paginate('User');
        $this->set('users', $users);
    }
    
     public function isdepthead($id=null)
    {
		$this->autoRender = false;
		$this->loadModel('Departments');
		if($this->Departments->hasAny(['dep_head'=>$id]))
		{
			return true;
		}
		return false;
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
        $this->User->id = $id;
        if (!$this->User->exists())
        {
            throw new NotFoundException(__('Invalid user'));
        }

        $user = $this->User->find('first', array(
            'conditions' => array('User.id' => $id),
            'contain' => array('Client', 'Attachment', 'Comment','Department')));

        if ($user['User']['role'] == UserRoles::Admin)
            $this->redirect(array('action' => 'administrators_view', $id));


        $this->paginate['Notification'] = array('order' => 'Notification.created DESC', 'conditions' => array('Notification.user_id' => $id), 'contain' => array('User', 'Phase'));
        $notifications = $this->paginate('Notification');

        $this->set('notifications', $notifications);
        $this->set('user', $user);
    }

    public function admin_administrators_view($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists())
        {
            throw new NotFoundException(__('Invalid administrator'));
        }

        $user = $this->User->find('first', array(
            'conditions' => array('User.id' => $id),
            'contain' => array('Client', 'Attachment', 'Comment')));

        $this->paginate['Notification'] = array('order' => 'Notification.created DESC', 'conditions' => array('Notification.user_id' => $id), 'contain' => array('User', 'Phase'));
        $notifications = $this->paginate('Notification');

        $this->set('notifications', $notifications);
        $this->set('user', $user);
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add($client_id = null)
    {

        if ($this->request->is('post'))
        {
            $this->request->data['User']['role'] = UserRoles::Client;
            if (trim($this->request->data['User']['temp_password']) != '')
            {
                $this->request->data['User']['password'] = $this->request->data['User']['temp_password'];
                $this->request->data['User']['password_confirm'] = $this->request->data['User']['temp_password'];
            }

            $this->User->create();
            if ($this->User->save($this->request->data))
            {
                $this->Session->setFlash(__('The user has been created'), Flash::Success);
                if (isset($this->request->data['add_new']))
                    $this->redirect(array('controller' => 'users', 'action' => 'add', $client_id));
                $this->redirect(array('action' => 'index'));
            } else
            {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
        else
        {
            $this->request->data['User']['temp_password'] = $this->__genTempPassword(5);
        }
        $this->request->data['User']['active'] = true;
        $clients = $this->User->Client->find('list');
        $this->loadModel('Department');
		$departments= $this->Department->find('list');
        if ($client_id !== null && !isset($clients[$client_id]))
            throw new MethodNotAllowedException();

        $this->set('selectedclient', $client_id);

        $this->set(compact('clients','departments'));
    }

    public function admin_administrators_add()
    {

        if ($this->request->is('post'))
        {
            $this->request->data['User']['role'] = UserRoles::Admin;
            $this->User->create();
            if ($this->User->save($this->request->data))
            {
                $this->Session->setFlash(__('The administrator has been created'), Flash::Success);
                $this->redirect(array('action' => 'administrators'));
            }
            else
            {
                $this->Session->setFlash(__('The administrator could not be saved. Please, try again.'));
            }
        }
        $this->request->data['User']['active'] = true;
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
        $this->User->id = $id;
        if (!$this->User->exists())
        {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if (trim($this->request->data['User']['temp_password']) != '')
            {
                $this->request->data['User']['password'] = $this->request->data['User']['temp_password'];
                $this->request->data['User']['password_confirm'] = $this->request->data['User']['temp_password'];
            }

            if ($this->User->save($this->request->data))
            {
                $this->Session->setFlash(__('The user has been saved'), Flash::Success);
                $this->redirect(array('action' => 'view', $id));
            }
            else
            {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
        else
        {
            $this->request->data = $this->User->read(null, $id);
        }

        $user = $this->User->findById($id);

        if ($user['User']['role'] == UserRoles::Admin)
            $this->redirect(array('action' => 'administrators_edit', $id));
		

        $clients = $this->User->Client->find('list');
        $this->loadModel('Department');
		$departments= $this->Department->find('list');
        $this->set(compact('clients', 'user','departments'));
    }

    public function admin_administrators_edit($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists())
        {
            throw new NotFoundException(__('Invalid administrator'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            if (trim($this->request->data['User']['temp_password']) != '')
            {
                $this->request->data['User']['password'] = $this->request->data['User']['temp_password'];
                $this->request->data['User']['password_confirm'] = $this->request->data['User']['temp_password'];
            }

            if ($this->User->save($this->request->data))
            {
                $this->Session->setFlash(__('The administrator has been saved'), Flash::Success);
                $this->redirect(array('action' => 'administrators_view', $id));
            }
            else
            {
                $this->Session->setFlash(__('The administrator could not be saved. Please, try again.'));
            }
        }
        else
        {
            $this->request->data = $this->User->read(null, $id);
        }

        $user = $this->User->findById($id);
        $this->set(compact('user'));
    }

    public function profile()
    {
        $this->layout = 'system_front';
        $this->User->id = AppAuth::user('id');
        if (!$this->User->exists())
        {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put'))
        {
            $this->request->data['User']['id'] = $this->User->id;
            if ($this->User->save($this->request->data, true, array('username', 'email', 'password', 'avatarpath', 'temp_password', 'timezone', 'language', 'receivenotifications')))
            {
                $this->Session->setFlash(__('The changes to your profile were saved'), Flash::Success);
                $this->Session->write('Auth', $this->User->read(null, AppAuth::user('id')));
                $this->redirect(array('action' => 'profile'));
            }
            else
            {
                $this->Session->setFlash(__('Your profile could not be saved. Please, try again.'));
            }
        }
        else
        {
            $this->request->data = $this->User->read(null, AppAuth::user('id'));
        }
        $this->set('title_for_layout', __('Your Profile'));
        $user = $this->User->findById(AppAuth::user('id'));
        $this->set(compact('user'));
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
        $this->User->id = $id;
        if (!$this->User->exists())
        {
            throw new NotFoundException(__('Invalid user'));
        }

        if ($this->User->field('role') == UserRoles::Admin && $this->User->find('count', array('conditions' => array('User.role' => UserRoles::Admin))) < 2)
        {
            $this->Session->setFlash(__('You cannot delete the only administrator'));
            $this->redirect($this->referer());
        }

        if ($this->User->delete())
        {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    public function login()
    {
        $this->__login();
        $this->render('login');
    }

    public function admin_login()
    {
        $this->__login();
        $this->render('admin_login');
    }

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('login', 'admin_login', 'logout', 'forgotten_password');
    }

    private function __login()
    {
        $this->layout = 'default';

        if (AuthComponent::user())
            $this->redirect(array('controller' => 'projects', 'action' => 'index'));

        if ($this->request->is('post'))
        {
            $this->User->set($this->request->data);
            if ($this->Auth->login())
            {

                if ($this->request->data['User']['remember_me'] == 1)
                {
                    unset($this->request->data['User']['remember_me']);
                    $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
                    $this->Cookie->write('cepp_pauth', $this->request->data['User'], true, '2 weeks');
                }

                if (!AppAuth::is(UserRoles::Admin) && AppConfig::read('System.maintenance') === true)
                {
                    $this->Session->setFlash(__('The system is in maintenance mode.'), Flash::Error);
                    $this->redirect($this->Auth->logout());
                }

                $this->Session->setFlash(__('You successfully logged in.'), Flash::Success);
                if (!empty($this->request->params['admin']))
                    $this->redirect(array('controller' => 'projects', 'action' => 'index'));
                else
                    $this->redirect($this->Auth->redirectUrl());
            } else
            {
                unset($this->request->data['User']['password']);
                $this->Session->setFlash(__('The username/password you provided were incorrect.'));
            }
        }
        $this->set('title_for_layout', __('Login'));
    }

    public function logout()
    {
        $this->Session->delete('Personification');
        $this->Cookie->delete('cepp_pauth');
        $this->redirect($this->Auth->logout());
    }

    public function forgotten_password()
    {
        $this->layout = 'default';

        if (AuthComponent::user())
            $this->redirect(array('controller' => 'projects', 'action' => 'index'));

        if ($this->request->is('post'))
        {
            if (trim($this->request->data('User.email')) != '')
            {
                $user = $this->User->find('first', array(
                    'conditions' => array('User.email' => $this->request->data('User.email')),
                    'fields' => array('id', 'email', 'username', 'temp_password')));

                if (empty($user))
                {
                    $this->Session->setFlash(__('No user matching the email address could be found'), Flash::Error);
                    return;
                }

                $user['User']['temp_password'] = $this->__genTempPassword(5);
                $user['User']['password'] = $user['User']['temp_password'];
                $user['User']['password_confirm'] = $user['User']['temp_password'];

                $this->User->id = $user['User']['id'];
                $this->User->set($user);

                if ($this->User->save())
                {
                    $email = AppLib::prepareEmail();

                    $email->to($user['User']['email'], $user['User']['username'])
                            ->subject(__('Project Platform: Password Reset'))
                            ->send(String::insert(__("Dear :username, \n\nYour temporary password is: :temp_password"), array('username' => $user['User']['username'], 'temp_password' => $user['User']['temp_password'])));

                    $this->Session->setFlash(__('You have been sent an email with a temporary password. Please check your inbox.'), Flash::Success);
                    $this->redirect(array('controller' => 'users', 'action' => 'login', 'admin' => true));
                }
                else
                {
                    $this->Session->setFlash(__('An error occurred whilst re-setting your password. Please try again.'), Flash::Error);
                    return;
                }
            }
        }
    }

    public function admin_personification($action = 'personify', $user_id = null)
    {
        if (!in_array($action, array('personify', 'revert')))
            throw new MethodNotAllowedException(__('Personification action not allowed.'));

        if ($action == 'personify')
        {
            $this->User->id = $user_id;
            if (!$this->User->exists())
                throw new NotFoundException(__('Invalid user'));

            if (!AppAuth::is(UserRoles::Admin))
                throw new MethodNotAllowedException(__('Personification not allowed'));
            else
            {
                $user = $this->User->find('first', array('recursive' => 0, 'conditions' => array('User.id' => $user_id), 'contain' => array('Client')));

                if ($user['User']['role'] == UserRoles::Admin)
                    throw new MethodNotAllowedException(__('Personification of admin not allowed'));
                else
                {
                    $this->Session->write('Personification', AuthComponent::user());
                    $this->Auth->login($user['User']);
                    $this->Session->write('Auth.User.Client', $user['Client']);

                    $this->Session->setFlash(String::insert(__('You are now personifying :username'), array('username' => $user['User']['username'])));
                }
            }
        }
        else if ($action == 'revert')
        {
            $this->Auth->login($this->Session->read('Personification'));
            $this->Session->delete('Personification');
            $this->Session->setFlash(String::insert('You are now ":username" again.', array('username' => AuthComponent::user('username'))));
        }

        $referer = $this->referer();
        if ($referer == '/')
            $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
        else
            $this->redirect($referer);
    }

    public function avatar($user_id = null, $avatarpath = null)
    {
        if (!$user_id)
            return;

        $this->viewClass = 'Media';
        $params = array(
            'id' => 'thumb_' . $avatarpath,
            'path' => AVATARBASE . $user_id . DS
        );
        $this->set($params);
    }

    private function __genTempPassword($length = 10)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        for ($i = 0; $i < $length; $i++)
        {
            $string .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $string;
    }

}
