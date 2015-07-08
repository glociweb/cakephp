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
 * Enumeration of available UserRoles
 */
final class UserRoles
{
    /**
     * Used for clients
     */

    const Client = 'client';

    /**
     * Used for admins
     */
    const Admin = 'admin';

    /**
     * Returns all available user roles
     * @var array An array of all available user roles
     */
    public static function getAll()
    {
        return array(
            self::Client => __('Client'),
            self::Admin => __('Administrator')
        );
    }

}

/**
 * Enumeration of Flash-Message types
 */
final class Flash
{
    /**
     * Indicates that an error occured
     */

    const Error = 'flashmessages/error';
    /**
     * Generic flash style for informational purposes
     */
    const Info = 'flashmessages/info';

    /**
     * Indicates that the performed operation was successful
     */
    const Success = 'flashmessages/success';

    /**
     * Indiates a warning
     */
    const Warning = 'flashmessages/warning';

}

/**
 * Enumeration of Priority-Types
 */
final class TaskPriority
{
    /**
     * Low-priority task
     */

    const Low = 'low';
    /**
     * Default-priority task
     */
    const Normal = 'normal';
    /**
     * High-priority task
     */
    const High = 'high';

    /**
     * Returns all priority-types
     * @return array
     */
    public function getAll()
    {
        return array(
            self::Low => __('Low'),
            self::Normal => __('Normal'),
            self::High => __('High'),
        );
    }

}

/**
 * Enumeration of Phase-stati
 */
final class PhaseStatus
{
    /**
     * Waiting status: start date is in the future
     */

    const Waiting = 'waiting';
    /**
     * Completed: task is 100% complete
     */
    const Completed = 'completed';
    /**
     * Running: task is < 100% complete, startdate is in the past and end date in the future
     */
    const Running = 'running';
    /**
     * Overdue: task is > 100% complete and end date is in the past
     */
    const Overdue = 'overdue';

}

/**
 * Enumeration of Attachment-Types
 */
final class AttachmentType
{
    /**
     * Standard upload-type; indicates file attachments
     */

    const Upload = 'upload';
    /**
     * Url-type; indicates external URLs
     */
    const Url = 'url';

    /**
     * Returns all available attachment types
     * @return array
     */
    public function getAll()
    {
        return array(
            self::Upload => __('Upload'),
            self::Url => __('External link'),
        );
    }

}

/**
 * Contains the base directory of all uploads (with trailing directory separator)
 */
define('UPLOADBASE', APP . 'uploads' . DS);
/**
 * Contains the base directory of attachments (with trailing directory separator)
 */
define('ATTACHMENTBASE', APP . 'uploads' . DS . 'attachments' . DS);
/**
 * Contains the base directory of user avatars (with trailing directory separator)
 */
define('AVATARBASE', APP . 'uploads' . DS . 'avatars' . DS);
/**
 * Contains the base directory for configuration images (i.e. the logo; with trailing directory separator)
 */
define('CONFIGURATIONBASE', APP . 'uploads' . DS . 'configurations' . DS);

/**
 * Contains all available languages
 */
class AppLanguages
{

    /**
     * Returns an array of all currently available languages
     * @return array
     */
    public static function getAll()
    {
        return array(
            'en-gb' => __('English (British)'),
            'en-us' => __('English (United States)'),
            'deu' => __('German (Germany)'),
            'nld' => __('Dutch'),
            'por' => __('Portuguese'),
            'rus' => __('Russian'),
            'spa' => __('Spanish'),
                //'fre' => __('French'),
                //'dut' => __('Dutch'),
                //'pol' => __('Polish'),
                //'swe' => __('Swedish'),
                //'dan' => __('Danish'),
        );
    }

    /**
     * Sets the locale according to the currently set language
     */
    public static function setLocale()
    {
        $lang = Configure::read('Config.language');

        foreach (self::$dateFormats as $format)
            if (in_array($lang, $format['aliases']))
                setlocale(LC_TIME, $format['locales']);
    }

    /**
     * Contains locale fallbacks and DateTime formats
     * @var array 
     */
    private static $dateFormats = array(
        'en' => array(
            'aliases' => array('en-gb', 'en-us'),
            'locales' => array('en-gb', 'en-us', 'en', 'eng'),
            'default' => '',
            'nice' => '%a, %e. %b. %Y, %H:%M',
            'wordFormat' => 'j/n/y',
            'niceShort' => '%d/%m, %H:%M',
            'projectDate' => '%a, %e. %b. %Y',
        ),
        'deu' => array(
            'aliases' => array('deu'),
            'locales' => array('deu', 'de_de'),
            'default' => '',
            'nice' => '%a, %e. %b. %Y, %H:%M',
            'wordFormat' => 'j.n.y',
            'niceShort' => '%d/%m, %H:%M',
            'projectDate' => '%a, %e. %b. %Y',
        ),
        'por' => array(
            'aliases' => array('por'),
            'locales' => array('por', 'Portuguese_Portugal'),
            'default' => '',
            'nice' => '%e %B, %Y, %H:%M',
            'wordFormat' => 'j/n/y',
            'niceShort' => '%d/%m, %H:%M',
            'projectDate' => '%e %B, %Y',
        ),
        'spa' => array(
            'aliases' => array('spa'),
            'locales' => array('spa', 'Spanish_Spain.28605'),
            'default' => '',
            'nice' => '%e %B, %Y, %H:%M',
            'wordFormat' => 'j/n/y',
            'niceShort' => '%d/%m, %H:%M',
            'projectDate' => '%e %B, %Y',
        ),
        'rus' => array(
            'aliases' => array('rus'),
            'locales' => array('rus', 'Russian_Russia'),
            'default' => '',
            'nice' => '%d.%m.%Y, %H:%M',
            'wordFormat' => 'j.n.y',
            'niceShort' => '%d.%m., %H:%M',
            'projectDate' => '%d.%m.%Y',
        ),
    );

    /**
     * Returns the respective DateTime format for the currently set system language
     * @param string $type DateTime format type to return
     * @return string The DateTime format
     */
    public static function getDateFormat($type = 'nice')
    {
        $lang = Configure::read('Config.language');

        foreach (self::$dateFormats as $format)
            if (in_array($lang, $format['aliases']))
                return $format[$type];

        $default = array(
            'nice' => '%d.%m.%Y, %H:%M',
            'wordFormat' => 'j.n.y',
            'niceShort' => '%d.%m., %H:%M',
            'projectDate' => 'F %d.%m.%Y',
        );

        return $default[$type];
    }

}

/**
 * A collection of different DateTime formats
 */
class DateFormats
{

    const Nice = 'nice';
    const NiceShort = 'niceShort';
    const ProjectDate = 'projectDate';
    const WordFormat = 'wordFormat';

}

/**
 * A collection of app-wide utility functions for working with data types
 */
class AppLib
{
    /**
     * ClientEngage Website Url
     */

    const AppUrl = 'http://www.clientengage.com';

    /**
     * Returns the last element of an array
     * @param array $arr The array from which to get the element
     * @return type The last element of the array
     */
    public static function arrayLastEntry($arr = array())
    {
        if (!is_array($arr))
            return;

        if (empty($arr))
            return;

        return end($arr);
    }

    /**
     * Returns the first element of an array
     * @param array $arr The array from which to get the element
     * @return type The first element of the array
     */
    public static function arrayFirstEntry($arr = array())
    {
        if (!is_array($arr))
            return;

        if (empty($arr))
            return;

        reset($arr);
        return current($arr);
    }

    /**
     * Returns a readily useable CakeEmail object
     * @return CakeEmail
     */
    public static function prepareEmail()
    {
        App::uses('CakeEmail', 'Network/Email');

        $config = array('template' => 'default', 'layout' => 'default');

        if (Configure::read('debug') > 0)
            $config = Hash::merge($config, array('log' => true));

        if (AppConfig::read('Email.transport') == 'smtp')
        {

            $config = Hash::merge($config, array(
                        'host' => AppConfig::read('Email.host'),
                        'port' => AppConfig::read('Email.port'),
                        'username' => AppConfig::read('Email.username'),
                        'password' => AppConfig::read('Email.password'),
                        'transport' => 'Smtp',
            ));
        }

        $email = new CakeEmail($config);

        if (Configure::read('debug') > 0)
            $email->transport('Debug');

        $email->from(AppConfig::read('Email.email'), AppConfig::read('Email.sender'))
                ->emailFormat('both')
                ->setHeaders(array('X-Mailer' => 'ClientEngage Mailer'))
                ->returnPath(AppConfig::read('Email.email'), AppConfig::read('Email.sender'));

        return $email;
    }

}

/**
 * Handles the application configuration
 */
class AppConfig
{

    private static $isSetup = false;

    /**
     * Reads the application configuration
     * @param string $configKey The configuration key to be read
     * @return dynamic The configuration
     */
    public static function read($configKey = null)
    {
        if (!self::$isSetup)
        {
            if (($config = Cache::read('AppConfigurationCache')) === false)
            {
                $config = ClassRegistry::init('Configuration')->find('first');
                if ($config)
                    Cache::write('AppConfigurationCache', $config);
            }

            if (isset($config['Configuration']) && is_array($config['Configuration']))
                foreach ($config['Configuration'] as $k => $val)
                {
                    $cKey = str_replace('-', '.', $k);
                    Configure::write('AppConfig.' . $cKey, $val);
                }
            self::$isSetup = true;
        }

        return Configure::read('AppConfig.' . $configKey);
    }

}

App::uses('AuthComponent', 'Controller/Component');

/**
 * Convenience-wrapper for AuthComponent
 * Also implements additional utility functions for checking permission-levels 
 */
class AppAuth extends AuthComponent
{

    /**
     * Checks if the current user belongs to any of the passed roles
     * @param string $role A string or more parameters of string of the role(s) to check
     * @return boolean Indicates whether the user belongs to any of the roles
     */
    public static function is()
    {

        $roles = func_get_args();

        foreach ($roles as $role)
            if (AppAuth::user('role') === $role)
                return true;

        return false;
    }

}
