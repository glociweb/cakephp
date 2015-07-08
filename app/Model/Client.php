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
 * Client Model
 *
 * @property User $User
 * @property Project $Project
 */
class Client extends AppModel
{

    /**
     * Holds this model's name
     * @var string 
     */
    public $name = 'Client';

    /**
     * Contains this model's display field
     * @var string 
     */
    public $displayField = 'title';

    /**
     * Contains the validation rules for this model's data
     * @var array 
     */
    public $validate = array(
        'title' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter the name of the client.'
            ),
        ),
        'user_count' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter a valid integer.'
            ),
        ),
    );

    /**
     * Contains this model's hasMany entity associations
     *
     * @var array
     */
    public $hasMany = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'client_id',
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

    /**
     * Contains this model's hasAndBelongsToMany entity associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Project' => array(
            'className' => 'Project',
            'joinTable' => 'projects_clients',
            'foreignKey' => 'client_id',
            'associationForeignKey' => 'project_id',
            'unique' => 'keepExisting',
            'fields' => '',
            'order' => 'Project.created DESC',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        )
    );

}
