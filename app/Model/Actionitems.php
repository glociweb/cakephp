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
class Actionitems extends AppModel
{
	/**
     * Holds this model's name
     * @var string 
     */
    public $name = 'Actionitems';
	public $foreignKey = 'project_id';
    /**
     * Contains this model's display field
     * @var string 
     */
    
	public $displayField = 'action_content';
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
    public $validate = array(
    'action_content' => array(
        'rule' => 'isUnique',
        'message' => 'This action content has already been taken.'
    )
	);
    /**
     * Contains this model's hasMany entity associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Project' => array(
            'className' => 'Project',
            'foreignKey' => 'project_id',
            'joinTable' => 'actionitems',
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
        'Notes' => array(
            'className' => 'Notes',
            'foreignKey' => false,
            'joinTable' => 'actionitems',
            'unique' => 'keepExisting',
            'conditions' => array(
                 'Notes.note_code = Actionitems.note_code'
             ),
            'associatedKey' => 'note_code',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        )
    );
    public $hasMany = array(
            'Action' => array(
                'className' => 'Action',
                'conditions' => '',
                'dependent' => true,
                'foreignKey'   => 'type_id',
                'associatedKey'   => 'type_id'
            )
        );
  }

