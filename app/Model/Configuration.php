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
 * Configuration Model
 *
 */
class Configuration extends AppModel
{

    /**
     * Holds this model's name
     * @var string 
     */
    public $name = 'Configuration';

    /**
     * Contains the behaviours that are attached to this model
     * @var array 
     */
    public $actsAs = array(
        'Upload.Upload' => array(
            'System-logo_name' => array(
                'path' => 'uploads{DS}configurations{DS}',
                'fields' => array('dir' => 'System-logo_dir'),
                'deleteOnUpdate' => true,
                'thumbnailMethod' => 'php',
                'extensions' => array('jpg', 'jpeg', 'png', 'gif')
            )
        )
    );

    /**
     * Contains the validation rules for this model's data
     * @var array 
     */
    public $validate = array(
        'System-name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter the name of the system.'
            )
        ),
        'System-language' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please select the system language.'
            )
        ),
        'System-timezone' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please select the system timezone.'
            )
        ),
        'System-logo_name' => array(
            'validimage' => array(
                'rule' => array('validateExtension'),
                'message' => 'Please upload a valid image.'
            )
        ),
        'System-maintenance' => array(
            'boolean' => array(
                'rule' => array('boolean'),
                'message' => 'Please indicate a valid boolean value.',
                'allowEmpty' => true,
                'required' => false
            ),
        ),
        'Uploads-extension_blacklist' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter the extension blacklist'
            ),
        ),
        'Email-checked_default' => array(
            'boolean' => array(
                'rule' => array('boolean'),
                'message' => 'Please indicate a valid boolean value.',
                'allowEmpty' => true,
                'required' => false
            ),
        ),
        'Email-email' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter an email address.'
            ),
            'email' => array(
                'rule' => array('email'),
                'message' => 'Please enter a valid email address.'
            ),
        ),
        'Email-sender' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter a sender name.'
            )
        ),
        'Email-invitationtext_text' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter an email invitation template.',
                'allowEmpty' => false
            ),
            'placeholder' => array(
                'rule' => array('validatePlaceholders'),
                'message' => 'Please review the invitation email template.'
            )
        ),
        'Email-invitationsubject' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter the email invitation subject'
            ),
        ),
        'Email-activity_subject' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter the activity email subject'
            ),
        ),
        'Email-progressactivity_text' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter an email template.',
                'allowEmpty' => false
            ),
        ),
        'Email-commentactivity_text' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter an email template.',
                'allowEmpty' => false
            ),
        ),
        'Email-taskactivity_text' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter an email template.',
                'allowEmpty' => false
            ),
        ),
        'Color-topbar_fill' => array(
            'validcolor' => array(
                'rule' => '/^#([0-9a-f]{1,2}){3}$/i',
                'message' => 'This is not a valid colour.'
            ),
        ),
        'Color-topbar_text' => array(
            'validcolor' => array(
                'rule' => '/^#([0-9a-f]{1,2}){3}$/i',
                'message' => 'This is not a valid colour.'
            ),
        ),
        'Color-link' => array(
            'validcolor' => array(
                'rule' => '/^#([0-9a-f]{1,2}){3}$/i',
                'message' => 'This is not a valid colour.'
            ),
        ),
        'Layout-fluid' => array(
            'boolean' => array(
                'rule' => array('boolean'),
                'message' => 'Please indicate a valid boolean value.',
                'allowEmpty' => true,
                'required' => false
            ),
        ),
        'Misc-showpoweredby' => array(
            'boolean' => array(
                'rule' => array('boolean'),
                'message' => 'Please enter a valid boolean value.',
                'allowEmpty' => true,
                'required' => false
            ),
        ),
        'Preview-max_width' => array(
            'isnumber' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter a valid number.',
                'allowEmpty' => true,
                'required' => false
            ),
        ),
        'Preview-max_height' => array(
            'isnumber' => array(
                'rule' => array('numeric'),
                'message' => 'Please enter a valid number.',
                'allowEmpty' => true,
                'required' => false
            ),
        ),
    );

    public function __construct($id = false, $table = null, $ds = null)
    {
        App::uses('CakeTime', 'Utility');

        $this->validate['System-language']['isinlist'] = array(
            'rule' => array('inList', array_keys(AppLanguages::getAll())),
            'message' => 'Please select a valid language.'
        );

        $this->validate['System-timezone']['isinlist'] = array(
            'rule' => array('inList', array_keys(CakeTime::listTimezones(null, null, false))),
            'message' => 'Please select a valid timezone.'
        );

        parent::__construct($id, $table, $ds);
    }

    public function validateExtension($data)
    {
        if (!isset($data['System-logo_name']['name']) || trim($data['System-logo_name']['name']) == '')
        {
            return true;
        } else
        {
            return preg_match('/^.*\.(jpg|jpeg|png|gif)$/i', $data['System-logo_name']['name']) > 0;
        }
        return true;
    }

    public function validatePlaceholders()
    {
        if (isset($this->data['Configuration']['Email-invitationtext_text']) && trim($this->data['Configuration']['Email-invitationtext_text']) == '')
            return __('Please enter the invitation template.');

        $template = $this->data['Configuration']['Email-invitationtext_text'];

        if ((substr_count($template, '{StartIsNewUser}') + substr_count($template, '{EndIsNewUser}')) != 2)
            return __('You need to use the placeholders {StartIsNewUser} and {EndIsNewUser} one each.');

        if (substr_count($template, '{StartIsNewUser}') !== 1 && (substr_count($template, '{EndIsNewUser}')) !== 1)
            return __('You need to use each of the placeholders {StartIsNewUser} and {EndIsNewUser} only once.');

        if (strpos($template, '{StartIsNewUser}') > strpos($template, '{EndIsNewUser}'))
            return __('{EndIsNewUser} has to be inserted after {StartIsNewUser}');

        return true;
    }

    public function afterSave($created)
    {
        parent::afterSave($created);
        Cache::delete('AppConfigurationCache');
    }

    public function beforeValidate($options = array())
    {
        return parent::beforeValidate($options);
    }

    public function beforeSave($options = array())
    {
        if (isset($this->data['Configuration']['Uploads-extension_blacklist']) && $this->data['Configuration']['Uploads-extension_blacklist'] != '')
        {
            $expl = explode(',', $this->data['Configuration']['Uploads-extension_blacklist']);
            $out = array();
            foreach ($expl as $v)
                if (str_replace('.', '', str_replace(' ', '', $v)) != '')
                    $out[] = str_replace('.', '', str_replace(' ', '', $v));

            $this->data['Configuration']['Uploads-extension_blacklist'] = implode(',', $out);
        }
        return parent::beforeSave($options);
    }

}
