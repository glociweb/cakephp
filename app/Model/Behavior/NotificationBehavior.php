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

/**
 * Handles the automatic notification system
 */
class NotificationBehavior extends ModelBehavior
{

    public $settings = array();
    public $mapMethods = array();

    /**
     * The bahaviour's default settings
     * @var array 
     */
    protected $_defaults = array(
        'observeFields' => array(),
        'observeCreate' => false,
        'projectScope' => array(
            'contain' => array(),
            'extractPath' => ''
        ),
    );

    /**
     * Sets-up the behaviour
     * @param Model $model
     * @param array $config The passed configuration
     */
    public function setup(Model $model, $config = array())
    {
        $this->settings[$model->alias] = array_merge($this->_defaults, $config);
    }

    /**
     * Behaviour clean-up
     * @param Model $model
     */
    public function cleanup(Model &$model)
    {
        if (isset($this->settings[$model->alias]))
        {
            unset($this->settings[$model->alias]);
        }
    }

    private $fieldsToSave = array();
    private $newRecord = array();

    public function beforeSave(Model &$model)
    {

        foreach ($this->settings[$model->alias]['observeFields'] as $field)
        {
            if (array_key_exists($field, $model->data[$model->alias]))
                $this->fieldsToSave[$field] = array('new' => $model->data[$model->alias][$field], 'old' => $model->field($field));
        }

        if (!isset($model->data[$model->alias]['id']))
        {
            $this->processCreate($model);
        }

        return true;
    }

    public function afterSave(Model &$model, $created)
    {
        if ($created === false)
            $this->processUpdate($model);
        else if ($this->settings[$model->alias]['observeCreate'] === true)
        {
            $notification = $this->newRecord;
            $notification['foreign_key'] = $model->id;
            $notification['title'] = substr(strip_tags($model->field($model->displayField)), 0, 250);

            if ($model->alias == 'Project')
                $notification['project_id'] = $model->id;
            else if ($model->hasField('project_id'))
                $notification['project_id'] = $model->field('project_id');
            else if (!empty($this->settings[$model->alias]['projectScope']['contain']) && $this->settings[$model->alias]['projectScope']['contain'] != '')
            {
                $project = $model->find('first', array(
                    'conditions' => array($model->alias . '.id' => $model->id),
                    'contain' => $this->settings[$model->alias]['projectScope']['contain']));

                $notification['project_id'] = Set::extract($this->settings[$model->alias]['projectScope']['extractPath'], $project);
            }

            if ($model->alias == 'Phase')
                $notification['phase_id'] = $model->id;
            else if ($model->hasField('phase_id'))
                $notification['phase_id'] = $model->field('phase_id');

            if (isset($notification['project_id']))
                ClassRegistry::init('Notification')->save($notification);
        }
        return true;
    }

    private function processCreate(Model $model)
    {
        $notification['user_id'] = AppAuth::user('id');
        $notification['model'] = $model->alias;
        $notification['action'] = 'create';

        $this->newRecord = $notification;
    }

    private function processUpdate(Model $model)
    {
        $notifications = array();

        $project_id = null;
        if ($model->alias == 'Project')
            $project_id = $model->id;
        else if ($model->hasField('project_id'))
            $project_id = $model->field('project_id');
        else if (!empty($this->settings[$model->alias]['projectScope']['contain']) && $this->settings[$model->alias]['projectScope']['contain'] != '')
        {
            $project = $model->find('first', array(
                'conditions' => array($model->alias . '.id' => $model->id),
                'contain' => $this->settings[$model->alias]['projectScope']['contain']));

            $project_id = Set::extract($this->settings[$model->alias]['projectScope']['extractPath'], $project);
        }

        $phase_id = null;
        if ($model->alias == 'Phase')
            $phase_id = $model->id;
        else if ($model->hasField('phase_id'))
            $phase_id = $model->field('phase_id');

        foreach ($this->fieldsToSave as $field => $fieldData)
        {
            $notification = array();

            $notification['project_id'] = $project_id;
            $notification['phase_id'] = $phase_id;
            $notification['title'] = substr(strip_tags($model->field($model->displayField)), 0, 250);
            $notification['user_id'] = AppAuth::user('id');
            $notification['model'] = $model->alias;
            $notification['foreign_key'] = $model->id;
            $notification['field'] = $field;
            $notification['value_new'] = $fieldData['new'];
            $notification['value_old'] = $fieldData['old'];
            $notification['action'] = 'update';

            $notifications[] = $notification;
        }
        if (!empty($notifications) && isset($notification['project_id']))
            ClassRegistry::init('Notification')->saveAll($notifications);
    }

    public function beforeDelete(Model &$model, $cascade = true)
    {
        return ClassRegistry::init('Notification')->beforeDelete();
    }

    /**
     * Cleans-up the notifications that have become obsolete.
     * @param Model $model
     */
    public function afterDelete(Model &$model)
    {
        ClassRegistry::init('Notification')->updateAll(array('Notification.deleted' => true, 'Notification.foreign_key' => null), array(
            'Notification.foreign_key' => $model->id,
            'Notification.model' => $model->name,
        ));
    }

}