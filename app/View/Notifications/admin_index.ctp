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
<?php if (!empty($notifications)): ?>
    <div class="notifications index">
        <h2><?php echo __('Notifications'); ?></h2>

        <div class="well smallpadding">
            <span class="label"><?php echo __('Sorting Options: '); ?></span>
            <div class="toolbar">
                <div class="">
                    <?php echo $this->Html->link(__('Reset'), array('action' => 'index', 'sort' => 'created', 'direction' => 'desc'), array('class' => 'btn btn-small btn-inverse')); ?>
                    <?php echo $this->Paginator->sort('project_id', __('Project'), array('class' => 'btn btn-small')); ?>
                    <?php echo $this->Paginator->sort('phase_id', __('Phase'), array('class' => 'btn btn-small')); ?>
                    <?php echo $this->Paginator->sort('title', __('Title'), array('class' => 'btn btn-small')); ?>
                    <?php echo $this->Paginator->sort('action', __('Action'), array('class' => 'btn btn-small')); ?>
                    <?php echo $this->Paginator->sort('field', __('Field'), array('class' => 'btn btn-small')); ?>
                    <?php echo $this->Paginator->sort('value_old', __('Old Value'), array('class' => 'btn btn-small')); ?>
                    <?php echo $this->Paginator->sort('value_new', __('New Value'), array('class' => 'btn btn-small')); ?>
                    <?php echo $this->Paginator->sort('created', __('Date'), array('class' => 'btn btn-small')); ?>
                </div>
            </div>
        </div>
        <?php echo $this->element('common/defaultpagination'); ?>
        <?php foreach ($notifications as $notification): ?>
            <?php echo $this->Layout->renderNotification($notification); ?>
        <?php endforeach; ?>
        <?php echo $this->element('common/defaultpagination'); ?>
    </div>
<?php else: ?>
    <?php echo __('Currently, no notifications exist.') ?>
<?php endif; ?>