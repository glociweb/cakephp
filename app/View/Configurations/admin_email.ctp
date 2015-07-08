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
$this->Html->scriptBlock('
$(function() {

    if($(".select-transport").val() == "mail")
        $(".smtp-settings").hide();

    $(".select-transport").change(function() {
        if($(this).val() == "mail")
            $(".smtp-settings").fadeOut();
        else
            $(".smtp-settings").fadeIn();
    });
});



', array('inline' => false));
?>
<div class="configurations form">
    <h2><?php echo __('Edit System Configuration'); ?></h2>
    <hr/>

    <ul class="nav nav-tabs">
        <?php
        $sel = !empty($this->request->params['named']['section']) ? $this->request->params['named']['section'] : '';
        ?>
        <li<?php echo ($sel == '') ? ' class="active"' : ''; ?>><?php echo $this->Html->link(__('System Configuration'), array('action' => 'index')); ?></li>
        <li<?php echo ($sel == 'email') ? ' class="active"' : ''; ?>><?php echo $this->Html->link(__('Email Configuration'), Hash::merge($this->request->params['named'], array('section' => 'email'))); ?></li>    
    </ul>

    <?php echo $this->Form->create('Configuration', array('type' => 'file')); ?>
    <fieldset>
        <p><?php echo __('You can adapt global system settings below:'); ?></p>
        <?php
        echo $this->Form->input('id');

        echo '<h3 class="controls">' . __('Email Settings') . '</h3>';
        echo $this->Form->input('Email-checked_default', array('label' => __('Check "Send Notifications" by Default')));
        echo $this->Form->input('Email-email', array('label' => __('Sender Email')));
        echo $this->Form->input('Email-sender', array('label' => __('Sender Name')));
        echo $this->Form->input('Email-transport', array('label' => __('Transport Method'), 'type' => 'select', 'options' => array('mail' => __('PHP mail() function'), 'smtp' => __('SMTP account')), 'class' => 'select-transport'));

        echo '<div class="well smtp-settings"><h3 class="controls">' . __('SMTP Settings') . '</h3>';
        echo '<p class="controls" style="width: 450px; font-size: 11px;">' . __('Please enter your SMTP details below. For example, for GMail you need to use the following data: ssl://smtp.gmail.com (host), 465 (port), your.name@gmail.com (username) and your password. After sending the test-email it is <strong>important</strong> that you save your changes by clicking "Save Configuration" below.') . '</p>';
        echo $this->Form->input('Email-host', array('label' => __('Host')));
        echo $this->Form->input('Email-port', array('label' => __('Port')));
        echo $this->Form->input('Email-username', array('label' => __('Username')));
        echo $this->Form->input('Email-password', array('label' => __('Password'), 'type' => 'password'));
        echo $this->Form->input('test-email', array('name' => 'test-email', 'label' => __('Test-Email'), 'class' => 'input-medium', 'after' => $this->Form->button(__('Send Test-Email'), array('name' => 'btn_test-email', 'class' => 'btn btn-mini')) . '</div>'));
        echo '</div>';

        echo '<h3 class="controls">' . __('Invitation Email') . '</h3>';
        echo $this->Form->input('Email-invitationsubject', array('label' => __('Invitation Email Subject')));
        echo $this->Form->input('Placeholders', array('type' => 'select', 'options' => array(
                null => __('--  Insert Placeholder  --'),
                '{UserName}' => __('Username'),
                '{ProjectName}' => __('Project Name'),
                '{ProjectUrl}' => __('Project Url'),
                '{UserEmail}' => __('User Email'),
                '{StartIsNewUser}' => __('Start IsNewUser'),
                '{EndIsNewUser}' => __('End IsNewUser'),
                '{TempPassword}' => __('Temporary Password'),
                '{SystemName}' => __('System Name'),
            ),
            'class' => 'select-placeholder',
            'after' => ' ' . $this->Html->link(__('Reset to Defaults'), '#', array('class' => 'btn btn-mini btn-danger btn-resettodefaults reset-invitation')) . '</div>'));
        echo $this->Form->input('Email-invitationtext_text', array('label' => __('Invitation Email Template'), 'type' => 'textarea', 'style' => 'width: 500px; height: 250px', 'class' => 'textarea-template'));

        echo '<h3 class="controls">' . __('Update Notification Emails') . '</h3>';
        echo $this->Form->input('Email-activity_subject', array('label' => __('Activity Email Subject')));

        echo '<h4 class="controls">' . __('Progress Update Email Template') . '</h4>';
        echo $this->Form->input('Placeholders', array('type' => 'select', 'options' => array(
                null => __('--  Insert Placeholder  --'),
                '{UserName}' => __('Username'),
                '{ProjectName}' => __('Project Name'),
                '{PhaseName}' => __('Phase Name'),
                '{PhaseUrl}' => __('Phase Url'),
                '{User}' => __('User'),
                '{OldPercentage}' => __('Old Percentage'),
                '{NewPercentage}' => __('New Percentage'),
                '{SystemName}' => __('System Name'),
            ),
            'class' => 'select-placeholder',
            'after' => ' ' . $this->Html->link(__('Reset to Defaults'), '#', array('class' => 'btn btn-mini btn-danger btn-resettodefaults reset-progress')) . '</div>'));
        echo $this->Form->input('Email-progressactivity_text', array('label' => __('Progress Update Email Template'), 'type' => 'textarea', 'style' => 'width: 500px; height: 250px', 'class' => 'textarea-template'));

        echo '<h4 class="controls">' . __('Comment/Task Email Template') . '</h4>';
        echo $this->Form->input('Placeholders', array('type' => 'select', 'options' => array(
                null => __('--  Insert Placeholder  --'),
                '{UserName}' => __('Username'),
                '{ProjectName}' => __('Project Name'),
                '{PhaseName}' => __('Phase Name'),
                '{PhaseUrl}' => __('Phase Url'),
                '{User}' => __('User'),
                '{CommentType}' => __('Comment Type (Comment/Task)'),
                '{CommentUrl}' => __('Direct Url to Comment'),
                '{SystemName}' => __('System Name'),
            ),
            'class' => 'select-placeholder',
            'after' => ' ' . $this->Html->link(__('Reset to Defaults'), '#', array('class' => 'btn btn-mini btn-danger btn-resettodefaults reset-comment')) . '</div>'));
        echo $this->Form->input('Email-commentactivity_text', array('label' => __('Comment/Task Email Template'), 'type' => 'textarea', 'style' => 'width: 500px; height: 250px', 'class' => 'textarea-template'));

        echo '<h4 class="controls">' . __('Task Activity Email Template') . '</h4>';
        echo $this->Form->input('Placeholders', array('type' => 'select', 'options' => array(
                null => __('--  Insert Placeholder  --'),
                '{UserName}' => __('Username'),
                '{ProjectName}' => __('Project Name'),
                '{PhaseName}' => __('Phase Name'),
                '{PhaseUrl}' => __('Phase Url'),
                '{User}' => __('User'),
                '{TaskStatus}' => __('Task Status (Completed/Uncompleted)'),
                '{CommentUrl}' => __('Direct Url to Comment'),
                '{SystemName}' => __('System Name'),
            ),
            'class' => 'select-placeholder',
            'after' => ' ' . $this->Html->link(__('Reset to Defaults'), '#', array('class' => 'btn btn-mini btn-danger btn-resettodefaults reset-task')) . '</div>'));
        echo $this->Form->input('Email-taskactivity_text', array('label' => __('Task Activity Email Template'), 'type' => 'textarea', 'style' => 'width: 500px; height: 250px', 'class' => 'textarea-template'));


        $this->Html->scriptBlock('
            $(function(){
                $(".select-placeholder").change(function(){
                    if($(this).val() == "")
                        return;
                        
                    $(this).parent().parent().next().find(".textarea-template").val($(this).parent().parent().next().find(".textarea-template").val() + $(this).val());

                    var textarea = $(this).parent().parent().next().find(".textarea-template");
                    textarea.scrollTop(
                        textarea[0].scrollHeight - textarea.height()
                    );

                    $(this).val("");
                });
                
                $(".btn-resettodefaults").click(function(e){
                    e.preventDefault();
                    var textBox = $(this).parent().parent().next().find(".textarea-template");

                    if($(this).hasClass("reset-invitation"))
                        textBox.val("' . __('Dear {UserName},\n\nYou have been invited to join the project {ProjectName} on our online project management portal.\n\nThis will enable you to participate in following the project\'s progress as well as allow you to comment on any of the project\'s phases.\n\nYou can log-on to the project here: {ProjectUrl}\n\nYour username is: {UserEmail}\n{StartIsNewUser}\nYour temporary password is: {TempPassword}\n\nPlease make sure you change your temporary password during your first visit.\n{EndIsNewUser}\n\n\nKind regards,\n{SystemName}\n') . '");
                    if($(this).hasClass("reset-progress"))
                        textBox.val("' . __('Dear {UserName},\n\nThere has been some new activity in the project {ProjectName}.\n\n{User} changed the progress of the phase {PhaseName} from {OldPercentage} to {NewPercentage}.\n\nYou can view the affected project phase here: {PhaseUrl}\n\n\nKind regards,\n{SystemName}\n') . '");
                    if($(this).hasClass("reset-comment"))
                        textBox.val("' . __('Dear {UserName},\n\nThere has been some new activity in the project {ProjectName}.\n\n{User} has created a new {CommentType} in the phase {PhaseName}.\n\nYou can view the {CommentType} here: {CommentUrl}\n\n\nKind regards,\n{SystemName}\n') . '");
                    if($(this).hasClass("reset-task"))
                        textBox.val("' . __('Dear {UserName},\n\nThere has been some new activity in the project {ProjectName}.\n\n{User} has changed the status of a task in the phase {PhaseName} to {TaskStatus}.\n\nYou can view the task here: {CommentUrl}\n\n\nKind regards,\n{SystemName}\n') . '");
                         
                });
                
            });
        ', array('inline' => false));
        ?>
    </fieldset>
    <div class="form-actions">
        <?php echo $this->Form->submit(__('Save Configuration'), array('class' => 'btn btn-primary blockinterface')); ?>
    </div>    
</div>