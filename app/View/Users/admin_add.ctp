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
?>
<div class="users form">
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php
        echo $this->Form->input('client_id', array('label' => 'Client', 'options' => array(__('- Please select -'), __('Available Clients') => $clients), 'type' => 'select', 'value' => $selectedclient));
        echo $this->Form->input('department', array('label' => 'Departments', 'options' => array(__('- Please select -'), __('Available Departments') => $departments), 'type' => 'select'));
        echo $this->Form->input('fname', array('label' => __('First Name')));
        echo $this->Form->input('lname', array('label' => __('Last Name')));
        echo $this->Form->input('username', array('label' => __('Username')));
        echo $this->Form->input('email', array('label' => __('Email')));
        echo $this->Form->input('temp_password', array('label' => __('Temporary Password')));
        echo $this->Form->input('language', array('label' => __('System Language'), 'type' => 'select', 'options' => AppLanguages::getAll()));
        echo $this->Form->timezone('timezone', array('label' => __('System Timezone')));
        echo $this->Form->input('active', array('label' => __('Active')));
        echo $this->Form->input('receivenotifications', array('type' => 'checkbox', 'label' => __('Receive Email Notifications?')));
        ?>
    </fieldset>
    <div class="form-actions">
        <?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Save & Exit'), array('class' => 'btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
        <?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Save & Add New'), array('name' => 'add_new', 'class' => 'btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="ico-cancel"></i> ' . __('Cancel'), array('action' => 'index'), array('escape' => false, 'class' => 'btn')); ?>
    </div>    
    <?php echo $this->Form->end(); ?>
</div>
