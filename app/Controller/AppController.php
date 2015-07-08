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
App::uses('Controller', 'Controller');

/**
 * Application-wide controller
 */
class AppController extends Controller
{

    /**
     * Indicates whether a saving operation was blocked due to the system being in demo-mode
     * @var boolean
     */
    public static $demoBlocked = false;

    /**
     * Sets the application-wide default layout
     * @var string
     */
    public $layout = 'system';

    /**
     * Initialises the app-wide pagination-options array
     * @var array
     */
    public $paginate = array();

    /**
     * Contains the app-wide helpers array
     * @var array 
     */
    public $helpers = array(
        'Html' => array('className' => 'AppHtml'),
        'Form' => array('className' => 'AppForm'),
        'Session',
        'Time' => array('className' => 'AppTime'),
        'Text',
        'Layout',
        'Number' => array('className' => 'AppNumber')
    );

    /**
     * Contains the app-wide components array
     * @var array 
     */
    public $components = array(
        'Session',
        'App',
        'Auth' => array(
            'flash' => array(
                'key' => 'auth',
                'element' => Flash::Error,
                'params' => null
            ),
            'loginAction' => array(
                'controller' => 'users',
                'action' => 'login',
                'admin' => false
            ),
            'autoRedirect' => false,
            'loginRedirect' => array('controller' => 'projects', 'action' => 'index', 'admin' => false),
            'authError' => 'Access not allowed.',
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email'),
                    'scope' => array('User.active' => true)
                )
            ),
            'authorize' => array('Controller')
        ),
        'Cookie'
    );

    public function __construct($request = null, $response = null)
    {
        parent::__construct($request, $response);


        if (($lang = AppAuth::user('language')) !== null)
            Configure::write('Config.language', $lang);
        else
            Configure::write('Config.language', AppConfig::read('System.language'));

        if (($time = AppAuth::user('timezone')) !== null)
            Configure::write('Config.timezone', $time);
        else
            Configure::write('Config.timezone', AppConfig::read('System.timezone'));

        AppLanguages::setLocale();
    }

    /**
     * Handles the authorisation logic
     * @param array $user The user to authorise
     * @return boolean Whether the user is authorised
     */
    public function isAuthorized($user = array())
    {
        if (AppAuth::is(UserRoles::Admin))
            return true;

        if (empty($this->request->params['admin']))
            return true;

        if (!AppAuth::is(UserRoles::Admin))
        {
            if ($this->request->params['action'] == 'admin_personification')
                return true;
            else
                return false;
        }

        return false;
    }

    /**
     * Application-wide pre-render processing
     */
    public function beforeRender()
    {
        if (self::$demoBlocked === true)
            $this->Session->setFlash(__('You cannot perform any changes in the demonstration system'));

        if (($flash = $this->Session->read('Message.flash')) !== null && $flash['element'] == 'default')
        {
            $flash['element'] = Flash::Warning;
            $this->Session->write('Message.flash', $flash);
        }

        if ($this->request->is('ajax'))
        {
            Configure::write('debug', 0);
            $this->layout = 'ajax';
        }
    }

    /**
     * AppController's beforeFilter()
     */
    public function beforeFilter()
    {
        $this->Auth->authError = __('Access not allowed.');

        $this->__checkAuthCookie();

        if ($this->name == 'CakeError')
            $this->layout = 'default';


        if ($this->request->query('remove_frame') !== null)
        {
            CakeSession::write('Demo.remove_frame', true);
        }

        $this->recordUserActivity(); // Record activity before rendering output        
    }

    /**
     * Checks for the presence of the remember-me cookie and, if present and 
     * valid, loggs in the user
     */
    private function __checkAuthCookie()
    {
        if (isset($this->request->params['action']) && $this->request->params['action'] == 'logout')
        {
            return;
        }

        $this->Cookie->httpOnly = true;
        $this->Cookie->key = 'Z/=OuzUZRzolzj)%/$%oilhgFDR67&%&(piLJGFROIZ%&$%TGJHUE&/IUHvh&6iZGE';

        if (!$this->Auth->loggedIn() && $this->Cookie->read('cepp_pauth'))
        {
            $cookie = $this->Cookie->read('cepp_pauth');

            $user = ClassRegistry::init('User')->find('first', array(
                'conditions' => array(
                    'User.email' => $cookie['email'],
                    'User.password' => $cookie['password']
                )
            ));

            if (empty($user) || !$this->Auth->login($user['User']))
            {
                $this->redirect(array('controller' => 'users', 'action' => 'logout', 'admin' => false)); // destroy session & cookie
            }
        }
    }

    /**
     * AppController's beforeRedirect()
     * @param string $url
     * @param int $status
     * @param bool $exit
     */
    public function beforeRedirect($url, $status = null, $exit = true)
    {
        if (self::$demoBlocked === true)
            $this->Session->setFlash(__('You cannot perform any changes in the demonstration system'));

        parent::beforeRedirect($url, $status, $exit);
    }

    /**
     * Indicates whether the user's activity was recorded for the current request
     * @var boolean 
     */
    private static $activityRecorded = false;

    /**
     * Records the current user's activity on every request
     * @return void 
     */
    private function recordUserActivity()
    {
        if (!AuthComponent::user() || self::$activityRecorded || $this->viewClass !== 'View' || CakeSession::check('Personification')) // only record for views, not media
            return; // Not logged in/already recorded/not a view/personification: nothing to log

        ClassRegistry::init('User')->recordActivity();

        self::$activityRecorded = true;
    }

}