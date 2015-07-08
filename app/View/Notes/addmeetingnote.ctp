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
<!doctype html>

<?php echo $this->Form->create('Notes'); //print_r($project); ?>	
		<textarea id="description" style="display:none;" name="data[Notes][description]" style="border:none" name="note_content"> </textarea>
		<div id="add-meetingnotes" class="content">
			<?php echo $template; ?>
		</div>
	<div class="form-actions">
		<?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Save & Exit'), array('class' => 'save-note btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
		<?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Save & Add New'), array('name' => 'add_new', 'class' => 'save_new btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
		<?php echo $this->Html->link('<i class="ico-cancel"></i> ' . __('Cancel / Back to Project'), array('controller' => 'projects', 'action' => 'view', $project['Project']['id']), array('escape' => false, 'class' => 'btn')); ?>
	</div> 
<?php echo $this->Form->end(); ?>
