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
    <h2><?php echo __('Department'); ?>: <small><?php echo h($department['Department']['dep_name']); ?></small></h2>
    <div class="well">
        <dl>
            <dt><?php echo __('Department'); ?></dt>
            <dd>
                <?php echo $this->Html->link($department['Department']['dep_name'], array('controller' => 'department', 'action' => 'view', $department['Department']['id'])); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Department Head'); ?></dt>
            <dd>
                <?php echo $this->Layout->renderUsername($department['User'], false); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Description'); ?></dt>
            <dd>
                <?php echo h($department['Department']['dep_description']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Active'); ?></dt>
            <dd>
                <?php echo $this->Layout->boolYesNo($department['Department']['dep_status']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Created'); ?></dt>
            <dd>
                <?php echo $this->Layout->displayTimeDefault($department['Department']['created']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Modified'); ?></dt>
            <dd>
                <?php echo $this->Layout->displayTimeDefault($department['Department']['modified']); ?>
                &nbsp;
            </dd>
        </dl>
    </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <div class="btn-toolbar">
        <div class="btn-group">		
            <?php echo $this->Html->link('<i class="ico-pencil"></i> ' . __('Edit Department'), array('action' => 'edit', $department['Department']['id']), array('escape' => false, 'class' => 'btn')); ?> 
            <?php echo $this->Form->postLink('<i class="ico-bin_closed"></i> ' . __('Delete Department'), array('action' => 'delete', $department['Department']['id']), array('escape' => false, 'class' => 'btn btn-danger'), __('Are you sure you want to delete %s?', $department['Department']['dep_name'])); ?> 
            <?php echo $this->Html->link('<i class="ico-table"></i> ' . __('List Department'), array('action' => 'index'), array('escape' => false, 'class' => 'btn')); ?> 
        </div>
    </div>
</div>

<hr />

