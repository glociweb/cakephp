<?php

class Upgradev1x1x5to1x2x1 extends CakeMigration
{

    /**
     * Migration description
     *
     * @var string
     * @access public
     */
    public $description = '';

    /**
     * Actions to be performed
     *
     * @var array $migration
     * @access public
     */
    public $migration = array(
        'up' => array(
            'create_field' => array(
                'configurations' => array(
                    'Email-checked_default' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'after' => 'Uploads-extension_blacklist'),
                ),
                'users' => array(
                    'language' => array('type' => 'string', 'null' => false, 'default' => 'en-gb', 'length' => 10, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8', 'after' => 'lastactivity'),
                    'timezone' => array('type' => 'string', 'null' => false, 'default' => 'Europe/London', 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8', 'after' => 'language'),
                ),
            ),
        ),
        'down' => array(
            'drop_field' => array(
                'configurations' => array('Email-checked_default',),
                'users' => array('language', 'timezone',),
            ),
        ),
    );

    /**
     * Before migration callback
     *
     * @param string $direction, up or down direction of migration process
     * @return boolean Should process continue
     * @access public
     */
    public function before($direction)
    {
        return true;
    }

    /**
     * After migration callback
     *
     * @param string $direction, up or down direction of migration process
     * @return boolean Should process continue
     * @access public
     */
    public function after($direction)
    {
        // apply system-default language & timezone to all current users
        ClassRegistry::init('User')->updateAll(array(
            'User.language' => '"' . AppConfig::read('System.language') . '"',
            'User.timezone' => '"' . AppConfig::read('System.timezone') . '"'
        ));
        return true;
    }

}
