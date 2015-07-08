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
        <legend><?php echo __('Edit Administrator'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('username', array('label' => __('Username')));
        echo $this->Form->input('fname', array('label' => __('First Name')));
        echo $this->Form->input('lname', array('label' => __('Last Name')));
        echo $this->Form->input('email', array('label' => __('Email')));
        echo $this->Form->input('password', array('type' => 'password', 'value' => '', 'placeholder' => __('Enter new password'), 'autocomplete' => 'off', 'label' => __('Password ') . $this->Layout->renderHelpIcon(__('Please leave empty if you do not wish you change your password.'))));
        echo $this->Form->input('password_confirm', array('type' => 'password', 'value' => '', 'placeholder' => __('Repeat new password'), 'autocomplete' => 'off', 'label' => __('Confirm Password')));
        echo $this->Form->input('temp_password', array('label' => __('Temporary Password')));
        echo $this->Form->input('language', array('label' => __('System Language'), 'type' => 'select', 'options' => AppLanguages::getAll()));
        echo $this->Form->timezone('timezone', array('label' => __('System Timezone')));
        echo $this->Form->input('active', array('label' => __('Active')));
        echo $this->Form->input('receivenotifications', array('type' => 'checkbox', 'label' => __('Receive Email Notifications?')));
        echo $this->Form->input('avatarpath', array('type' => 'file', 'label' => __('User Image')));
        if (trim($user['User']['avatarpath']) != '')
            echo $this->Form->input('User.avatarpath.remove', array('type' => 'checkbox', 'label' => __('Remove current user image?'), 'hiddenField' => false, 'after' => $this->Html->image($this->Layout->__getAvatarUrl($user['User']), array('style' => 'max-width: 25px; max-height: 25px; margin-left: 5px;')) . '</div>'));
        ?>
    </fieldset>
    <div class="form-actions">
        <?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Save'), array('class' => 'btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="ico-cancel"></i> ' . __('Cancel'), array('action' => 'administrators_view', $this->Form->value('User.id')), array('escape' => false, 'class' => 'btn')); ?>
    </div>    
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <div class="btn-toolbar">
        <div class="btn-group">
            <?php echo $this->Html->link('<i class="ico-folder_go"></i> ' . __('View Administrator'), array('action' => 'administrators_view', $this->Form->value('User.id')), array('escape' => false, 'class' => 'btn')); ?>		
            <?php echo $this->Form->postLink('<i class="ico-bin_closed"></i> ' . __('Delete Administrator'), array('action' => 'delete', $this->Form->value('User.id')), array('escape' => false, 'class' => 'btn btn-danger'), __('Are you sure you want to delete %s?', $this->Form->value('User.username'))); ?>		
            <?php echo $this->Html->link('<i class="ico-table"></i> ' . __('List Administrators'), array('action' => 'administrators'), array('escape' => false, 'class' => 'btn')); ?>
        </div>
    </div>
</div>
