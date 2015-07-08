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
    <?php echo $this->Form->create('User', array('type' => 'file')); ?>
    <fieldset>
        <legend><?php echo __('Edit Your Profile'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->hidden('username', array('label' => __('Username')));
        echo $this->Form->input('fname', array('label' => __('First Name')));
        echo $this->Form->input('lname', array('label' => __('Last Name')));
        echo $this->Form->input('email', array('label' => __('Email')));
        echo $this->Form->input('password', array('type' => 'password', 'value' => '', 'placeholder' => __('Enter new password'), 'autocomplete' => 'off', 'label' => __('Password ') . $this->Layout->renderHelpIcon(__('Please leave empty if you do not wish you change your password.'))));
        echo $this->Form->input('password_confirm', array('type' => 'password', 'value' => '', 'placeholder' => __('Repeat new password'), 'autocomplete' => 'off', 'label' => __('Confirm Password')));
        echo $this->Form->input('language', array('label' => __('System Language'), 'type' => 'select', 'options' => AppLanguages::getAll()));
        echo $this->Form->timezone('timezone', array('label' => __('System Timezone')));
        echo $this->Form->input('receivenotifications', array('type' => 'checkbox', 'label' => __('Receive Email Notifications?')));
        echo $this->Form->input('avatarpath', array('type' => 'file', 'label' => __('User Image')));
        if (trim($user['User']['avatarpath']) != '')
            echo $this->Form->input('User.avatarpath.remove', array('type' => 'checkbox', 'label' => __('Remove current user image?'), 'hiddenField' => false, 'after' => $this->Html->image($this->Layout->__getAvatarUrl($user['User']), array('style' => 'max-width: 25px; max-height: 25px; margin-left: 5px;')) . '</div>'));
        ?>
    </fieldset>
    <div class="form-actions">
        <?php echo $this->Form->submit(__('Save Profile'), array('class' => 'btn btn-primary blockinterface')); ?>
    </div>    
</div>
