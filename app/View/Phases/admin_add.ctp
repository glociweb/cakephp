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
        <legend><?php echo String::insert(__('Add Phase to :project_title'), array('project_title' => $project['Project']['title'])); ?></legend>
        <?php
        echo $this->Form->input('title', array('label' => __('Name')));
        echo $this->Form->input('description', array('label' => __('Description')));
        echo $this->Form->input('client_can_update', array('label' => __('Allow Clients to Update Progress')));

        $info = isset($previousPhase) ? $this->Layout->renderHelpIcon(String::insert(__('The previous phase ends on :date'), array('date' => $this->Layout->displayProjectDates($previousPhase['date_end'])))) : '';

        echo $this->Form->input('date_start', array('type' => 'text', 'label' => __('Start Date') . ' ' . $info, 'class' => 'dateFrom', 'prepend' => '<i class="ico-date_next"></i>'));
        echo $this->Form->input('date_end', array('type' => 'text', 'label' => __('End Date'), 'class' => 'dateTo', 'prepend' => '<i class="ico-date_previous"></i>'));


        $this->Html->scriptBlock('
	$(function() {
		$(".dateFrom").datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			numberOfMonths: 3,
			onSelect: function( selectedDate ) {
				$( ".dateTo" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$(".dateTo").datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			numberOfMonths: 3,
			onSelect: function( selectedDate ) {
				$( ".dateFrom" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
                
                $(".dateTo").datepicker("option", "minDate", $(".dateFrom").datepicker("getDate"));
                
	});', array('inline' => false));
        ?>
    </fieldset>
    <div class="form-actions">
        <?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Save & Exit'), array('class' => 'btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
        <?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Save & Add New'), array('name' => 'add_new', 'class' => 'btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="ico-cancel"></i> ' . __('Cancel / Back to Project'), array('controller' => 'projects', 'action' => 'view', $project['Project']['id']), array('escape' => false, 'class' => 'btn')); ?>
    </div>    
    <?php echo $this->Form->end(); ?>
</div>
