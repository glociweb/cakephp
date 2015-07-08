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
App::uses('AppModel', 'Model');

/**
 * Comment Model
 *
 * @property Phase $Phase
 * @property User $User
 */
class Comment extends AppModel
{

    /**
     * Holds this model's name
     * @var string 
     */
    public $name = 'Comment';

    /**
     * Contains the behaviours that are attached to this model
     * @var array 
     */
    public $actsAs = array(
        'Notification' => array(
            'observeFields' => array('completed_date'),
            'observeCreate' => true,
            'projectScope' => array(
                'contain' => array('Phase' => 'Project'),
                'extractPath' => 'Phase.Project.id'),
    ));

    /**
     * Contains this model's display field
     * @var string 
     */
    public $displayField = 'content';

    function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        __('completed_date'); // For i18n-extraction
    }

    /**
     * Contains the validation rules for this model's data
     * @var array 
     */
    public $validate = array(
        'phase_id' => array(
            'uuid' => array(
                'rule' => array('uuid'),
                'message' => 'Please select a phase.'
            ),
        ),
        'content' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter a comment'
            ),
            'requireoncreate' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter a comment',
                'required' => true,
                'on' => 'create'
            ),
        ),
        'needsaction' => array(
            'boolean' => array(
                'rule' => array('boolean'),
                'message' => 'Please indicate whether this comment is a task.'
            ),
        ),
        'priority' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please select a priority.'
            ),
            'isinlist' => array(
                'rule' => array('inList', array(TaskPriority::Low, TaskPriority::Normal, TaskPriority::High)),
                'message' => 'Please select a valid priority.'
            )
        ),
    );

    /**
     * Contains this model's belongsTo entity associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Phase' => array(
            'className' => 'Phase',
            'foreignKey' => 'phase_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        ),
        'Parent' => array(
            'className' => 'Comment',
            'foreignKey' => 'parent_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * Contains this model's hasMany entity associations
     *
     * @var array
     */
    public $hasMany = array(
        'ChildComment' => array(
            'className' => 'Comment',
            'foreignKey' => 'parent_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'comment_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    public function getCommentRedirectUrl()
    {
        $phase = $this->find('first', array(
            'conditions' => array('Comment.id' => $this->id),
            'fields' => array('id', 'phase_id'),
            'contain' => array('Phase' => array('id', 'slug'))));

        $slug = Set::extract('Phase.slug', $phase);

        return array('controller' => 'projects', 'action' => 'phase', $slug, '#' => $this->id, 'admin' => false);
    }

    public function beforeValidate($options = array())
    {
        if (isset($this->data['Comment']['content']) && trim(str_replace('&nbsp;', ' ', strip_tags($this->data['Comment']['content']))) == '')
            unset($this->data['Comment']['content']);

        if (isset($this->data['Attachment'])) // Remove empty & disallowed attachments
        {
            foreach ($this->data['Attachment'] as $k => $attachment)
            {
                if ((!isset($attachment['file_name']['tmp_name']) || trim($attachment['file_name']['tmp_name']) == '') && (!isset($attachment['link_url']) || trim($attachment['link_url']) == ''))
                {
                    unset($this->data['Attachment'][$k]);
                }
                if (isset($attachment['file_name']['tmp_name']) && trim($attachment['file_name']['tmp_name']) != '')
                    if ($this->extIsBlacklisted($attachment))
                        unset($this->data['Attachment'][$k]);
            }
            $this->data['Attachment'] = array_merge($this->data['Attachment']);
        }

        parent::beforeValidate($options);
    }

    private function extIsBlacklisted($file = array())
    {
        if (empty($file))
            return false;

        $extBlacklist = AppConfig::read('Uploads.extension_blacklist');
        if ($extBlacklist == null || $extBlacklist == '')
            return false;

        $blackListString = implode('|', explode(',', $extBlacklist));

        return preg_match('/^.*\.(' . $blackListString . ')$/i', $file['file_name']['name']) > 0;
    }

    public function afterSave($created)
    {
        parent::afterSave($created);
        Cache::clearGroup('project', AppCaches::Project);
    }

    public function beforeDelete()
    {
        $this->Attachment->Behaviors->unload('Upload.Upload');
    }

    public function afterDelete()
    {
        parent::afterDelete();
        Cache::clearGroup('project', AppCaches::Project);
    }

    public function beforeFind($queryData)
    {
        if (AppAuth::is(UserRoles::Client))
        {
            $queryData['conditions'][] = array('Comment.admin_only' => false);
        }

        return $queryData;
    }

}
