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
<div class="projects view">
    <h2><?php echo __('Project'); ?>: <small><?php echo h($project['Project']['title']); ?></small></h2>
    <div class="well">
        <dl>
            <dt><?php echo __('Name'); ?></dt>
            <dd>
                <?php echo h($project['Project']['title']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Url'); ?></dt>
            <dd>
                <?php echo h($project['Project']['slug']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Description'); ?></dt>
            <dd>
                <?php echo h($project['Project']['description']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Phases'); ?></dt>
            <dd>
                <?php echo h($project['Project']['phase_count']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('% Completed'); ?></dt>
            <dd>
                <?php echo h($project['Project']['percent_completed']); ?>%
                &nbsp;
            </dd>
            <dt><?php echo __('Start Date'); ?></dt>
            <dd>
                <?php echo $this->Layout->displayProjectDates($project['Project']['date_start']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('End Date'); ?></dt>
            <dd>
                <?php echo $this->Layout->displayProjectDates($project['Project']['date_end']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Project Duration'); ?></dt>
            <dd>
                <?php echo $this->Time->dateDiffDays($project['Project']['date_start'], $project['Project']['date_end']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Archived'); ?></dt>
            <dd>
                <?php echo $this->Layout->boolYesNo($project['Project']['archived']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Created'); ?></dt>
            <dd>
                <?php echo $this->Layout->displayTimeDefault($project['Project']['created']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Modified'); ?></dt>
            <dd>
                <?php echo $this->Layout->displayTimeDefault($project['Project']['modified']); ?>
                &nbsp;
            </dd>
        </dl>
    </div>
</div>
<hr/>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <div class="btn-toolbar">
        <div class="btn-group">		
            <?php echo $this->Html->link('<i class="ico-report_go"></i> ' . __('Launch'), array('controller' => 'projects', 'action' => 'dashboard', $project['Project']['slug'], 'admin' => false), array('class' => 'btn btn-primary', 'escape' => false)); ?>
            <?php echo $this->Html->link('<i class="ico-email"></i> ' . __('Prepare Invitation Email'), (!empty($project['Client']) ? array('controller' => 'projects', 'action' => 'prepareinvitation', $project['Project']['id'], 'admin' => true) : '#'), array('class' => 'btn btn-info' . (empty($project['Client']) ? ' disabled' : ''), 'escape' => false)); ?>
            <?php echo $this->Html->link('<i class="ico-pencil"></i> ' . __('Edit Project'), array('action' => 'edit', $project['Project']['id']), array('escape' => false, 'class' => 'btn')); ?> 
            <?php echo $this->Form->postLink('<i class="ico-bin_closed"></i> ' . __('Delete Project'), array('action' => 'delete', $project['Project']['id']), array('escape' => false, 'class' => 'btn btn-danger'), __('Are you sure you want to delete %s?', $project['Project']['title'])); ?> 
            <?php echo $this->Html->link('<i class="ico-table"></i> ' . __('Back to Project Overview'), array('action' => 'index'), array('escape' => false, 'class' => 'btn')); ?> 
        </div>
        <div class="btn-group">		
            <?php echo $this->Html->link('' . __('Duplicate Project'), array('action' => 'duplicate', $project['Project']['id']), array('escape' => false, 'class' => 'btn')); ?> 
            <?php echo $this->Html->link('' . __('Move Project'), array('action' => 'move', $project['Project']['id']), array('escape' => false, 'class' => 'btn')); ?> 
        </div>
    </div>
</div>
<hr/>
<div class="related">
	 <h3><?php echo __('Project Notes'); ?></h3>
	 <?php if (!empty($project['Notes'])): ?>
        <table class="table table-striped table-bordered table-condensed">
            <tr>
                <th><?php echo __('#sr No'); ?></th>
                <th><?php echo __('Name'); ?></th>
                
                <th><?php echo __('Created'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php
            $i = 0;
            $count=1;
            foreach ($project['Notes'] as $notes):
                ?>
                <tr>
					<td><?php echo "#".$count;  ?></td>
                    <td><?php echo $this->Html->link($notes['title'], array('controller' => 'notes','action' => 'view', $notes['id'], 'admin' => true)); ?></td>
                  
                    
                    <td><?php echo $this->Layout->displayTimeDefault($notes['created']); ?></td>
                    <td class="actions">
                        <?php echo $this->Layout->editActions(array('edit', 'delete'), array('controller' => 'notes', 'id' => $notes['id'])); ?>
                    </td>
                </tr>
            <?php
            $count++;
             endforeach; ?>
        </table>
    <?php else: ?>
        <?php echo __('none') ?>
    <?php endif; ?>

    <div class="form-actions">

        <?php echo $this->Html->link('<i class="ico-add"></i> ' . __('Add Note to This Project'), array('controller' => 'notes', 'action' => 'addmeetingnote', $project['Project']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>	
    </div>
</div>
<div class="related">
    <h3><?php echo __('Project Phases'); ?></h3>
    <?php if (!empty($project['Phase'])): ?>
        <table class="table table-striped table-bordered table-condensed">
            <tr>
                <th colspan="2"><?php echo __('No.'); ?></th>
                <th><?php echo __('Name'); ?></th>
                <th><?php echo __('Description'); ?></th>
                <th><?php echo __('% Completed'); ?></th>
                <th style="min-width: 200px;"><?php echo __('Timings'); ?></th>
                <th><?php echo __('Comments'); ?></th>
                <th><?php echo __('Created'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php
            $i = 0;
            foreach ($project['Phase'] as $phase):
                ?>
                <tr>
                    <td><strong><?php echo $phase['position']; ?></strong></td>
                    <td>
                        <?php
                        echo $this->Html->link('<i class="ico-bullet_arrow_up"></i>', array('controller' => 'phases', 'action' => 'moveup', $phase['id']), array('class' => 'bftn btfn-mini', 'escape' => false)) . '<br />';
                        echo $this->Html->link('<i class="ico-bullet_arrow_down"></i>', array('controller' => 'phases', 'action' => 'movedown', $phase['id']), array('class' => 'btnf bftn-mini', 'escape' => false));
                        ?>
                    </td>
                    <td><?php echo $this->Html->link($phase['title'], array('action' => 'phase', $phase['slug'], 'admin' => false)); ?></td>
                    <td><?php echo $this->Text->truncate($phase['description'], 150, array('exact' => false, 'ending' => ' [...]')); ?></td>
                    <td><?php echo $phase['percent_completed']; ?>%</td>
                    <td>
                        <?php echo '<strong>' . __('Start Date:') . ' </strong>' . $this->Layout->displayProjectDates($phase['date_start']); ?><br/>
                        <?php echo '<strong>' . __('End Date:') . ' </strong>' . $this->Layout->displayProjectDates($phase['date_end']); ?><br/>
                        <?php echo '<strong>' . __('Duration:') . ' </strong>' . $this->Time->dateDiffDays($phase['date_start'], $phase['date_end']); ?>
                    </td>
                    <td><?php echo $phase['comment_count']; ?></td>
                    <td><?php echo $this->Layout->displayTimeDefault($phase['created']); ?></td>
                    <td class="actions">
                        <?php echo $this->Layout->editActions(array('edit', 'delete'), array('controller' => 'phases', 'id' => $phase['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <?php echo __('none') ?>
    <?php endif; ?>

    <div class="form-actions">

        <?php echo $this->Html->link('<i class="ico-add"></i> ' . __('Add Phase to This Project'), array('controller' => 'phases', 'action' => 'add', $project['Project']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>	
    </div>
</div>
<div class="related">
    <h3><?php echo __('Associated Clients'); ?></h3>
    <?php if (!empty($project['Client'])): ?>
        <table class="table table-striped table-bordered table-condensed">
            <tr>
                <th><?php echo __('Title'); ?></th>
                <th><?php echo __('Created'); ?></th>
                <th><?php echo __('Modified'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php
            $i = 0;
            foreach ($project['Client'] as $client):
                ?>
                <tr>
                    <td><?php echo $this->Html->link($client['title'], array('controller' => 'clients', 'action' => 'view', $client['id'])); ?></td>
                    <td><?php echo $this->Layout->displayTimeDefault($client['created']); ?></td>
                    <td><?php echo $this->Layout->displayTimeDefault($client['modified']); ?></td>
                    <td class="actions">
                        <?php echo $this->Layout->editActions('default', array('controller' => 'clients', 'id' => $client['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <?php echo __('none') ?>
    <?php endif; ?>

    <div class="form-actions">
        <?php echo $this->Html->link('<i class="ico-add"></i> ' . __('Create a New Client'), array('controller' => 'clients', 'action' => 'add', $project['Project']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>	
        <?php echo $this->Html->link('<i class="ico-pencil"></i> ' . __('Manage Associated Clients'), array('controller' => 'projects', 'action' => 'edit', $project['Project']['id']), array('class' => 'btn', 'escape' => false)); ?>	
    </div>
</div>
