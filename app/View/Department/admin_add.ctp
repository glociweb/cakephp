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
<div class="users form">
    <?php echo $this->Form->create('Department'); ?>
    <fieldset>
        <legend><?php echo __('Add Department'); ?></legend>
        <?php
        echo $this->Form->input('dep_name', array('label' => __('Department Name')));
        echo $this->Form->input('dep_head', array('label' => 'Head', 'options' => array(__('- Please select -'), __('Available Users') => $users), 'type' => 'select'));
        echo $this->Form->input('dep_description', array('label' => __('Department Description')));
        echo $this->Form->input('dep_status', array('multiple'=>'checkbox'));
        ?>
    </fieldset>
    <div class="form-actions">
        <?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Save & Exit'), array('class' => 'btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
        <?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Save & Add New'), array('name' => 'add_new', 'class' => 'btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="ico-cancel"></i> ' . __('Cancel'), array('action' => 'index'), array('escape' => false, 'class' => 'btn')); ?>
    </div>    
    <?php echo $this->Form->end(); ?>
</div>
