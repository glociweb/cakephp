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
<html lang="en">
   <head>
      <meta charset="utf-8">
      <title>jQuery UI Datepicker - Default functionality</title>
      <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
   </head>
   <body>
   </body>
</html>
<script type="text/javascript">
   $(document).ready(function() {
	  getuser(function(data){ 
      tinymce.init({
          selector: ".richtext",
          theme: "modern",
          height: 500,
          plugins: [
              "advlist autolink lists link image charmap print preview hr anchor pagebreak",
              "searchreplace wordcount visualblocks visualchars code fullscreen",
              "insertdatetime media nonbreaking save table contextmenu directionality",
              "emoticons template paste textcolor",
              "mention"
          ],
          toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
          toolbar2: "print preview  | forecolor backcolor emoticons | datepicker",
          image_advtab: true,
          templates: [{
              title: 'Test template 1',
              content: 'Test 1'
          }, {
              title: 'Test template 2',
              content: 'Test 2'
          }],
          mentions: {
              source: data
          },
          
          delimiter: ['@', '#'],
          setup: function(editor) {
              editor.addButton('datepicker', {
                  type: 'button',
                  classes: 'MyCoolBtn',
                  text: 'Datepicker',
                  tooltip: 'Pick a date',
                  onClick: function() {
                      $('#datepicker').datepicker('show');
                  },
                  //icon: true,
              });
          }

      });
  });
      $("#datepicker").datepicker({
          onSelect: function(dateText, inst) {
              // insert into editor
              tinymce.activeEditor.execCommand('mceInsertContent', false, dateText);
          },

          beforeShow: function(input, inst) {
              // change position
              // see http://stackoverflow.com/questions/662220/how-to-change-the-pop-up-position-of-the-jquery-datepicker-control

              var $dpBtn = $(".mce-MyCoolBtn");
              var buttonPos = $dpBtn.position();

              inst.dpDiv.css({
                  // cannot use top: and left: attrs here since they are hard-set inline anyway
                  marginTop: buttonPos.top + $dpBtn.height() - 20 + 'px',
                  marginLeft: buttonPos.left + 'px'
              });
          }
      });
      $("#rte-button-preview").click(function() {
          tinyMCE.activeEditor.execCommand('mcePreview');
          return false;
      });


      $(document).on("click", "#rte-button-publish", function() {
          var selector = $(this);
          $(selector).text('please wait...');
          $(selector).attr('disabled', 'disabled');
          var base_url = '<?php echo Router::url('/', true); ?>';
          var content = tinyMCE.activeEditor.getContent();
		  var name=$('#comment_ifr').contents().find("#title").html();
          $.ajax({
              url: base_url + '/notes/savenotes',
              type: 'POST',
              data: {
                  'content': content,
                  'name':name
              },
              success: function(data) {
                  $(selector).text('save');
                  $(selector).removeAttr('disabled');
              },
              error: function(data) {
                  $(selector).text('save');
                  $(selector).removeAttr('disabled');
                  alert('Some Error Occurred. Please Try Later.');
              }
          });
      });

      $(document).on('click', '#rte-button-cancel', function() {
          window.location.href = '<?php echo Router::url('/notes ', true); ?>';
      });
  });

  function getuser(cb) {
      var base_url = '<?php echo Router::url('/', true); ?>';
      $.ajax({
          url: base_url +'/notes/getusers',
          type: 'POST',
          success: function(data) {
			  var data = jQuery.parseJSON( data );
			 cb(data);
          },
          error: function(data) {
              //getuser();
          }
      });
      
  } 
   	
</script>
<form>
   <input type="text" id="datepicker">
   <textarea class="form-control richtext" rows="5" id="comment"><?php echo $template; ?></textarea>
</form>
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
               <button id="rte-button-publish" class="aui-button aui-button-primary btn btn-primary" type="submit" >
               <span class="trigger-text">Save</span>
               </button>
            </div>
            <button class="toolbar-item-link aui-button aui-button-link btn btn-primary" type="submit" id="rte-button-cancel" name="cancel" value="cancel">Close</button>
         </div>
      </div>
   </div>
</div>
