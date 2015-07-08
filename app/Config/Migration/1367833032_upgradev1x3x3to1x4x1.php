<?php

class Upgradev1x3x3to1x4x1 extends CakeMigration
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
                'comments' => array(
                    'admin_only' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'after' => 'attachment_count'),
                ),
            ),
        ),
        'down' => array(
            'drop_field' => array(
                'comments' => array('admin_only',),
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
