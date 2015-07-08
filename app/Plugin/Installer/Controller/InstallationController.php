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

/**
 * Installation controller
 */
class InstallationController extends Controller
{

    public $uses = array();
    public $components = array('Session');
    public $layout = 'installer';

    /**
     * Holds the path to the database.php template
     * @var string 
     */
    public $DatabaseConfigTemplateFile = null;

    /**
     * Holds the path to the intended database.php file
     * @var string 
     */
    public $DatabaseConfigFile = null;

    /**
     * Holds the path to the core.php config file
     * @var string 
     */
    public $SecurityConfigFile = null;

    /**
     * Holds the installation config file
     * @var string
     */
    public $InstallationConfigFile = null;

    /**
     * Holds the original salt value
     * @var string
     */
    public $OriginalSalt = 'fYvn2a7G3Ry852ocj20J803q5l942kOiFEzyDKJk';

    /**
     * Holds the original cipherSeed value
     * @var string
     */
    public $OriginalCipherSeed = '36084619963166514593845504613';

    /**
     * Holds the default database config for testing purposes
     * @var array 
     */
    private $DatabaseDefaultConfig = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => '{Host}',
        'port' => '{Port}',
        'login' => '{User}',
        'password' => '{Password}',
        'database' => '{DatabaseName}',
        'prefix' => '{Prefix}',
        'encoding' => 'utf8',
    );
    private $tableList = array(
        'attachments',
        'clients',
        'comments',
        'configurations',
        'notifications',
        'phases',
        'projects',
        'projects_clients',
        'projects_users',
        'users',
    );

    public function __construct($request = null, $response = null)
    {
        parent::__construct($request, $response);

        $this->DatabaseConfigTemplateFile = APP . 'Config' . DS . 'database.php.installation';
        $this->DatabaseConfigFile = APP . 'Config' . DS . 'database.php';
        $this->SecurityConfigFile = APP . 'Config' . DS . 'security-core.php';
        $this->InstallationConfigFile = APP . 'Config' . DS . 'clientengage-installation.ini';
    }

    public function beforeFilter()
    {
        if ($this->name == 'CakeError')
            $this->layout = 'installer';

        if (file_exists($this->InstallationConfigFile))
        {
            $this->Session->setFlash(__('You have successfully installed ClientEngage. You may now log-in with your administrator profile.'), Flash::Success);
            $this->redirect(array('controller' => 'users', 'action' => 'login', 'admin' => true, 'plugin' => null));
            die;
        }
        if ($this->request->params['action'] != 'index' && !$this->Session->read('eula_agreed') === true)
        {
            $this->Session->setFlash(__('Installation cannot continue, please accept the EULA'), Flash::Error);
            $this->redirect(array('action' => 'index'));
        }

        if (!$this->__checkRequirements() && $this->request->params['action'] !== 'index')
            $this->redirect(array('action' => 'index'));
    }

    public function index()
    {
        if ($this->request->is('post'))
        {
            if (isset($this->request->data['eula_agreed']) && $this->request->data['eula_agreed'] == '1')
            {
                $this->Session->write('eula_agreed', true);
                $this->redirect(array('action' => 'database_setup'));
            }
        }
    }

    public function database_setup()
    {
        if ($this->__testDatabaseConfigSetupAndValid())
        {
            $this->Session->setFlash(__('You have already configured the database connection. Please proceed with the installation.'), Flash::Info);
            $this->redirect(array('action' => 'initialisation'));
        }


        if (!$this->request->is('post'))
        {
            $this->request->data['host'] = 'localhost';
            $this->request->data['database'] = 'projectplatform';
            $this->request->data['prefix'] = 'ce_';

            $this->set('invalid', array());
        }
        else
        {
            if (isset($this->request->data['prefix']))
                $this->request->data['prefix'] = strtolower($this->request->data['prefix']);

            if (!$this->__validateDatabaseConfig())
                return;

            if (($configuration = $this->__testDatabaseConfig()) === false)
            {
                $this->Session->setFlash(__('Could not connect to the database. Please review the configuration.'), Flash::Error);
                return;
            }
            else
            {
                if (!$this->__writeDatabaseConfig($configuration))
                {
                    $this->Session->setFlash(__('Could not write the database configuration.'), Flash::Error);
                    return;
                }

                $this->Session->setFlash(__('Your database configuration was successfull.'), Flash::Success);
                $this->redirect(array('action' => 'initialisation'));
            }
        }
    }

    public function initialisation()
    {
        if (!$this->__testDatabaseConfigSetupAndValid())
        {
            $this->Session->setFlash(__('Could not connect to the database. Please review your configuration.'), Flash::Error);
            $this->redirect(array('action' => 'database_setup'));
        }
        if ($this->request->is('post'))
        {
            $this->__clearCache();
            $this->__initialiseDatabase();
            $this->Session->setFlash('The database has been successfully initialised.', Flash::Success);
            $this->redirect(array('action' => 'settings'));
        }
    }

    public function settings()
    {
        if (!$this->__testDatabaseConfigSetupAndValid())
        {
            $this->redirect(array('action' => 'database_setup'));
            $this->Session->setFlash(__('The database was not properly initialised. Please re-start the installation.'), Flash::Error);
        }

        $this->loadModel('Configuration');
        if ($this->Configuration->find('count') > 0)
        {
            $this->Session->setFlash(__('Configuration already exists. Please continue.'), Flash::Info);
            $this->redirect(array('action' => 'administrator'));
        }
        if (!$this->__testDatabaseConfigSetupAndValid())
        {
            $this->Session->setFlash(__('Could not connect to the database. Please review your configuration.'), Flash::Error);
            $this->redirect(array('action' => 'database_setup'));
        }
        if (!$this->__testAllTablesExist())
        {
            $this->Session->setFlash(__('Not all tables were initialised successfully. Please drop all initialised tables and re-start the installation.'), Flash::Error);
            $this->redirect(array('action' => 'database_setup'));
        }

        if ($this->request->is('post'))
        {
            $this->request->data['Configuration']['Email-invitationtext_text'] = $this->request->data['Configuration']['Email-invitationtext_text'] = __('Dear {UserName},

You have been invited to join the project {ProjectName} on our online project management portal.

This will enable you to participate in following the project\'s progress as well as allow you to comment on any of the project\'s phases.

You can log-on to the project here: {ProjectUrl}

Your username is: {UserEmail}
{StartIsNewUser}
Your temporary password is: {TempPassword}

Please make sure you change your temporary password during your first visit.
{EndIsNewUser}


Kind regards,
{SystemName}
');
            $this->request->data['Configuration']['Email-progressactivity_text'] = $this->request->data['Configuration']['Email-progressactivity_text'] = __('Dear {UserName},
                
There has been some new activity in the project {ProjectName}.

{User} changed the progress of the phase {PhaseName} from {OldPercentage} to {NewPercentage}.

You can view the affected project phase here: {PhaseUrl}


Kind regards,
{SystemName}
');
            $this->request->data['Configuration']['Email-commentactivity_text'] = $this->request->data['Configuration']['Email-commentactivity_text'] = __('Dear {UserName},
                
There has been some new activity in the project {ProjectName}.

{User} has created a new {CommentType} in the phase {PhaseName}.

You can view the {CommentType} here: {CommentUrl}


Kind regards,
{SystemName}
');
            $this->request->data['Configuration']['Email-taskactivity_text'] = $this->request->data['Configuration']['Email-taskactivity_text'] = __('Dear {UserName},
                
There has been some new activity in the project {ProjectName}.

{User} has changed the status of a task in the phase {PhaseName} to {TaskStatus}.

You can view the task here: {CommentUrl}


Kind regards,
{SystemName}          
');

            $this->Configuration->create();
            if ($this->Configuration->save($this->request->data))
            {
                $this->Session->setFlash(__('The system configuration was saved successfully.'), Flash::Success);
                $this->redirect(array('action' => 'administrator'));
            }
            else
            {
                $this->Session->setFlash(__('Could not save the system configuration. Please review your inputs.'), Flash::Error);
            }
        }
    }

    public function administrator()
    {
        if (!$this->__testDatabaseConfigSetupAndValid())
        {
            $this->redirect(array('action' => 'database_setup'));
            $this->Session->setFlash(__('The database was not properly initialised. Please re-start the installation.'), Flash::Error);
        }

        $this->loadModel('User');
        if ($this->User->find('count') > 0)
        {
            $this->Session->setFlash(__('Administrator already exists. Please continue.'), Flash::Info);
            $this->redirect(array('action' => 'finalisation'));
        }

        if ($this->request->is('post'))
        {
            $this->request->data['User']['role'] = UserRoles::Admin;
            $this->User->set($this->request->data);
            if ($this->User->validates())
            {
                $this->Session->write('Administrator.User', $this->request->data['User']);
                $this->Session->setFlash(__('The administrator has been created.'), Flash::Success);
                $this->redirect(array('action' => 'finalisation'));
            }
            else
            {
                $this->Session->setFlash(__('The administrator could not be saved. Please, try again.'));
            }
        }
    }

    public function finalisation()
    {
        if ($this->Session->read('Administrator.User') === null)
        {
            $this->redirect(array('action' => 'administrator'));
        }

        if ($this->request->is('post'))
        {
            if ((Configure::read('Security.salt') != null && Configure::read('Security.cipherSeed') != null) && Configure::read('Security.salt') != $this->OriginalSalt && Configure::read('Security.cipherSeed') != $this->OriginalCipherSeed)
            {
                $this->Session->setFlash(__('You have successfully installed ClientEngage. You may now log-in with your administrator profile.'), Flash::Success);
                $this->redirect(array('controller' => 'users', 'action' => 'login', 'admin' => true, 'plugin' => null));
            }

            if (Configure::read('Security.salt') == null && Configure::read('Security.cipherSeed') == null || Configure::read('Security.salt') == $this->OriginalSalt || Configure::read('Security.cipherSeed') == $this->OriginalCipherSeed)
            {
                $cipherSeed = mt_rand() . mt_rand() . mt_rand();
                $salt = $this->__generateSalt();
                $securityCore = '<?php

Configure::write(\'Security.salt\', \'' . $salt . '\');
Configure::write(\'Security.cipherSeed\', \'' . $cipherSeed . '\');

';
                Configure::write('Security.salt', $salt);
                Configure::write('Security.cipherSeed', $cipherSeed);

                $this->loadModel('User');
                $this->User->create();
                if ($this->User->save($this->Session->read('Administrator')))
                {
                    App::uses('File', 'Utility');

                    $securityConfig = new File($this->SecurityConfigFile, true);
                    if (!$securityConfig->write($securityCore))
                    {
                        $this->User->deleteAll(array('User.email' => $this->Session->delete('Administrator.User.email')), false);
                        $this->Session->delete('Administrator');
                        $this->Session->setFlash(String::insert(__('<h4>Could not write to the security configuration. Please make sure the file is writable.</h4><code>:security_core</code>'), array('security_core' => $this->SecurityConfigFile)), Flash::Error);
                        return;
                    }
                    else
                    {
                        $installationConfig = new File($this->InstallationConfigFile, true);
                        $installationConfig->write(time());
                    }
                    $this->Session->delete('Administrator');

                    $this->Session->setFlash(__('You have successfully installed ClientEngage. You may now log-in with your administrator profile.'), Flash::Success);
                    $this->redirect(array('controller' => 'users', 'action' => 'login', 'admin' => true, 'plugin' => null));
                }
                else
                {
                    $this->Session->setFlash(__('Could not create the administrative user. Please try again.'), Flash::Error);
                    return;
                }
            }
        }
    }

    private function __generateSalt()
    {
        $length = 40;
        $salt = '';
        $charList = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $mLength = strlen($charList);

        if ($length > $mLength)
            $length = $mLength;

        $i = 0;
        while ($i < $length)
        {
            $char = substr($charList, mt_rand(0, $mLength - 1), 1);
            if (!strstr($salt, $char))
            {
                $salt .= $char;
                $i++;
            }
        }

        return $salt;
    }

    private function __finalIntegrityCheck($check = array())
    {
        if (!$this->__testDatabaseConfigSetupAndValid())
        {
            return false;
        }
        if (!$this->__testAllTablesExist())
        {
            return false;
        }

        $this->loadModel('User');
        if ($this->User->find('count') != 1)
            return false;

        $this->loadModel('Configuration');
        if ($this->Configuration->find('count') != 1)
            return false;

        return true;
    }

    private function __testAllTablesExist()
    {
        if (!file_exists($this->DatabaseConfigFile))
            return false;

        App::import('Model', 'ConnectionManager');

        $dataSource = ConnectionManager::getDataSource('default');
        $tables = $dataSource->listSources();

        foreach ($this->tableList as $reqTable)
            if (!in_array(ConnectionManager::$config->default['prefix'] . $reqTable, $tables))
            {
                return false;
            }
        return true;
    }

    private function __testDatabaseConfigSetupAndValid()
    {
        if (file_exists($this->DatabaseConfigFile))
        {
            App::import('Model', 'ConnectionManager');
            try
            {
                $dataSource = ConnectionManager::getDataSource('default');
            }
            catch (PDOException $ex)
            {
                return false;
            }
            if (!$dataSource->isConnected())
                return false;
        } else
        {
            return false;
        }

        return true;
    }

    private function __validateDatabaseConfig()
    {
        $mandatory = array(
            'host' => __('You must enter the database host.'),
            'database' => __('You must enter the database name.'),
            'login' => __('You must enter the database username.'),
        );

        $valid = true;
        $invalidFields = array();

        foreach ($mandatory as $field => $message)
            if (!isset($this->request->data[$field]) || trim($this->request->data[$field]) == '')
            {
                $valid = false;
                $invalidFields[$field] = $message;
            }

        $this->set('invalid', $invalidFields);

        if (!$valid)
            $this->Session->setFlash(__('Please enter valid database settings.'), Flash::Error);

        return $valid;
    }

    private function __testDatabaseConfig()
    {
        $configuration = $this->DatabaseDefaultConfig;

        foreach ($configuration as $cKey => $defV)
        {
            if (isset($this->request->data[$cKey]))
                $configuration[$cKey] = $this->request->data[$cKey];
        }

        App::uses('ConnectionManager', 'Model');
        try
        {
            $isConnected = @ConnectionManager::create('default', $configuration);
        }
        catch (Exception $dbConnectionError)
        {
            $isConnected = false;
        }

        if ($isConnected !== false && $isConnected->isConnected())
            return $configuration;
        else
            return false;
    }

    private function __writeDatabaseConfig($config = array())
    {
        $defaultConfig = $this->DatabaseDefaultConfig;
        unset($defaultConfig['datasource'], $defaultConfig['encoding'], $defaultConfig['persistent']);
        $replacementMap = array();

        foreach ($defaultConfig as $cKey => $rVal)
        {
            $replacementMap[$defaultConfig[$cKey]] = $config[$cKey];
        }

        App::uses('File', 'Utility');

        if (!file_exists($this->DatabaseConfigTemplateFile))
            return false;
        copy($this->DatabaseConfigTemplateFile, $this->DatabaseConfigFile);
        $dbConfigFile = new File($this->DatabaseConfigFile, true);
        $dbConfigContent = $dbConfigFile->read();

        foreach ($replacementMap as $s => $r)
            $dbConfigContent = str_replace($s, $r, $dbConfigContent);

        $success = $dbConfigFile->write($dbConfigContent);

        if (!$success)
            return false;

        return true;
    }

    private function __initialiseDatabase()
    {
        App::import('Model', 'ConnectionManager');
        App::uses('CakeSchema', 'Model');

        $toCreate = array();

        $dataSource = ConnectionManager::getDataSource('default');
        $appSchema = new CakeSchema(array('name' => 'App'));
        $appSchema = $appSchema->load();
        foreach ($appSchema->tables as $table => $tableFields)
            $toCreate[$table] = $dataSource->createSchema($appSchema, $table);

        foreach ($toCreate as $table => $createCommand)
        {
            try
            {
                $dataSource->execute($createCommand);
            }
            catch (PDOException $ex)
            {
                $this->Session->setFlash(String::insert(__('<h4>The table ":table_name" could not be created. Please clear any existing ClientEngage tables before continuing the installation.</h4>:error_message'), array('table_name' => $table, 'error_message' => $ex->getMessage())), Flash::Error);
                return false;
            }
        }

        return true;
    }

    /**
     * Checks the system requirements of ClientEngage
     * @return boolean Whether all requirements are met
     */
    private function __checkRequirements()
    {
        $continueInstallation = true;

        if (!is_writable(TMP))
            $continueInstallation = false;

        if (!is_writable(APP . 'Config' . DS))
            $continueInstallation = false;

        if (!is_writable(UPLOADBASE))
            $continueInstallation = false;

        if (!version_compare(PHP_VERSION, '5.2.8', '>='))
            $continueInstallation = false;

        return $continueInstallation;
    }

    private function __clearCache()
    {
        Cache::clear(false, '_cake_model_');
        Cache::clear(false, '_cake_core_');
        Cache::clear();
    }

}