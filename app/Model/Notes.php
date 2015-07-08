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
class Notes extends AppModel
{
	/**
     * Holds this model's name
     * @var string 
     */
    public $name = 'Notes';
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
        'Notescomment' => array(
            'className' => 'Notescomment',
            'foreignKey' => 'note_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => '',
            'order' => 'Notescomment.created DESC'
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
   
   public function getNotes($id)
    {

        $commentConditions = array();
        $commentConditions[] = array('Notescomment.parent_id' => 0);

        $childCommentConditions = array();

        return $this->find('first', array(
					
                    'conditions' => array('id' => $id),
                    'contain' => array(
                        'Notescomment' => array(
                            'conditions' => $commentConditions,
							'User',
							'ChildComment' => array('Attachment', 'User', 'conditions' => $childCommentConditions)
                        )
                        )
                        
                        ));
    }
    
    
}
