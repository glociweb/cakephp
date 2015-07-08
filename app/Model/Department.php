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
class Department extends AppModel
{

    /**
     * Holds this model's name
     * @var string 
     */
    public $name = 'Department';

    /**
     * Contains this model's display field
     * @var string 
     */
    public $displayField = 'dep_name';

    /**
     * Contains the behaviours that are attached to this model
     * @var array 
     */
	 public $actsAs = array(
        
    );
    
    /**
     * Contains the validation rules for this model's data
     * @var array 
     */
    public $validate = array(
        'dep_head' => array(
            'uuid' => array(
                'rule' => array('uuid'),
                'message' => 'Please select a head.'
            ),
        ),
        'dep_name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter a Departmant name.'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'This Department has already been taken.'
            )
        ),
       
    );
    /**
     * Contains this model's belongsTo entity associations
     *
     * @var array
     */
  
     public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'dep_head',
            'dependent' => false,
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
}
