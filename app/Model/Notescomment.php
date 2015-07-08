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
class Notescomment extends AppModel
{

    /**
     * Holds this model's name
     * @var string 
     */
    public $name = 'Notescomment';

    /**
     * Contains the behaviours that are attached to this model
     * @var array 
     */
    public $actsAs = array(
        'Notification' => array(
            'observeFields' => array('completed_date'),
            'observeCreate' => true,
            
    ));
   

    /**
     * Contains this model's display field
     * @var string 
     */
    public $displayField = 'content';

    
    /**
     * Contains the validation rules for this model's data
     * @var array 
     */
    public $validate = array(
        'note_id' => array(
            'uuid' => array(
                'rule' => array('uuid'),
                'message' => 'Please select a note.'
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
       
        
    );

    /**
     * Contains this model's belongsTo entity associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Note' => array(
            'className' => 'Note',
            'foreignKey' => 'note_id',
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
            'className' => 'Notescomment',
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
        $note = $this->find('first', array(
            'conditions' => array('Notescomment.id' => $this->id),
            'fields' => array('id', 'note_id'),
            'contain' => array('Note' => array('id', 'slug'))));

        $id = Set::extract('Note.id', $note);
		if (AppAuth::is(UserRoles::Admin))
        {
			return array('controller' => 'notes', 'action' => 'view', $id, '#' => $this->id, 'admin' => true);
		}
        return array('controller' => 'notes', 'action' => 'view', $id, '#' => $this->id, 'admin' => false);
    }


}
