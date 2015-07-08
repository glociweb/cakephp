<?php

class Upgradev1x2x1to1x2x9 extends CakeMigration
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
            'alter_field' => array(
                'phases' => array(
                    'date_start' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
                    'date_end' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
                ),
                'projects' => array(
                    'date_start' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
                    'date_end' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
                ),
            ),
            'create_field' => array(
                'users' => array(
                    'receivenotifications' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'after' => 'active'),
                ),
            ),
        ),
        'down' => array(
            'alter_field' => array(
                'phases' => array(
                    'date_start' => array('type' => 'date', 'null' => false, 'default' => NULL),
                    'date_end' => array('type' => 'date', 'null' => false, 'default' => NULL),
                ),
                'projects' => array(
                    'date_start' => array('type' => 'date', 'null' => true, 'default' => NULL),
                    'date_end' => array('type' => 'date', 'null' => true, 'default' => NULL),
                ),
            ),
            'drop_field' => array(
                'users' => array('receivenotifications',),
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
