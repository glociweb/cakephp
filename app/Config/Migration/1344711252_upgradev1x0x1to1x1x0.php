<?php

class Upgradev1x0x1to1x1x0 extends CakeMigration
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
                    'Email-transport' => array('type' => 'string', 'null' => false, 'default' => 'mail', 'length' => 6, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8', 'after' => 'Uploads-extension_blacklist'),
                    'Email-host' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8', 'after' => 'Email-sender'),
                    'Email-port' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8', 'after' => 'Email-host'),
                    'Email-username' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8', 'after' => 'Email-port'),
                    'Email-password' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8', 'after' => 'Email-username'),
                    'Preview-max_width' => array('type' => 'integer', 'null' => false, 'default' => '260', 'length' => 6, 'after' => 'Email-invitationtext_text'),
                    'Preview-max_height' => array('type' => 'integer', 'null' => false, 'default' => '260', 'length' => 6, 'after' => 'Preview-max_width'),
                ),
                'phases' => array(
                    'client_can_update' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'after' => 'comment_count'),
                ),
                'projects' => array(
                    'archived' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'after' => 'date_end'),
                ),
            ),
        ),
        'down' => array(
            'drop_field' => array(
                'configurations' => array('Email-transport', 'Email-host', 'Email-port', 'Email-username', 'Email-password', 'Preview-max_width', 'Preview-max_height',),
                'phases' => array('client_can_update',),
                'projects' => array('archived',),
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
        return true;
    }

}
