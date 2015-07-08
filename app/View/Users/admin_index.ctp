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
<div class="users index">
    <div class="btn-toolbar pull-right">
        <div class="btn-group"> 
            <?php echo $this->Html->link('<i class="ico-add"></i> ' . __('New User'), array('action' => 'add'), array('escape' => false, 'class' => 'btn btn-primary')); ?> 
        </div>
    </div>
    <h2><?php echo __('Users'); ?></h2>
    <table class="table table-bordered table-striped">
        <tr>
            <th><?php echo $this->Paginator->sort('client_id', __('Client')); ?></th>
            <th><?php echo $this->Paginator->sort('username', __('Username')); ?></th>
            <th><?php echo $this->Paginator->sort('department', __('Department')); ?></th>
            <th><?php echo $this->Paginator->sort('email', __('Email')); ?></th>
            <th><?php echo $this->Paginator->sort('active', __('Active')); ?></th>
            
            <th><?php echo $this->Paginator->sort('lastactivity', __('Last Active')); ?></th>
            <th><?php echo $this->Paginator->sort('created', __('Created')); ?></th>
            <th><?php echo $this->Paginator->sort('modified', __('Modified')); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td>
                    <?php echo $this->Html->link($user['Client']['title'], array('controller' => 'clients', 'action' => 'view', $user['Client']['id'])); ?>
                </td>
                <td><?php echo $this->Layout->renderUsername($user['User'], false); ?>&nbsp;</td>
                 <td>
                    <?php echo $this->Html->link($user['Department']['dep_name'], array('controller' => 'department', 'action' => 'view', $user['Department']['id'])); ?>
                </td>
                <td><?php echo $this->Text->autoLinkEmails($user['User']['email']); ?>&nbsp;</td>
                <td><?php echo $this->Layout->boolYesNo($user['User']['active']); ?>&nbsp;</td>
                
                <td><?php echo $this->Time->timeAgoInWords($user['User']['lastactivity']); ?>&nbsp;</td>
                <td><?php echo $this->Layout->displayTimeDefault($user['User']['created']); ?>&nbsp;</td>
                <td><?php echo $this->Layout->displayTimeDefault($user['User']['modified']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Layout->editActions('default', array('controller' => 'users', 'id' => $user['User']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($users)): ?>
            <tr>
                <td colspan="9"><?php echo __('Currently, no users exist.'); ?></td>
            </tr>
        <?php endif; ?>
    </table>
    <?php echo $this->element('common/defaultpagination'); ?>
</div>
