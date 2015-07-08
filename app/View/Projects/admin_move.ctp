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
 * @since           ClientEngage - Project Platform v 1.3.3
 * 
 */
?>
<div class="projects form">
    <?php echo $this->Form->create('Project'); ?>
    <fieldset>
        <legend><?php echo __('Move Project'); ?></legend>
        <p><?php echo __('Please select either the new start- or the new end date. You cannot select both at the same time.'); ?></p>
        <?php
        echo $this->Form->input('cur_start', array('label' => __('Current Start Date'), 'enabled' => false, 'readonly' => true, 'type' => 'text', 'value' => $this->Layout->displayProjectDates($project['Project']['date_start'])));
        echo $this->Form->input('cur_end', array('label' => __('Current End Date'), 'enabled' => false, 'readonly' => true, 'type' => 'text', 'value' => $this->Layout->displayProjectDates($project['Project']['date_end'])));
        echo $this->Form->input('new_start', array('label' => __('New Start Date'), 'class' => 'date_start'));
        echo $this->Form->input('new_end', array('label' => __('New End Date'), 'class' => 'date_end'));
        ?>
    </fieldset>
    <div class="form-actions">
        <?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Move Project'), array('class' => 'btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="ico-cancel"></i> ' . __('Cancel'), array('action' => 'index'), array('escape' => false, 'class' => 'btn')); ?>
    </div>    
    <?php echo $this->Form->end(); ?>
</div>

<?php
$this->Html->scriptBlock('
	$(function() {
		$(".date_start, .date_end").datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			numberOfMonths: 3,
		});
		
	});', array('inline' => false));
?>