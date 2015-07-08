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
 * User Model
 *
 * @property Client $Client
 * @property Attachment $Attachment
 * @property Comment $Comment
 */
class User extends AppModel
{

    /**
     * Holds this model's name
     * @var string 
     */
    public $name = 'User';

    /**
     * Contains this model's display field
     * @var string 
     */
    public $displayField = 'username';

    /**
     * Contains the behaviours that are attached to this model
     * @var array 
     */
    public $actsAs = array(
        'Upload.Upload' => array(
            'avatarpath' => array(
                'path' => 'uploads{DS}avatars{DS}',
                'thumbnailSizes' => array(
                    'thumb' => '80x80',
                ),
                'fields' => array('dir' => 'avatarpath_dir'),
                'deleteOnUpdate' => true,
                'thumbnailMethod' => 'php',
                'extensions' => array('jpg', 'jpeg', 'png', 'gif')
            )
        )
    );

    /**
     * Contains the validation rules for this model's data
     * @var array 
     */
    public $validate = array(
        'client_id' => array(
            'uuid' => array(
                'rule' => array('uuid'),
                'message' => 'Please select a client.'
            ),
        ),
        'department' => array(
            'uuid' => array(
                'rule' => array('uuid'),
                'message' => 'Please select a department.'
            ),
        ),
       
        'fname' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter a name.'
            ),
        ),
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Please enter a valid email address.'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'This email address has already been taken.'
            )
        ),
        'password' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter your password.',
                'allowEmpty' => false,
                'on' => 'create'
            ),
            'match' => array(
                'rule' => array('confirmPassword'),
                'message' => 'Passwords do not match.'),
            'minlength' => array(
                'rule' => array('minLength', 4),
                'message' => 'Must be at least 4 characters long.'
            )
        ),
        'password_confirm' => array(
            'minlength' => array(
                'rule' => array('minLength', 4),
                'message' => 'Must be at least 4 characters long.'),
            'match' => array(
                'rule' => array('confirmPassword'),
                'message' => 'Passwords do not match.'),
        ),
        'temp_password' => array(
            'alphanum' => array(
                'rule' => 'notempty',
                'message' => 'Please enter a temporary password.',
                'allowEmpty' => true,
                'on' => 'update'
            ),
        ),
        'role' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please select the user type.'
            ),
            'isinlist' => array(
                'rule' => array('inList', array(UserRoles::Admin, UserRoles::Client)),
                'message' => 'Please select a valid role.'
            )
        ),
        'active' => array(
            'boolean' => array(
                'rule' => array('boolean'),
                'message' => 'Please indicate whether this user is activated.'
            ),
        ),
        'avatarpath' => array(
            'validimage' => array(
                'rule' => array('validateExtension'),
                'message' => 'Please upload a valid image.'
            )
        ),
        'language' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please select the language.'
            )
        ),
        'timezone' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please select the timezone.'
            )
        ),
    );

    /**
     * Contains this model's belongsTo entity associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Client' => array(
            'className' => 'Client',
            'foreignKey' => 'client_id',
            'conditions' => '',
            'fields' => '',
            'counterCache' => true,
            'order' => ''
        ),
        'Department' => array(
            'className' => 'Department',
            'foreignKey' => 'department',
            'conditions' => '',
            'fields' => '',
            'counterCache' => true,
            'order' => ''
        )
    );

    /**
     * Contains this model's hasMany entity associations
     *
     * @var array
     */
    public $hasMany = array(
        'Attachment' => array(
            'className' => 'Attachment',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Notification' => array(
            'className' => 'Notification',
            'foreignKey' => 'project_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => 'Notification.created desc',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    /**
     * Contains this model's hasAndBelongsTo entity associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Project' => array(
            'className' => 'Project',
            'joinTable' => 'projects_users',
            'foreignKey' => 'user_id',
            'associationForeignKey' => 'project_id',
            'unique' => 'keepExisting',
            'with' => 'ProjectsUser',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        ),
    );

    function confirmPassword($data, $settings)
    {
        $valid = false;

        if (isset($this->data['User']['password_confirm']) && isset($this->data['User']['password'])
                && $this->data['User']['password_confirm'] == $this->data['User']['password'])
        {
            $valid = true;
        }

        return $valid;
    }

    public function validateExtension($data, $settings)
    {
        if (!isset($data['avatarpath']['name']) || trim($data['avatarpath']['name']) == '')
        {
            return true;
        }
        else
        {
            return preg_match('/^.*\.(jpg|jpeg|png|gif)$/i', $data['avatarpath']['name']) > 0;
        }
        return true;
    }

    public function beforeSave($options = array())
    {
        if (isset($this->data['User']['password']))
            if ($this->data['User']['password'] != '')
            {
                $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
                if (!isset($this->data['User']['temp_password']))
                    $this->data['User']['temp_password'] = null;
            }
            else
                unset($this->data['User']['password']);

        return parent::beforeSave($options);
    }

    public function beforeValidate($options = array())
    {
        if (isset($this->data['User']['id']))
        {
            if (!isset($this->data['User']['password']) || trim($this->data['User']['password']) == '')
                unset($this->data['User']['password']);
            if (!isset($this->data['User']['password_confirm']) || trim($this->data['User']['password_confirm']) == '')
                unset($this->data['User']['password_confirm']);
        }

        return parent::beforeValidate($options);
    }

    public function afterDelete()
    {
        $avatarFolder = AVATARBASE . $this->id;

        App::uses('Folder', 'Utility');

        $dir = new Folder($avatarFolder);
        $dir->delete();

        parent::afterDelete();
    }

    /**
     * Records the current user's activity on every request
     * @return void 
     */
    public function recordActivity()
    {
        $this->id = AuthComponent::user('id');
        $this->set(array(
            'lastactivity' => date('Y-m-d H:i:s'),
            'modified' => $this->field('modified')
        ));

        $this->save(null, array('callbacks' => false, 'validate' => false));
    }
    
   

}
