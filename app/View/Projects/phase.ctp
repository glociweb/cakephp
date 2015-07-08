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
<?php echo $this->element('phase/phaseheader', array('project' => $project)); ?>
<?php
$attachmentRowTemplate = '
<table><tr style="display: none;" class="attachments-row">
    <td>
        ' . $this->Form->input('Attachment.0.type', array(
            'inputOnly' => true,
            'class' => 'input-small select-upload-type',
            'type' => 'select',
            'title' => __('Type'),
            'selected' => AttachmentType::Upload,
            'options' => AttachmentType::getAll())
        ) . '
   
    <br />
        ' . $this->Form->input('Attachment.0.link_url', array(
            'inputOnly' => true,
            'placeholder' => 'http://',
            'style' => 'display: none',
            'class' => 'input-medium input-upload-link-url')) .
        $this->Form->input('Attachment.0.file_name', array(
            'inputOnly' => true,
            'type' => 'file',
            'class' => 'input-upload-file_name input-medium'))
        . '
    <br />
        ' . $this->Form->input('Attachment.0.title', array(
            'inputOnly' => true,
            'placeholder' => __('Description'),
            'class' => 'input-upload-title')) . '
    </td>
    <td>
        ' . $this->Html->link('<i class="ico-delete"></i>', array(), array('class' => 'btn btn-mini btn-remove-attachment', 'escape' => false)) . '
    </td>
</tr></table>';
echo $attachmentRowTemplate;






$this->Html->scriptBlock('
$(function() {

        $(".btn-toggle-comments").click(function(){
           var toggle = !$(this).hasClass("active");
           toggleSubcommentContainers($(this).parents(".container"), toggle);
        });

        $(".btn-show-tasks").click(function(){
           var tasksOnly = !$(this).hasClass("active");
           
           if(tasksOnly)
            {
                $(".comments-container.rootline").find(".comments-container:not(.comment_is_task)").hide("slow");
                $(".comments-container.rootline:not(.comment_is_task)").each(function(){
                    if($(this).find(".comments-container.comment_is_task").length == 0)
                        $(this).hide("slow");
                });
            }
           else
            {
                $(".comments-container").show("slow");
            }


        });
        
        $(".btn-show-comment-thread").click(function(e){
           e.preventDefault();
           toggleSubcommentContainers($(this).parents(".rootline"), false);
        });

        $(".btn-reply").live("click", function(e){
            e.preventDefault();
            resetOpenComments();

            var form = $(this).next(".comments-create-form");
            form.find("*").removeAttr("disabled");
            form.show("slow");
            
            form.find(".select-priority").val("' . TaskPriority::Normal . '");
            form.find(".select-upload-type").val("' . AttachmentType::Upload . '");
            
            $(this).hide("slow");
        });
        $(".btn-comment-cancel").live("click", function(e){
            resetOpenComments();
        });    

 
        $(".btn-comment-submit").live("click", function(e){
   
            var edValue = tinyMCE.get($(this).parents(".form-comments").find("textarea").attr("id")).getContent();

            if($.trim($(edValue).text()) == "")
            {
                alert("' . __('Please enter a comment.') . '");
                e.preventDefault();
                return;
            }

            $.blockUI({ css: { 
                border: "none", 
                padding: "15px", 
                backgroundColor: "#000", 
                "-webkit-border-radius": "10px", 
                "-moz-border-radius": "10px", 
                opacity: .5, 
                color: "#fff" 
            } }); 
            
            if($(this).parents(".comments-create-form").find("tr.attachments-row").length > 0)
                return true; 
            
        });  
        

        $(".check-needsaction").change(function(){
            var checked = $(this).is(":checked");
            
            if(checked)
            {
                $(this).next().fadeIn("fast");
                $(this).next().attr("disabled", false);
            }
            else
            {
                $(this).next().fadeOut("fast");
                $(this).next().attr("disabled", true);
            }
        });
        

        $(".select-upload-type").live("change", function(){
            if($(this).val() == "url")
            {
                $(this).parents("tr").children().find(".input-upload-link-url").show();
                $(this).parents("tr").children().find(".input-upload-file_name").hide();
            }
            else
            {
                $(this).parents("tr").children().find(".input-upload-link-url").hide();
                $(this).parents("tr").children().find(".input-upload-file_name").show();               
            }
        });
        
        $(".attachments-table-title").click(function(){
            $(this).parents(".attachments-table").find(".attachments-table-header, .attachments-table-body").toggle("slow");
            $(this).toggleClass("attachments-table-title-open");
        });
        

        $(".btn-remove-attachment").live("click", function(e){
            e.preventDefault();
            var parent = $(this).parents(".attachments-table");
            $(this).parents("tr").hide("slow", function(){
                $(this).remove();
                resetAttachmentIndizes(parent);
            }); 
        });

        $(".btn-add-attachment").live("click", function(e){
            e.preventDefault();
            var row = $(".attachments-row:first").clone();
            $(this).parents(".attachments-table").find(".attachments-table-body tr:last").before($(row).show("slow"));
            
            resetAttachmentIndizes($(this).parents(".attachments-table"));
        });
        
});


function toggleSubcommentContainers(parent, toggle)
{
    if(toggle)
    {
        $(parent).find(".subcomments-container .comments-container").hide("slow");
        $(parent).find(".btn-show-comment-thread").show("slow");
    }
    else
    {
        $(parent).find(".subcomments-container .comments-container").show("slow");
        $(parent).find(".btn-show-comment-thread").hide("slow", function(){
            if($(".subcomments-container:hidden").length < 1)
                $(".btn-toggle-comments").removeClass("active");
        });
    }

}

function resetAttachmentIndizes(attachmentTable)
{
    var i = 0;
    $(attachmentTable).find(".attachments-table-body tr").each(function(){
        $(this).find("input, select").each(function(){ 
            var curIndex = $(this).attr("name").match(/\d+/);
            var newName = $(this).attr("name").replace(curIndex, i);
            $(this).attr("name", newName);           
        });
        i++;
    });   
}

function resetOpenComments()
{
    $(".comments-create-form, .select-priority").hide("slow");
    $(".btn-reply").show("slow");    
}

', array('inline' => false));




if ($project['Project']['archived'] === false)
{
    $this->Html->scriptBlock('
$(function() {

        $(".check-task_complete").live("click", function(){
           var checked = $(this).is(":checked");
           var checkBox = $(this).parents("form").find(".check-task");
           checkBox.toggleClass("check-task-on");

           $(this).parents("form").find("input.check-task_complete").val(checkBox.hasClass("check-task-on"));

           $.blockUI({ css: { 
                border: "none", 
                padding: "15px", 
                backgroundColor: "#000", 
                "-webkit-border-radius": "10px", 
                "-moz-border-radius": "10px", 
                opacity: .5, 
                color: "#fff" 
            }}); 
           $(this).parents("form").submit();
        });

});


', array('inline' => false));
}
?>

<ul class="nav nav-tabs">
    <li class="active"><?php echo $this->Html->link('<i class="ico-comment"></i> ' . __('Discussion, Tasks & Attachments'), array('action' => 'phase', $project['Phase']['slug']), array('escape' => false)); ?></li>
    <li class=""><?php echo $this->Html->link('<i class="ico-date_previous"></i> ' . __('Phase History'), array('action' => 'history', $project['Phase']['slug']), array('escape' => false)); ?></li>
</ul>


<div class="well smallpadding">
    <span class="label label-info"><?php echo __('Actions'); ?>:</span> 
    <button class="btn btn-mini btn-toggle-comments" data-toggle="button"><?php echo __('Toggle comment threads'); ?></button>
    <button class="btn btn-mini btn-show-tasks" data-toggle="button"><?php echo __('Show tasks only'); ?></button>
</div>


<?php
if ($project['Project']['archived'] === false && AppConfig::read('System.comments_desc') === true)
{
    echo $this->Html->link('<i class="ico-add"></i> ' . __('New comment'), array('controller' => 'comments', 'action' => 'add', $project['Phase']['id']), array('class' => 'btn btn-large btn-primary btn-reply btn-new-thread', 'style' => 'margin-bottom: 20px', 'escape' => false));
    echo $this->element('comments/createform', array('comment' => null, 'phase_id' => $project['Phase']['id']));
}
?>
<?php foreach ($project['Comment'] as $comment): ?>
    <?php echo $this->element('comments/comment', array('comment' => $comment, 'phase_id' => $project['Phase']['id'], 'project' => $project['Project'])); ?>
<?php endforeach; ?>
<?php
if ($project['Project']['archived'] === false && AppConfig::read('System.comments_desc') === false)
{
    echo $this->Html->link('<i class="ico-add"></i> ' . __('New comment'), array('controller' => 'comments', 'action' => 'add', $project['Phase']['id']), array('class' => 'btn btn-large btn-primary btn-reply btn-new-thread', 'escape' => false));
    echo $this->element('comments/createform', array('comment' => null, 'phase_id' => $project['Phase']['id']));
}
?>
