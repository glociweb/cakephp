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
		<div class="version-control">
			<h4> Version </h4>
			<label class="label"><?php echo $meetingnotes['Notes']['version']; ?></label>
			<?php echo $this->Html->link('<i class="fa fa-history"></i> ' . __('View History'), array('action' => 'history', $meetingnotes['Notes']['id']), array('escape' => false, 'class' => '')); ?> 
		</div>	
		
<div class="projects index well">
			
		<input type='hidden' id="notecode" value="<?php echo $meetingnotes['Notes']['id']; ?>">
<div id="notecontent" class="view">
<?php
echo $meetingnotes['Notes']['description'];
?>
</div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <div class="btn-toolbar">
        <div class="btn-group">		
            <?php echo $this->Html->link('<i class="ico-pencil"></i> ' . __('Edit Note'), array('action' => 'edit', $meetingnotes['Notes']['id']), array('escape' => false, 'class' => 'btn')); ?> 
            <?php echo $this->Form->postLink('<i class="ico-bin_closed"></i> ' . __('Delete Note'), array('action' => 'delete', $meetingnotes['Notes']['id']), array('escape' => false, 'class' => 'btn btn-danger'), __('Are you sure you want to delete %s?', $meetingnotes['Notes']['title'])); ?> 
            <?php echo $this->Html->link('<i class="ico-table"></i> ' . __('Back to Project Overview'), array('controller'=>'projects','action' => 'view', $meetingnotes['Notes']['project_id']), array('escape' => false, 'class' => 'btn')); ?> 
        </div>
    </div>
</div>
<div class="well smallpadding">
    <span class="label label-info"><?php echo __('Actions'); ?>:</span> 
    <button class="btn btn-mini btn-toggle-comments" data-toggle="button"><?php echo __('Toggle comment threads'); ?></button>
    
</div>
<?php 
echo $this->Html->link('<i class="ico-add"></i> ' . __('New comment'), array('controller' => 'notescomment', 'action' => 'add', $meetingnotes['Notes']['id']), array('class' => 'btn btn-large btn-primary btn-reply btn-new-thread', 'style' => 'margin-bottom: 20px', 'escape' => false));
    echo $this->element('comments/createformnotes', array('comment' => null, 'phase_id' => $meetingnotes['Notes']['id']));

?>

<?php foreach ($meetingnotes['Notescomment'] as $comment): ?>
    <?php echo $this->element('comments/notescomment', array('comment' => $comment, 'phase_id' => $meetingnotes['Notes']['id'])); ?>
<?php endforeach; ?>
<?php /* ?>
<div class="projects index well">
		<h3>Leave a Comment</h3>

	  <form action="post_comment.php" method="post" id="commentform">
        <label for="comment" class="required">Your message</label>
		<textarea style="width:97%;" class="form-control" name="comment" id="comment" rows="10" tabindex="4"  required="required"></textarea>
		<input type="hidden" name="comment_post_ID" value="1" id="comment_post_ID" />
		<button style="float: left;" name="submit" type="submit">Submit comment</button>
		<div style="float: right;">logged in as <b>Superadmin</b> <a href="">logout?</a> </div>
	  </form>
	  <div style="clear:both;"></div>
	<div class="coments-wrap">
		<div class="comment">
			<a href="#" style="font-weight: bold;">
				<img src="http://192.168.1.31/Eb/projectmanager/users/avatar/55796b58-4650-4936-9e22-33f0c0a8011f/admin.png" class="comment-info_img" alt="">
				superadmin
			</a>
			<i>09:00 am</i>
			<div class='right'>
				<p>this is just a test comment this is just a test comment this is just a test comment this is just a test comment this is just a test comment this is just a test comment this is just a test comment this is just a test comment this is just a test comment this is just a test comment </p>
				<div><a href="javascript:replytocomment()">reply</a></div>
			</div>
			
		</div>
		
		<div class="comment">
			<a href="#" style="font-weight: bold;">
				<img src="http://192.168.1.31/Eb/projectmanager/users/avatar/55796b58-4650-4936-9e22-33f0c0a8011f/admin.png" class="comment-info_img" alt="">
				superadmin
			</a>
			<i>09:00 am</i>
			<p>this is just a test comment</p>
			<div><a href="javascript:replytocomment()">reply</a></div>
		</div>
	
	
	</div>
</div>
<?php */ ?>

