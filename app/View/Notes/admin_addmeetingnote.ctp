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
<?php
echo $this->Html->script('jquery/chosen/chosen.jquery.min');
echo $this->Html->css('/js/jquery/chosen/chosen.min');
?>
<script type="text/javascript">
    $(function() {
        $(".chosen_selector").chosen({no_results_text: "<?php echo __('No results matched'); ?>"});
    });
</script>

<div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
        <div class="prgresscounter"></div>
    </div>
<div class="add-meeting-note">
<?php echo $this->Form->create('Projects'); //print_r($project); ?>
<?php echo $this->Form->hidden('note_code', array('default'=>md5(time()))); ?>	
<input style="display:none" type="file" class="localuploader">
	<div style="float:right">
		<?php 
		echo $this->Form->input('Projects', array('select' => 'multiple', 'label' => __('Related Project'), 'class' => 'chosen_selector', 'data-placeholder' => __('Select Related Project')));
		 ?>
	</div>
		
		<textarea id="description" style="display:none;" name="data[Notes][description]" style="border:none" name="note_content"> </textarea>
		<div style="display: inline-block;" id="meetingnotes" class="content edit">
			<?php echo $template; ?>
		</div>
		
		<input type="hidden" value="<?php echo $project['Project']['id']; ?>" id="project_id_note">
	<div class="form-actions">
		<?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Save & Exit'), array('class' => 'save-note btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
		<?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Save & Add New'), array('name' => 'add_new', 'class' => 'save_new btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
		<?php echo $this->Html->link('<i class="ico-cancel"></i> ' . __('Cancel / Back to Project'), array('controller' => 'projects', 'action' => 'view', $project['Project']['id']), array('escape' => false,'confirm' => 'are you sure to go back? Changes will discard!', 'class' => 'btn')); ?>
	</div> 
<?php echo $this->Form->end(); ?>
</div>

