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
<div class="clients view">
    <h2><?php echo __('Client'); ?>: <small><?php echo h($client['Client']['title']); ?></small></h2>
    <div class="well">
        <dl>
            <dt><?php echo __('Name'); ?></dt>
            <dd>
                <?php echo h($client['Client']['title']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Created'); ?></dt>
            <dd>
                <?php echo $this->Layout->displayTimeDefault($client['Client']['created']); ?>
                &nbsp;
            </dd>
            <dt><?php echo __('Modified'); ?></dt>
            <dd>
                <?php echo $this->Layout->displayTimeDefault($client['Client']['modified']); ?>
                &nbsp;
            </dd>
        </dl>
    </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <div class="btn-toolbar">
        <div class="btn-group">		
            <?php echo $this->Html->link('<i class="ico-pencil"></i> ' . __('Edit Client'), array('action' => 'edit', $client['Client']['id']), array('escape' => false, 'class' => 'btn')); ?> 
            <?php echo $this->Form->postLink('<i class="ico-bin_closed"></i> ' . __('Delete Client'), array('action' => 'delete', $client['Client']['id']), array('escape' => false, 'class' => 'btn btn-danger'), __('Are you sure you want to delete %s?', $client['Client']['title'])); ?> 
            <?php echo $this->Html->link('<i class="ico-table"></i> ' . __('Back to Client Overview'), array('action' => 'index'), array('escape' => false, 'class' => 'btn')); ?> 
        </div>
    </div>
</div>
<hr/>
<div class="related">
    <h3><?php echo __('This Client\'s Users'); ?></h3>
    <?php if (!empty($client['User'])): ?>
        <table class="table table-striped table-bordered table-condensed">
            <tr>
                <th><?php echo __('Username'); ?></th>
                <th><?php echo __('Email'); ?></th>
                <th><?php echo __('Active'); ?></th>
                <th><?php echo __('Avatarpath'); ?></th>
                <th><?php echo __('Last Active'); ?></th>
                <th><?php echo __('Created'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php
            $i = 0;
            foreach ($client['User'] as $user):
                ?>
                <tr>
                    <td><?php echo $this->Layout->renderUsername($user, false); ?></td>
                    <td><?php echo $this->Text->autoLinkEmails($user['email']); ?></td>
                    <td><?php echo $this->Layout->boolYesNo($user['active']); ?></td>
                    <td><?php echo $this->Html->image($this->Layout->__getAvatarUrl($user), array('style' => 'max-width: 25px; max-height: 25px;')); ?></td>
                    <td><?php echo $this->Time->timeAgoInWords($user['lastactivity']); ?></td>
                    <td><?php echo $this->Layout->displayTimeDefault($user['created']); ?></td>
                    <td class="actions">
                        <?php echo $this->Layout->editActions('default', array('controller' => 'users', 'id' => $user['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <?php echo __('none') ?>
    <?php endif; ?>

    <div class="form-actions">
        <?php echo $this->Html->link('<i class="ico-add"></i> ' . __('Add User'), array('controller' => 'users', 'action' => 'add', $client['Client']['id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>	
    </div>
</div>
<div class="related">
    <h3><?php echo __('Associated Projects'); ?></h3>
    <?php if (!empty($client['Project'])): ?>
        <table class="table table-striped table-bordered table-condensed">
            <tr>
                <th><?php echo __('Title'); ?></th>
                <th><?php echo __('Description'); ?></th>
                <th><?php echo __('Phases'); ?></th>
                <th><?php echo __('Created'); ?></th>
                <th><?php echo __('Modified'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php
            $i = 0;
            foreach ($client['Project'] as $project):
                ?>
                <tr>
                    <td><?php echo $this->Html->link($project['title'], array('controller' => 'projects', 'action' => 'view', $project['id'])); ?></td>
                    <td><?php echo $project['description']; ?></td>
                    <td><?php echo $project['phase_count']; ?></td>
                    <td><?php echo $this->Layout->displayTimeDefault($project['created']); ?></td>
                    <td><?php echo $this->Layout->displayTimeDefault($project['modified']); ?></td>
                    <td class="actions">
                        <?php echo $this->Layout->editActions('default', array('controller' => 'projects', 'id' => $project['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <?php echo __('none') ?>
    <?php endif; ?>
</div>