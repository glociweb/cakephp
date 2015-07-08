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
<?php
$alldepartments=array('check department','Development');
?>
<script type="text/javascript">
   $(document).ready(function() {
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
            delimiter: ['#', '@'],
            source: function(query, process, delimiter) {
                // Do your ajax call
                // When using multiple delimiters you can alter the query depending on the delimiter used
                if (delimiter === '@') {
                    $.getJSON(base_url + '/notes/getusers', function(data) {
                        //call process to show the result
                        process(data)
                    });
                }
                if (delimiter === '#') {
                    $.getJSON(base_url + '/notes/getdepartment', function(data) {
                        //call process to show the result
                        process(data)
                    });
                }
            },

            insert: function(item) {
                var html = '';
                var departments='<?php echo json_encode($alldepartments); ?>';
                var departments = jQuery.parseJSON( departments );
                var departments = $.map(departments, function(el) { return el; });
                if($.inArray(item.name, departments) > -1){
					$.getJSON(base_url + '/notes/getuserfromdp/' + item.name, function(data) {
					if(!data.error)
					{
						$.each(data, function(key, val) {
							html += '<a contenteditable="false" href="javascript;">' + val.name + '</a> &nbsp;';
						});
							
					}
						
					});
					alert(html);
					return html;
				}else
				{
					return '<a contenteditable="false" href="javascript;">' + item.name + '</a> &nbsp;';		
				}
            }

        },
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


    $(document).on('click', '#rte-button-cancel', function() {
        window.location.href = '<?php echo Router::url(' / notes ', true); ?>';
    });
});

function getuser(cb) {
    var base_url = '<?php echo Router::url(' / ', true); ?>';
    $.ajax({
        url: base_url + '/notes/getusers',
        type: 'POST',
        success: function(data) {
            var data = jQuery.parseJSON(data);
            cb(data);
        },
        error: function(data) {
            //getuser();
        }
    });

}
   	
</script>
<?php echo $this->Form->create('Notes'); //print_r($project); ?>
		<input placeholder="Enter Note title" name="data[Notes][title]" class="note_title" maxlength="255" type="text" id="NotesTitle"><br>
		<input type="text" id="datepicker">
		<textarea name="data[Notes][description]" class="form-control richtext" rows="5" id="comment"><?php echo $template; ?></textarea>

	<div class="form-actions">
		<?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Save & Exit'), array('class' => 'btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
		<?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Save & Add New'), array('name' => 'add_new', 'class' => 'btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
		<?php echo $this->Html->link('<i class="ico-cancel"></i> ' . __('Cancel / Back to Project'), array('controller' => 'projects', 'action' => 'view', $project['Project']['id']), array('escape' => false, 'class' => 'btn')); ?>
	</div> 
<?php echo $this->Form->end(); ?>
