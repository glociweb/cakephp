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
<div class="well">
    <div class="pull-right">
        <?php
        $project['Project']['User'] = $project['User'];
        echo $this->element('projects/favourite_button', array('project' => $project['Project']));
        ?>
        <?php if (AppAuth::is(UserRoles::Admin)) echo $this->Layout->inlineoptions(array('view', 'edit', 'delete'), array('id' => $project['Project']['id'], 'controller' => 'projects', 'linktext' => __('Actions'), 'btn' => '')); ?>
    </div>
    <h1><?php echo $project['Project']['title']; ?></h1>
    <p><?php echo $project['Project']['description']; ?></p>
    <hr />
    <div class="progress">
        <div class="bar" data-progress="<?php echo $project['Project']['percent_completed']; ?>" style="width: <?php echo $project['Project']['percent_completed']; ?>%;"><?php echo $project['Project']['percent_completed']; ?>%</div>
    </div>
    <p>
        <strong><?php echo __('Phases'); ?>: </strong> <?php echo $project['Project']['phase_count']; ?><br />
        <strong><?php echo __('Start Date'); ?>: </strong> <?php echo $this->Layout->displayProjectDates($project['Project']['date_start']); ?><br />
        <strong><?php echo __('End Date'); ?>: </strong> <?php echo $this->Layout->displayProjectDates($project['Project']['date_end']); ?>
    </p>
</div>
<h2><?php echo __('Project Notes'); ?></h2>
<?php if (count($project['Notes']) < 1) echo __('No Notes have been assigned ot this project.'); ?>
<ul>
<?php foreach ($project['Notes'] as $notes): ?>
    <li><?php echo $this->Html->link($notes['title'], array('controller' => 'notes','action' => 'view', $notes['id'], 'admin' => false)); ?></li>
    
<?php endforeach; ?>
</ul>
<hr />

<h2><?php echo __('Project Members'); ?></h2>
<?php if (count($project['Client']) < 1) echo __('No clients have been assigned ot this project.'); ?>
<?php foreach ($project['Client'] as $client): ?>
    <h3><?php echo $client['title']; ?>: </h3>
    <ul>
        <?php if (count($client['User']) < 1) echo '<li>' . __('No users') . '</li>'; ?>
        <?php foreach ($client['User'] as $user): ?>
            <li><?php echo $this->Layout->renderUsername($user, true); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endforeach; ?>
<hr />
<h2><?php echo __('Project History'); ?></h2>
<?php echo $this->element('common/defaultpagination'); ?>
<?php foreach ($notifications as $notification): ?>
    <?php echo $this->Layout->renderNotification($notification); ?>
<?php endforeach; ?>
<?php echo $this->element('common/defaultpagination'); ?>
