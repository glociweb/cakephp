<?php

class Upgradev1x2x9to1x3x3 extends CakeMigration
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
            'drop_field' => array(
                'attachments' => array('indexes' => array('attachment_to_user', 'attachment_to_comment')),
                'comments' => array('indexes' => array('comment_to_user', 'comment_to_phase')),
                'notifications' => array('indexes' => array('notification_to_project', 'notification_to_user', 'notification_to_phase')),
                'phases' => array('indexes' => array('phase_to_project')),
                'projects_clients' => array('indexes' => array('projects_client_to_project', 'projects_client_to_client')),
                'users' => array('indexes' => array('user_to_client')),
            ),
            'create_field' => array(
                'attachments' => array(
                    'indexes' => array(
                        'attachment_to_user_idx' => array('column' => 'user_id', 'unique' => 0),
                        'attachment_to_comment_idx' => array('column' => 'comment_id', 'unique' => 0),
                    ),
                ),
                'comments' => array(
                    'indexes' => array(
                        'comment_to_user_idx' => array('column' => 'user_id', 'unique' => 0),
                        'comment_to_phase_idx' => array('column' => 'phase_id', 'unique' => 0),
                    ),
                ),
                'configurations' => array(
                    'System-comments_desc' => array('type' => 'boolean', 'null' => false, 'default' => '1', 'after' => 'System-logo_dir'),
                ),
                'notifications' => array(
                    'indexes' => array(
                        'notification_to_project_idx' => array('column' => 'project_id', 'unique' => 0),
                        'notification_to_user_idx' => array('column' => 'user_id', 'unique' => 0),
                        'notification_to_phase_idx' => array('column' => 'phase_id', 'unique' => 0),
                    ),
                ),
                'phases' => array(
                    'indexes' => array(
                        'phase_to_project_idx' => array('column' => 'project_id', 'unique' => 0),
                    ),
                ),
                'projects_clients' => array(
                    'indexes' => array(
                        'projects_client_to_project_idx' => array('column' => 'project_id', 'unique' => 0),
                        'projects_client_to_client_idx' => array('column' => 'client_id', 'unique' => 0),
                    ),
                ),
                'users' => array(
                    'indexes' => array(
                        'user_to_client_idx' => array('column' => 'client_id', 'unique' => 0),
                    ),
                ),
            ),
            'create_table' => array(
                'projects_users' => array(
                    'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
                    'project_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8', 'after' => 'id'),
                    'user_id' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8', 'after' => 'project_id'),
                    'indexes' => array(
                        'PRIMARY' => array('column' => 'id', 'unique' => 1),
                        'fk_cm_projects_users_cm_projects1_idx' => array('column' => 'project_id', 'unique' => 0),
                        'fk_cm_projects_users_cm_users1_idx' => array('column' => 'user_id', 'unique' => 0),
                    ),
                    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB'),
                ),
            ),
        ),
        'down' => array(
            'create_field' => array(
                'attachments' => array(
                    'indexes' => array(
                        'attachment_to_user' => array('column' => 'user_id', 'unique' => 0),
                        'attachment_to_comment' => array('column' => 'comment_id', 'unique' => 0),
                    ),
                ),
                'comments' => array(
                    'indexes' => array(
                        'comment_to_user' => array('column' => 'user_id', 'unique' => 0),
                        'comment_to_phase' => array('column' => 'phase_id', 'unique' => 0),
                    ),
                ),
                'notifications' => array(
                    'indexes' => array(
                        'notification_to_project' => array('column' => 'project_id', 'unique' => 0),
                        'notification_to_user' => array('column' => 'user_id', 'unique' => 0),
                        'notification_to_phase' => array('column' => 'phase_id', 'unique' => 0),
                    ),
                ),
                'phases' => array(
                    'indexes' => array(
                        'phase_to_project' => array('column' => 'project_id', 'unique' => 0),
                    ),
                ),
                'projects_clients' => array(
                    'indexes' => array(
                        'projects_client_to_project' => array('column' => 'project_id', 'unique' => 0),
                        'projects_client_to_client' => array('column' => 'client_id', 'unique' => 0),
                    ),
                ),
                'users' => array(
                    'indexes' => array(
                        'user_to_client' => array('column' => 'client_id', 'unique' => 0),
                    ),
                ),
            ),
            'drop_field' => array(
                'attachments' => array('indexes' => array('attachment_to_user_idx', 'attachment_to_comment_idx')),
                'comments' => array('indexes' => array('comment_to_user_idx', 'comment_to_phase_idx')),
                'configurations' => array('System-comments_desc',),
                'notifications' => array('indexes' => array('notification_to_project_idx', 'notification_to_user_idx', 'notification_to_phase_idx')),
                'phases' => array('indexes' => array('phase_to_project_idx')),
                'projects_clients' => array('indexes' => array('projects_client_to_project_idx', 'projects_client_to_client_idx')),
                'users' => array('indexes' => array('user_to_client_idx')),
            ),
            'drop_table' => array(
                'projects_users'
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
