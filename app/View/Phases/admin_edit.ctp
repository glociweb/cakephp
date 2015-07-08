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
<div class="phases form">
    <?php echo $this->Form->create('Phase'); ?>
    <fieldset>
        <legend><?php echo __('Edit Phase'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('title', array('label' => __('Name')));
        echo $this->Form->input('slug', array('label' => __('Url')));
        echo $this->Form->input('description', array('label' => __('Description')));
        echo $this->Form->input('client_can_update', array('label' => __('Allow Clients to Update Progress')));

        echo $this->Form->input('date_start', array('type' => 'text', 'label' => __('Start Date'), 'class' => 'dateFrom'));
        echo $this->Form->input('date_end', array('type' => 'text', 'label' => __('End Date'), 'class' => 'dateTo'));


        $this->Html->scriptBlock('
	$(function() {
		$(".dateFrom").datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			numberOfMonths: 3,
			onSelect: function( selectedDate ) {
				//$( ".dateTo" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$(".dateTo").datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			numberOfMonths: 3,
			onSelect: function( selectedDate ) {
				//$( ".dateFrom" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
                
                //$(".dateTo").datepicker("option", "minDate", $(".dateFrom").datepicker("getDate"));
                
	});', array('inline' => false));
        ?>
    </fieldset>
    <div class="form-actions">
        <?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Save'), array('class' => 'btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="ico-cancel"></i> ' . __('Cancel'), array('controller' => 'projects', 'action' => 'view', $this->Form->value('Phase.project_id')), array('escape' => false, 'class' => 'btn')); ?>
    </div>    
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <div class="btn-toolbar">
        <div class="btn-group">
            <?php echo $this->Html->link('<i class="ico-folder_go"></i> ' . __('View Phase'), array('controller' => 'projects', 'action' => 'phase', $this->Form->value('Phase.slug'), 'admin' => false), array('escape' => false, 'class' => 'btn')); ?>	
            <?php echo $this->Form->postLink('<i class="ico-bin_closed"></i> ' . __('Delete'), array('action' => 'delete', $this->Form->value('Phase.id')), array('escape' => false, 'class' => 'btn btn-danger'), __('Are you sure you want to delete # %s?', $this->Form->value('Phase.id'))); ?>		
            <?php echo $this->Html->link('<i class="ico-table"></i> ' . __('Back to Project'), array('controller' => 'projects', 'action' => 'view', $this->Form->value('Phase.project_id')), array('escape' => false, 'class' => 'btn')); ?>
        </div>
    </div>
</div>