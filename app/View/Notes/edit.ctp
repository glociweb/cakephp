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
<form method="post">
  <?php echo $meetingnotes['Notes']['description']; ?>

<div id="savebar-container">
   <div id="rte-savebar" class="aui-toolbar aui-toolbar2">
      <div class="toolbar-split toolbar-split-row">
         <div class="toolbar-split toolbar-split-left">
            <div class="aui-buttons"></div>
         </div>
         <div class="toolbar-split toolbar-split-right">
            <div class="aui-buttons" id="rte-savebar-tinymce-plugin-point"></div>
            <div class="aui-buttons"><span id="rte-spinner" class="toolbar-item">&nbsp;</span></div>
            <div class="aui-buttons toolbar-group-preview" style="height: auto;">
               <button class="aui-button toolbar-item btn btn-primary" id="rte-button-preview" type="button" data-tooltip="Preview (Ctrl+Shift+E)" original-title="">
               <span class="trigger-text">Preview</span>
               </button>
            </div>
            <div class="save-button-container">
				<input id="rte-button-save" type="submit" name="save-note" class="aui-button aui-button-primary btn btn-primary" value="save">
              
            </div>
            <button class="toolbar-item-link aui-button aui-button-link btn btn-primary" type="submit" id="rte-button-cancel" name="cancel" value="cancel">Close</button>
         </div>
      </div>
   </div>
</div>
</form>
