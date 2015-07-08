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
            <?php echo $this->Html->link('<i class="ico-add"></i> ' . __('New Department'), array('action' => 'add'), array('escape' => false, 'class' => 'btn btn-primary')); ?> 
        </div>
    </div>
    <h2><?php echo __('Departments'); ?></h2>
    <table class="table table-bordered table-striped">
        <tr>
           
            <th><?php echo $this->Paginator->sort('dep_name', __('Department name')); ?></th>
            <th><?php echo $this->Paginator->sort('dep_head', __('Department Head')); ?></th>
             <th><?php echo $this->Paginator->sort('dep_description', __('Description')); ?></th>
            <th><?php echo $this->Paginator->sort('dep_status', __('Active')); ?></th>
            <th><?php echo $this->Paginator->sort('created', __('Created')); ?></th>
            <th><?php echo $this->Paginator->sort('modified', __('Modified')); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($departments as $department): ?>
            <tr>
                <td>
                    <?php echo $this->Html->link($department['Department']['dep_name'], array('controller' => 'Department', 'action' => 'view', $department['Department']['id'])); ?>
                </td>
                <td><?php echo $this->Layout->renderUsername($department['User'], false); ?>&nbsp;</td>
                <td><?php echo $this->Text->autoLinkEmails($department['Department']['dep_description']); ?>&nbsp;</td>
                <td><?php echo $this->Layout->boolYesNo($department['Department']['dep_status']); ?>&nbsp;</td>
                <td><?php echo $this->Layout->displayTimeDefault($department['Department']['created']); ?>&nbsp;</td>
                <td><?php echo $this->Layout->displayTimeDefault($department['Department']['modified']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Layout->editActions('default', array('controller' => 'department', 'id' => $department['Department']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($department)): ?>
            <tr>
                <td colspan="9"><?php echo __('Currently, no Department exist.'); ?></td>
            </tr>
        <?php endif; ?>
    </table>
    <?php echo $this->element('common/defaultpagination'); ?>
</div>
