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
class Orgcharts extends AppModel
{
	/**
     * Holds this model's name
     * @var string 
     */
    public $name = 'Orgcharts';
     
   

    /**
     * Contains this model's hasMany entity associations
     *
     * @var array
     */
    public $hasMany = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => '',
   
        )
    );
 }
