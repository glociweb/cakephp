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
<style>
#action-text
{
	display:none;
}
</style>

<?php 
$this->Html->scriptBlock('
$(function() {
		var editable_elements = document.querySelectorAll("[contenteditable=true]");
		for(var i=0; i<editable_elements.length; i++)
		editable_elements[i].setAttribute("contentEditable", false);
		$("#NotesTitle").prop("readonly", true);
		
        
});

', array('inline' => false));
?>
		<div class="version-control">
			<h4> Version </h4>
			<label class="label"><?php echo $Noteshistory['Noteshistory']['version']; ?></label>
		</div>	
<script>
   $(document).ready(function(){
	   
		$('#NotesTitle').val('<?php echo $meetingnotes['Notes']['title']; ?>');
   	})
   
   
</script>		
<div class="projects index well">
			
		<input type='hidden' id="notecode" value="<?php echo $Noteshistory['Noteshistory']['note_id']; ?>">
<div id="notecontent" class="view">
<?php
echo $Noteshistory['Noteshistory']['description'];
?>
</div>

</div>
 <div class="form-actions">

        <?php echo $this->Html->link('<i class="ico-table"></i> ' . __('Back to Note'), array('controller' => 'notes', 'action' => 'view', $Noteshistory['Noteshistory']['note_id']), array('class' => 'btn btn-primary', 'escape' => false)); ?>	
    </div>


