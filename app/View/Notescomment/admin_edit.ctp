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
<div class="comments form">
    <?php echo $this->Form->create('Notescomment'); ?>
    <fieldset>
        <legend><?php echo __('Add Comment'); ?></legend>
        <?php
        echo $this->Form->tinyMce('content', array('label' => __('Comment'), 'style' => 'width: 400px; height: 200px;'));
        
        ?>
    </fieldset>
    <div class="form-actions">
        <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-primary')); ?>
    </div>    
</div>
<script type="text/javascript">
    $(function() {
        if ($(".admin_only").is(":checked"))
        {
            $(".send_activity").parents(".control-group").hide();
        }

        $(".admin_only").change(function() {
            if ($(this).is(":checked"))
            {
                $(".send_activity").parents(".control-group").hide("slow");
                $(".send_activity").attr("checked", false);
            }
            else
            {
                $(".send_activity").parents(".control-group").show("slow");
            }
        });


        if (!$(".needsaction").is(":checked"))
        {
            $(".priority").parents(".control-group").hide();
        }

        $(".needsaction").change(function() {
            if (!$(this).is(":checked"))
            {
                $(".priority").parents(".control-group").hide("slow");
            }
            else
            {
                $(".priority").parents(".control-group").show("slow");
            }
        });


    });
</script>
