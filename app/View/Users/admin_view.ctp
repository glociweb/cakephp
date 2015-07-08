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
<div class="users view">
    <h2><?php echo __('User Profile'); ?>: <small><?php echo h($user['User']['username']); ?></small></h2>
    <div class="well">
        <dl>
            <dt><?php echo __('Client'); ?></dt>
            <dd>
                <?php echo $this->Html->link($user['Client']['title'], array('controller' => 'clients', 'action' => 'view', $user['Client']['id'])); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Username'); ?></dt>
            <dd>
                <?php echo h($user['User']['username']); ?>
                &nbsp;
            </dd>
             <dt><?php echo __('Department'); ?></dt>
            <dd>
                <?php echo h($user['Department']['dep_name']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('First Name'); ?></dt>
            <dd>
                <?php echo h($user['User']['fname']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Last Name'); ?></dt>
            <dd>
                <?php echo h($user['User']['lname']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Email'); ?></dt>
            <dd>
                <?php echo $this->Text->autoLinkEmails($user['User']['email']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Temporary Password'); ?></dt>
            <dd>
                <?php echo ($user['User']['temp_password'] == null ? __('Already reset') : $user['User']['temp_password']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Active'); ?></dt>
            <dd>
                <?php echo $this->Layout->boolYesNo($user['User']['active']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Receive Email Notifications?'); ?></dt>
            <dd>
                <?php echo $this->Layout->boolYesNo($user['User']['receivenotifications']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('User Image'); ?></dt>
            <dd>
                <?php echo $this->Html->image($this->Layout->__getAvatarUrl($user['User']), array('style' => 'max-width: 25px; max-height: 25px;')); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Last Active'); ?></dt>
            <dd>
                <?php echo $this->Layout->displayTimeDefault($user['User']['lastactivity']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Created'); ?></dt>
            <dd>
                <?php echo $this->Layout->displayTimeDefault($user['User']['created']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Modified'); ?></dt>
            <dd>
                <?php echo $this->Layout->displayTimeDefault($user['User']['modified']); ?>
                &nbsp;
            </dd>
        </dl>
    </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <div class="btn-toolbar">
        <div class="btn-group">		
            <?php echo $this->Html->link('<i class="ico-pencil"></i> ' . __('Edit User'), array('action' => 'edit', $user['User']['id']), array('escape' => false, 'class' => 'btn')); ?> 
            <?php echo $this->Form->postLink('<i class="ico-bin_closed"></i> ' . __('Delete User'), array('action' => 'delete', $user['User']['id']), array('escape' => false, 'class' => 'btn btn-danger'), __('Are you sure you want to delete %s?', $user['User']['username'])); ?> 
            <?php echo $this->Html->link('<i class="ico-table"></i> ' . __('List Users'), array('action' => 'index'), array('escape' => false, 'class' => 'btn')); ?> 
        </div>
    </div>
</div>

<hr />
<h2><?php echo __('Recent Activity'); ?></h2>

<?php echo $this->element('common/defaultpagination'); ?>
<?php foreach ($notifications as $notification): ?>
    <?php echo $this->Layout->renderNotification($notification); ?>
<?php endforeach; ?>
<?php echo $this->element('common/defaultpagination'); ?>
