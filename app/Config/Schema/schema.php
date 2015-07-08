<?php

class AppSchema extends CakeSchema
{

    public function before($event = array())
    {
        return true;
    }

    public function after($event = array())
    {
        
    }

    public $attachments = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'user_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'comment_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 40, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'title' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'link_url' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'file_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'file_type' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'file_dir' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'file_size' => array('type' => 'integer', 'null' => true, 'default' => null),
        'file_extension' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 40, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1),
            'attachment_to_user_idx' => array('column' => 'user_id', 'unique' => 0),
            'attachment_to_comment_idx' => array('column' => 'comment_id', 'unique' => 0)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );
    public $clients = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 60, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'user_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 6),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );
    public $comments = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'phase_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'parent_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'user_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'content' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'needsaction' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
        'priority' => array('type' => 'string', 'null' => false, 'default' => 'normal', 'length' => 6, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'completed_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'completed_ip' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'attachment_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 6),
        'admin_only' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1),
            'comment_to_user_idx' => array('column' => 'user_id', 'unique' => 0),
            'comment_to_phase_idx' => array('column' => 'phase_id', 'unique' => 0)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );
    public $configurations = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'System-name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'System-language' => array('type' => 'string', 'null' => false, 'default' => 'en-gb', 'length' => 10, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'System-timezone' => array('type' => 'string', 'null' => false, 'default' => 'Europe/London', 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'System-logo_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'System-logo_dir' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'System-comments_desc' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
        'System-maintenance' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
        'Uploads-extension_blacklist' => array('type' => 'string', 'null' => false, 'default' => 'exe,bat', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'Email-checked_default' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
        'Email-transport' => array('type' => 'string', 'null' => false, 'default' => 'mail', 'length' => 6, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'Email-email' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'Email-sender' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'Email-host' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'Email-port' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'Email-username' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'Email-password' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'Email-invitationsubject' => array('type' => 'string', 'null' => false, 'default' => 'Invitation to Online Project Management', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'Email-invitationtext_text' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'Email-activity_subject' => array('type' => 'string', 'null' => false, 'default' => 'Activity in Online Project Management', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'Email-progressactivity_text' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'Email-commentactivity_text' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'Email-taskactivity_text' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'Preview-max_width' => array('type' => 'integer', 'null' => false, 'default' => '260', 'length' => 6),
        'Preview-max_height' => array('type' => 'integer', 'null' => false, 'default' => '260', 'length' => 6),
        'Color-topbar_fill' => array('type' => 'string', 'null' => false, 'default' => '#2c2c2c', 'length' => 7, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'Color-topbar_text' => array('type' => 'string', 'null' => false, 'default' => '#999999', 'length' => 7, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'Color-link' => array('type' => 'string', 'null' => false, 'default' => '#0088cc', 'length' => 7, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'Layout-fluid' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
        'Misc-showpoweredby' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );
    public $notifications = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'project_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'phase_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'user_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'model' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 40, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'foreign_key' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'title' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'action' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 40, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'field' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 40, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'value_new' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'value_old' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'deleted' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1),
            'notification_to_project_idx' => array('column' => 'project_id', 'unique' => 0),
            'notification_to_user_idx' => array('column' => 'user_id', 'unique' => 0),
            'notification_to_phase_idx' => array('column' => 'phase_id', 'unique' => 0)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );
    public $phases = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'project_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'title' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'slug' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'description' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'position' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 6),
        'percent_completed' => array('type' => 'integer', 'null' => false, 'default' => '0'),
        'date_start' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'date_end' => array('type' => 'datetime', 'null' => false, 'default' => null),
        'comment_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 6),
        'client_can_update' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1),
            'phase_to_project_idx' => array('column' => 'project_id', 'unique' => 0)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );
    public $projects = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'title' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'slug' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'description' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'phase_count' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 6),
        'percent_completed' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '5,2'),
        'date_start' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'date_end' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'archived' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );
    public $projects_clients = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'project_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'client_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1),
            'projects_client_to_project_idx' => array('column' => 'project_id', 'unique' => 0),
            'projects_client_to_client_idx' => array('column' => 'client_id', 'unique' => 0)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );
    public $projects_users = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'project_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'user_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1),
            'fk_cm_projects_users_cm_projects1_idx' => array('column' => 'project_id', 'unique' => 0),
            'fk_cm_projects_users_cm_users1_idx' => array('column' => 'user_id', 'unique' => 0)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );
    public $users = array(
        'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'client_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 36, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'username' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 60, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'password' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 40, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'temp_password' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 40, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'role' => array('type' => 'string', 'null' => false, 'default' => 'client', 'length' => 20, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'active' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
        'receivenotifications' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
        'avatarpath' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'avatarpath_dir' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'lastactivity' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'language' => array('type' => 'string', 'null' => false, 'default' => 'en-gb', 'length' => 10, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'timezone' => array('type' => 'string', 'null' => false, 'default' => 'Europe/London', 'length' => 50, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'indexes' => array(
            'PRIMARY' => array('column' => 'id', 'unique' => 1),
            'user_to_client_idx' => array('column' => 'client_id', 'unique' => 0)
        ),
        'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
    );

}
