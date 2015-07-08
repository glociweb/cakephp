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
    <?php echo $this->Form->create('Comment'); ?>
    <fieldset>
        <legend><?php echo __('Edit Comment'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->tinyMce('content', array('label' => __('Comment'), 'style' => 'width: 400px; height: 200px;'));
        echo $this->Form->input('admin_only', array('label' => __('Hide from Clients') . ' ' . $this->Layout->renderHelpIcon('Note: you have to also hide any sub-comments since these may otherwise appear in search results.'), 'class' => 'admin_only'));
        echo AppAuth::is(UserRoles::Admin) ? $this->Form->input('send_activity', array('type' => 'checkbox', 'checked' => false, 'class' => 'send_activity', 'label' => __('Send email notification to project members?') . ' ' . $this->Layout->renderHelpIcon(__('Ticking this option will re-send the Comment-Created message. This is useful if a comment was hidden from clients until now.')))) : '';

        echo $this->Form->input('needsaction', array('label' => __('Make this a task?'), 'class' => 'needsaction'));
        echo $this->Form->input('priority', array('type' => 'select', 'class' => 'priority', 'options' => TaskPriority::getAll(), 'label' => __('Priority')));
        echo $this->Form->input('completed_ip', array('label' => __('Completed IP'), 'disabled' => true));
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