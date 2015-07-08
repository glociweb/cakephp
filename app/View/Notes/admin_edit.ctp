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
<?php 
$this->Html->scriptBlock('
$(function() {
		var editable_elements = document.querySelectorAll("[contenteditable=false]");
		for(var i=0; i<editable_elements.length; i++)
		editable_elements[i].setAttribute("contentEditable", true);
		$("#NotesTitle").prop("readonly", false);
});
', array('inline' => false));
?>
<script>
   $(document).ready(function(){
	   var notecode='<?php echo $meetingnotes['Notes']['note_code']; ?>';
   		$.post("<?php echo Router::url(array('controller' => 'Notifications', 'action' => 'getnotesaction', 'admin' => false, 'plugin' => null), true); ?>", {"data[Actionitem][note_code]":""+notecode+"" }, function(data) {
   									$('.action-wrapper').html(data);
   									
   								});
		$('#NotesTitle').val('<?php echo $meetingnotes['Notes']['title']; ?>');
   	})
   
   
</script>
<div id="progress" class="progress">
        <div class="progress-bar progress-bar-success"></div>
        <div class="prgresscounter"></div>
    </div>
<?php echo $this->Form->create('Notes'); //print_r($project); ?>	
		<input type="hidden" value="<?php echo $meetingnotes['Notes']['note_code']; ?>" id="ProjectsNoteCode">
		<textarea id="description" style="display:none;" name="data[Notes][description]" style="border:none" name="note_content"> </textarea>
		<div id="meetingnotes" class="content edit">
			 <?php echo $meetingnotes['Notes']['description']; ?>
		</div>
		<input type="hidden" name="data[Notes][project_id]" value="<?php echo $meetingnotes['Notes']['project_id']; ?>" id="project_id_note">
	<div class="form-actions">
		<?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Save & Exit'), array('class' => 'save-note btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
		<?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Save & Add New'), array('name' => 'add_new', 'class' => 'save_new btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
		<?php echo $this->Html->link('<i class="ico-cancel"></i> ' . __('Cancel / Back to Project'), array('controller' => 'projects', 'action' => 'view', $meetingnotes['Notes']['project_id']), array('escape' => false, 'class' => 'btn')); ?>
	</div> 
<?php echo $this->Form->end(); ?>
