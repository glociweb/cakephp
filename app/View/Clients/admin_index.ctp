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
<div class="clients index">
    <div class="btn-toolbar pull-right">
        <div class="btn-group"> 
            <?php echo $this->Html->link('<i class="ico-add"></i> ' . __('New Client'), array('action' => 'add'), array('escape' => false, 'class' => 'btn btn-primary')); ?>   
        </div>
    </div>
    <h2><?php echo __('Client Overview'); ?></h2>
    <table class="table table-bordered table-striped">
        <tr>
            <th><?php echo $this->Paginator->sort('title', __('Name')); ?></th>
            <th><?php echo $this->Paginator->sort('created', __('Created')); ?></th>
            <th><?php echo $this->Paginator->sort('modified', __('Modified')); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($clients as $client): ?>
            <tr>
                <td><?php echo $this->Html->link($client['Client']['title'], array('controller' => 'clients', 'action' => 'view', $client['Client']['id'])); ?>&nbsp;</td>
                <td><?php echo $this->Layout->displayTimeDefault($client['Client']['created']); ?>&nbsp;</td>
                <td><?php echo $this->Layout->displayTimeDefault($client['Client']['modified']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Layout->editActions('default', array('controller' => 'clients', 'id' => $client['Client']['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($clients)): ?>
            <tr>
                <td colspan="4"><?php echo __('Currently, no clients exist.'); ?></td>
            </tr>
        <?php endif; ?>
    </table>
    <?php echo $this->element('common/defaultpagination'); ?>
</div>