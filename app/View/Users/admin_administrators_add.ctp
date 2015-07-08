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
        <legend><?php echo __('Add Administrator'); ?></legend>
        <?php
        echo $this->Form->input('username', array('label' => __('Username')));
        echo $this->Form->input('fname', array('label' => __('First Name')));
        echo $this->Form->input('lname', array('label' => __('Last Name')));
        echo $this->Form->input('role', array('label' => __('Select Role'), 'type' => 'select', 'options' => UserRoles::getAdmins()));
        echo $this->Form->input('email', array('label' => __('Email')));
        echo $this->Form->input('password', array('label' => __('Password'), 'type' => 'password', 'value' => '', 'placeholder' => __('Enter new password'), 'autocomplete' => 'off'));
        echo $this->Form->input('password_confirm', array('label' => __('Confirm Password'), 'type' => 'password', 'value' => '', 'placeholder' => __('Repeat new password'), 'autocomplete' => 'off'));
        echo $this->Form->input('language', array('label' => __('System Language'), 'type' => 'select', 'options' => AppLanguages::getAll()));
        
        echo $this->Form->timezone('timezone', array('label' => __('System Timezone')));
        echo $this->Form->input('active', array('label' => __('Active')));
        echo $this->Form->input('receivenotifications', array('type' => 'checkbox', 'label' => __('Receive Email Notifications?')));
        ?>
    </fieldset>
    <div class="form-actions">
        <?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Create Administrator'), array('class' => 'btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="ico-cancel"></i> ' . __('Cancel'), array('action' => 'administrators'), array('escape' => false, 'class' => 'btn')); ?>
    </div>    
    <?php echo $this->Form->end(); ?> 
</div>
