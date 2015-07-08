<?php

class Upgradev1x1x0to1x1x5 extends CakeMigration
{

    /**
     * Migration description
     *
     * @var string
     * @access public
     */
    public $description = '';

    /**
     * Actions to be performed
     *
     * @var array $migration
     * @access public
     */
    public $migration = array(
        'up' => array(
            'create_field' => array(
                'configurations' => array(
                    'Email-activity_subject' => array('type' => 'string', 'null' => false, 'default' => 'Activity in Online Project Management', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8', 'after' => 'Email-invitationtext_text'),
                    'Email-progressactivity_text' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8', 'after' => 'Email-activity_subject'),
                    'Email-commentactivity_text' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8', 'after' => 'Email-progressactivity_text'),
                    'Email-taskactivity_text' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8', 'after' => 'Email-commentactivity_text'),
                ),
            ),
            'drop_field' => array(
                'configurations' => array('Email-invitationtext_html',),
            ),
        ),
        'down' => array(
            'drop_field' => array(
                'configurations' => array('Email-activity_subject', 'Email-progressactivity_text', 'Email-commentactivity_text', 'Email-taskactivity_text',),
            ),
            'create_field' => array(
                'configurations' => array(
                    'Email-invitationtext_html' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
                ),
            ),
        ),
    );

    /**
     * Before migration callback
     *
     * @param string $direction, up or down direction of migration process
     * @return boolean Should process continue
     * @access public
     */
    public function before($direction)
    {
        return true;
    }

    /**
     * After migration callback
     *
     * @param string $direction, up or down direction of migration process
     * @return boolean Should process continue
     * @access public
     */
    public function after($direction)
    {
        if ($direction == 'down')
            return true;

        $Configuration = ClassRegistry::init('Configuration');
        $configurationData = array();

        $configurationData['Configuration']['Email-progressactivity_text'] = __('Dear {UserName},
                
There has been some new activity in the project {ProjectName}.

{User} changed the progress of the phase {PhaseName} from {OldPercentage} to {NewPercentage}.

You can view the affected project phase here: {PhaseUrl}


Kind regards,
{SystemName}
');
        $configurationData['Configuration']['Email-commentactivity_text'] = __('Dear {UserName},
                
There has been some new activity in the project {ProjectName}.

{User} has created a new {CommentType} in the phase {PhaseName}.

You can view the {CommentType} here: {CommentUrl}


Kind regards,
{SystemName}
');
        $configurationData['Configuration']['Email-taskactivity_text'] = __('Dear {UserName},
                
There has been some new activity in the project {ProjectName}.

{User} has changed the status of a task in the phase {PhaseName} to {TaskStatus}.

You can view the task here: {CommentUrl}


Kind regards,
{SystemName}          
');

        $id = $Configuration->find('first');
        $id = $id['Configuration']['id'];
        $Configuration->id = $id;
        $Configuration->save($configurationData);

        return true;
    }

}
