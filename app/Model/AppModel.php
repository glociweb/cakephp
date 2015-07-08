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
App::uses('Model', 'Model');

/**
 * Application-wide model
 */
class AppModel extends Model
{

    /**
     * Contains the behaviours that are attached to this model
     * @var array 
     */
    public $actsAs = array('Containable', 'Setnull');

    /**
     * Indicates this model's recursion level
     * @var int 
     */
    public $recursive = -1;

    public function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table, $ds);
    }

    /**
     * Handles application-wide data manipulation before saving
     * @param array $options The save-options array
     * @return boolean True of sucessful, else false
     */
    public function beforeSave($options = array())
    { 
        if (Configure::read('demo') === true)
        {
            AppController::$demoBlocked = true;
            return false;
        }

        if ($this->hasField('user_id') && !isset($this->data[$this->alias]['user_id']) && (!isset($this->data[$this->alias]['id'])))
            $this->data[$this->alias]['user_id'] = AuthComponent::user('id');

        return true;
    }

    public function beforeDelete($cascade = true)
    {   
        if (Configure::read('demo') === true)
        {
            AppController::$demoBlocked = true;
            return false;
        }
        return parent::beforeDelete($cascade);
    }

    public function afterFind($data)
    {
        return $data;
    }

}