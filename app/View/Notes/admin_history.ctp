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
<div class="related">
	 <h3><?php echo __('Note History #'.$Noteshistory[0]['Noteshistory']['title']); ?></h3>
	 <?php if (!empty($Noteshistory)): ?>
        <table class="table table-striped table-bordered table-condensed">
            <tr>
                <th><?php echo __('#sr No'); ?></th>
                <th><?php echo __('Name'); ?></th>
                
                <th><?php echo __('created'); ?></th>
                <th class="actions"><?php echo __('version'); ?></th>
            </tr>
            <?php
            $i = 0;
            $count=1;
            foreach ($Noteshistory as $notes):
                ?>
                <tr>
					<td><?php echo "#".$count;  ?></td>
                    <td><?php echo $this->Html->link($notes['Noteshistory']['title'], array('controller' => 'notes','action' => 'viewhistory', $notes['Noteshistory']['id'],  $notes['Noteshistory']['version'],'admin' => true)); ?></td>
					<td><?php echo $this->Layout->displayTimeDefault($notes['Noteshistory']['created']); ?></td>
					<td><?php echo $notes['Noteshistory']['version']; ?></td>
                </tr>
            <?php
            $count++;
             endforeach; ?>
        </table>
    <?php else: ?>
        <?php echo __('No history found for this note') ?>
    <?php endif; ?>

    <div class="form-actions">

        <?php echo $this->Html->link('<i class="ico-table"></i> ' . __('Back to Note'), array('controller' => 'notes', 'action' => 'view', $Noteshistory[0]['Noteshistory']['note_id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>	
    </div>
</div>
