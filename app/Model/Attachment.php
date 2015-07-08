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
 * Attachment Model
 *
 * @property User $User
 * @property Phase $Phase
 */
class Attachment extends AppModel
{

    /**
     * Holds this model's name
     * @var string 
     */
    public $name = 'Attachment';

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
        'Upload.Upload' => array(
            'file_name' => array(
                'path' => 'uploads{DS}attachments{DS}',
                'thumbnailSizes' => array(
                    'thumb' => '80x80',
                ),
                'fields' => array('dir' => 'file_dir', 'size' => 'file_size', 'type' => 'file_type'),
                'deleteOnUpdate' => true,
                'thumbnailMethod' => 'php',
            )
        )
    );

    /**
     * Contains the validation rules for this model's data
     * @var array 
     */
    public $validate = array(
        'phase_id' => array(
            'uuid' => array(
                'rule' => array('uuid'),
                'message' => 'Please select the phase.'
            ),
        ),
        'type' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'You have to select an attachment type.'
            ),
            'isinlist' => array(
                'rule' => array('inList', array(AttachmentType::Upload, AttachmentType::Url)),
                'message' => 'Please select a valid attachment type.'
            )
        ),
        'title' => array(
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
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'comment_id',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'counterCache' => true
        )
    );

    public function beforeSave($options = array())
    {
        if (isset($this->data['Attachment']['file_name']) && (($ext = pathinfo($this->data['Attachment']['file_name'], PATHINFO_EXTENSION)) != ''))
        {
            $this->data['Attachment']['file_extension'] = strtolower($ext);
        }

        return parent::beforeSave($options);
    }

    public function beforeValidate($options = array())
    {
        return parent::beforeValidate($options);
    }

    public function afterDelete()
    {
        $attachmentsFolder = ATTACHMENTBASE . $this->id;

        App::uses('Folder', 'Utility');

        $dir = new Folder($attachmentsFolder);
        $dir->delete();

        parent::afterDelete();
    }

    public function hasAccess($user = array(), $attachment_id = '')
    {
        $accessCheck = $this->find('first', array(
            'conditions' => array('Attachment.id' => $attachment_id),
            'fields' => array('id', 'comment_id'),
            'contain' => array(
                'Comment' => array(
                    'fields' => array('id', 'phase_id'),
                    'Phase' => array(
                        'fields' => array('id', 'project_id'),
                        'Project' => array(
                            'fields' => array('id', 'title'),
                            'Client' => array(
                                'fields' => array('id'),
                                'User' => array('fields' => array('id', 'client_id', 'username'), 'conditions' => array('User.id' => $user['id'])))))))
                ));

        $extrUser = Set::extract('Comment.Phase.Project.Client.{n}.User', $accessCheck);

        if ($extrUser === null)
            return false;
        else
            return !empty($extrUser);
    }

    /**
     * TODO: Format URLs before saving
     * @param string $url
     */
    private function formatUrl($url)
    {
        
    }

}
