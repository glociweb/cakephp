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
 * Project Model
 *
 * @property Phase $Phase
 * @property Client $Client
 */
class Dashboard extends AppModel
{
	/**
     * Holds this model's name
     * @var string 
     */
    public $name = 'Dashboard';

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
        'Utility.Sluggable',
        'Notification' => array(
            'observeCreate' => true
        )
    );
    
    /**
     * Contains this model's hasMany entity associations
     *
     * @var array
     */
    public $hasMany = array(
        'Phase' => array(
            'className' => 'Phase',
            'foreignKey' => 'project_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => 'Phase.position asc',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Notification' => array(
            'className' => 'Notification',
            'foreignKey' => 'project_id',
            'dependent' => true,
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
        'Client' => array(
            'className' => 'Client',
            'joinTable' => 'projects_clients',
            'foreignKey' => 'project_id',
            'associationForeignKey' => 'client_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        ),
        'User' => array(
            'className' => 'User',
            'joinTable' => 'projects_users',
            'foreignKey' => 'project_id',
            'associationForeignKey' => 'user_id',
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
    
    /**
     * Returns the project dashboard for when viewing a project in the front-end
     * @param type $project_slug
     * @return array
     */
    public function getprojectnotifications()
    {
        return $this->find('all', array(
                    'conditions' => array('Project.slug' => $project_slug),
                    'contain' => array(
                        'Notification' => array('limit' => 10, 'order' => 'Notification.created DESC', 'User', 'Phase'),
                        'Phase' => array('id', 'slug', 'title', 'description', 'date_start', 'date_end', 'percent_completed', 'position'),
                        'Client' => array('User' => array('id', 'client_id', 'role', 'username', 'lastactivity', 'avatarpath')),
                        'User'
        )));
    }

