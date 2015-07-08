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
<div class="projects index">
    <div class="btn-toolbar pull-right">
        <div class="btn-group"> 
            <?php echo $this->Html->link('<i class="ico-add"></i> ' . __('New Project'), array('action' => 'add'), array('escape' => false, 'class' => 'btn btn-primary')); ?>    
        </div>
    </div>	








    <h2><?php echo __('Project Overview'); ?></h2>
    <p>&nbsp;</p>

    <div class="well smallpadding">
        <span class="label"><?php echo __('Sorting Options: '); ?></span>

        <div class="toolbar">
            <div class="row-fluid">
                <div class="span10">
                    <?php echo $this->Html->link(__('Reset'), array('action' => 'index', 'sort' => 'created', 'direction' => 'desc'), array('class' => 'btn btn-small btn-inverse')); ?>
                    <?php echo $this->Paginator->sort('title', __('Title'), array('class' => 'btn btn-small')); ?>
                    <?php echo $this->Paginator->sort('slug', __('Url'), array('class' => 'btn btn-small')); ?>
                    <?php echo $this->Paginator->sort('description', __('Description'), array('class' => 'btn btn-small')); ?>
                    <?php echo $this->Paginator->sort('phase_count', __('Phases'), array('class' => 'btn btn-small')); ?>
                    <?php echo $this->Paginator->sort('percent_completed', __('% Completed'), array('class' => 'btn btn-small')); ?>
                    <?php echo $this->Paginator->sort('modified', __('Modified'), array('class' => 'btn btn-small')); ?>
                    <?php echo $this->Paginator->sort('created', __('Created'), array('class' => 'btn btn-small')); ?>
                </div>
                <div class="btn-group span2">
                    <?php
                    if (isset($this->request->params['named']['archived']) && $this->request->params['named']['archived'] == true)
                        echo $this->Html->link('<i class="ico-database_key"></i> ' . __('Show Archived'), Hash::merge($this->request->params['named'], array('archived' => false)), array('class' => 'btn btn-small active', 'data-toggle' => 'button', 'escape' => false));
                    else
                        echo $this->Html->link('<i class="ico-database_key"></i> ' . __('Show Archived'), Hash::merge($this->request->params['named'], array('archived' => true)), array('class' => 'btn btn-small', 'data-toggle' => 'button', 'escape' => false));
                    ?>
                </div>
            </div>
        </div>

    </div>

    <?php echo $this->element('common/defaultpagination'); ?>

    <?php foreach ($projects as $project): ?>
        <?php echo $this->element('projects/admin_overview', array('project' => $project)); ?>
    <?php endforeach; ?>
    <?php
    if (empty($projects))
        echo '<p>' . __('Currently, no projects exist.') . '</p>';
    ?>

    <?php echo $this->element('common/defaultpagination'); ?>
</div>
