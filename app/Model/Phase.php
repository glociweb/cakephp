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
 * Phase Model
 *
 * @property Project $Project
 * @property Attachment $Attachment
 * @property Comment $Comment
 */
class Phase extends AppModel
{

    /**
     * Holds this model's name
     * @var string 
     */
    public $name = 'Phase';

    /**
     * Contains this model's display field
     * @var string 
     */
    public $displayField = 'title';

    /**
     * Contains the behaviours that are attached to this model
     * @var array 
     */
    public $actsAs = array(
        'Utility.List' => array(
            'positionColumn' => 'position',
            'scope' => 'project_id',
            'validate' => false,
            'callbacks' => false),
        'Utility.Sluggable',
        'Notification' => array(
            'observeFields' => array('percent_completed'),
            'observeCreate' => true
    ));

    public function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
        __('percent_completed'); // For i18n-extraction

        if (AppConfig::read('System.comments_desc') === true)
            $this->hasMany['Comment']['order'] = 'Comment.created DESC';
        else
            $this->hasMany['Comment']['order'] = 'Comment.created ASC';
    }

    /**
     * Contains the validation rules for this model's data
     * @var array 
     */
    public $validate = array(
        'project_id' => array(
            'uuid' => array(
                'rule' => array('uuid'),
                'message' => 'Please select a project.'
            ),
        ),
        'title' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter a name.'
            ),
            'maxlength' => array(
                'rule' => array('maxLength', 240),
                'message' => 'Please enter less than 240 characters.'
            )
        ),
        'slug' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter a valid Url segment.'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'This Url has already been taken.'
            ),
            'validslug' => array(
                'rule' => '/^[a-z0-9-_]+$/',
                'message' => 'Please enter a valid Url segment.'
            )
        ),
        'percent_completed' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter a valid percentage.'
            ),
            'between' => array(
                'rule' => array('range', -1, 101),
                'message' => 'Please enter a valid percentage.'
            )
        ),
        'comment_count' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter a valid integer.'
            ),
        ),
        'date_start' => array(
            'isdate' => array(
                'rule' => array('date', 'ymd'),
                'message' => 'Please enter a valid date (yyyy-mm-dd).'
            )
        ),
        'date_end' => array(
            'isdate' => array(
                'rule' => array('date', 'ymd'),
                'message' => 'Please enter a valid date (yyyy-mm-dd).'
            ),
            'isafterstartdate' => array(
                'rule' => array('checkStartEndDate', array('date_start')),
                'message' => 'The end date has to be on or after the start date'
            )
        )
    );

    /**
     * Contains this model's belongsTo entity associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Project' => array(
            'className' => 'Project',
            'foreignKey' => 'project_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        )
    );

    /**
     * Contains this model's hasMany entity associations
     *
     * @var array
     */
    public $hasMany = array(
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'phase_id',
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
        'Notification' => array(
            'className' => 'Notification',
            'foreignKey' => 'phase_id',
            'dependent' => true,
            'fields' => '',
            'order' => 'Notification.created DESC',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
    );

    public function hasAccess($user = array(), $phase_slug = '')
    {
        $accessCheck = $this->find('first', array(
            'conditions' => array('Phase.slug' => $phase_slug),
            'contain' => array(
                'Project' => array(
                    'fields' => array('id', 'slug'),
                    'ProjectsClient',
                    'Client' => array(
                        'fields' => array('id'),
                        'User' => array('fields' => array('id', 'client_id', 'username'), 'conditions' => array('User.id' => $user['id']))))),
        ));
        $extrUser = Set::extract('Project.Client.{n}.User', $accessCheck);
        return !empty($extrUser);
    }

    public function afterSave($created)
    {
        parent::afterDelete($created);
        $this->updatePercentCompleted();
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $this->updatePercentCompleted();
    }

    public function updatePercentCompleted()
    {
        $project_id = $this->field('project_id');

        $phases = $this->find('all', array(
            'recursive' => -1,
            'conditions' => array('Phase.project_id' => $project_id),
            'fields' => array('id', 'percent_completed', 'date_start', 'date_end'),
            'order' => 'Phase.position ASC'
        ));

        if (!$phases)
            return;

        $firstPhase = AppLib::arrayFirstEntry($phases);
        $lastPhase = AppLib::arrayLastEntry($phases);

        $sum = 0;
        foreach ($phases as $phase)
            $sum += $phase['Phase']['percent_completed'];

        $percentage = ($sum / count($phases));

        $this->Project->id = $project_id;
        $this->Project->set(array(
            'percent_completed' => $percentage,
            'date_start' => $firstPhase['Phase']['date_start'],
            'date_end' => $lastPhase['Phase']['date_end'],
            'modified' => $this->Project->field('modified') // don't change "modified"
        ));

        $this->Project->save(null, array('callbacks' => false, 'validate' => false));
    }

    public function checkStartEndDate($data = null, $settings = null)
    {
        $dateStart = strtotime($this->data['Phase']['date_start']);
        $dateEnd = strtotime($data['date_end']);

        if ($dateStart > $dateEnd)
            return __('The end date has to be on or after the start date.');

        return true;
    }

    /**
     * Returns the metadata for activity update emails
     * @param type $phase_id
     * @return array Metadata
     */
    public function getMetaDataForActivityEmail($phase_id = null)
    {
        $phase = $this->find('first', array('conditions' => array('Phase.id' => $phase_id), 'fields' => array('id', 'title', 'slug', 'project_id')));

        $project = $this->Project->find('first', array('conditions' => array('Project.id' => $phase['Phase']['project_id']), 'fields' => array('id', 'title', 'slug'), 'contain' => array('Client' => array('fields' => array('id'), 'User' => array('conditions' => array('User.id !=' => AppAuth::user('id')), 'fields' => array('id', 'username', 'email', 'role', 'receivenotifications'))))));

        $users = array();
        foreach ($project['Client'] as $client)
            foreach ($client['User'] as $user)
                $users[] = $user;

        $admins = $this->Comment->User->find('all', array('conditions' => array('User.role' => UserRoles::Admin, 'User.id !=' => AppAuth::user('id')), 'fields' => array('id', 'username', 'email', 'role', 'receivenotifications')));
        foreach ($admins as $admin)
            $users[] = $admin['User'];

        $usersWantingNotifications = array();

        foreach ($users as $user)
            if ($user['receivenotifications'] === true)
                $usersWantingNotifications[] = $user;

        return array('User' => $usersWantingNotifications, 'Project' => $project['Project'], 'Phase' => $phase['Phase']);
    }

    public function getAllUserPhases($conditions = array())
    {
        $client_id = AppAuth::user('client_id');

        $projects = $this->Project->Client->find('first', array(
            'conditions' => array('Client.id' => $client_id),
            'contain' => array('Project' => array(
                    'conditions' => array('Project.archived' => false),
                    'fields' => 'Project.id'
        ))));

        if (!$projects)
            return $this->find('all', array('conditions' => $conditions, 'conditions' => array('Project.archived' => false), 'contain' => array('Project' => 'title')));

        $project_ids = array();
        foreach ($projects['Project'] as $proj)
            $project_ids[] = $proj['id'];

        $newConditions = (AppAuth::is(UserRoles::Admin) ? $conditions : Hash::merge($conditions, array('Phase.project_id' => $project_ids)));

        return $this->find('all', array('conditions' => $newConditions, 'contain' => array('Project' => 'title')));
    }

    public function beforeSave($options = array())
    {
        if (!parent::beforeSave($options))
            return false;

        App::import('Utility', 'CakeTime');
        if (isset($this->data[$this->alias]['date_start']))
        {
            $start = $this->data[$this->alias]['date_start'] . ' 00:00';
            $this->data[$this->alias]['date_start'] = CakeTime::toServer($start, AppAuth::user('timezone'));
        }
        if (isset($this->data[$this->alias]['date_end']))
        {
            $end = $this->data[$this->alias]['date_end'] . ' 00:00';
            $this->data[$this->alias]['date_end'] = CakeTime::toServer($end, AppAuth::user('timezone'));
        }
        return true;
    }

}
