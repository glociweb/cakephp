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
echo $this->Html->script('jquery/chosen/chosen.jquery.min');
echo $this->Html->css('/js/jquery/chosen/chosen.min');
?>
<script type="text/javascript">
    $(function() {
        $(".chosen_selector").chosen({no_results_text: "<?php echo __('No results matched'); ?>"});
    });
</script>
<div class="projects form">
    <?php echo $this->Form->create('Project'); ?>
    <fieldset>
        <legend><?php echo __('Add Project'); ?></legend>
        <?php
        echo $this->Form->input('title', array('label' => __('Name')));
        echo $this->Form->input('description', array('label' => __('Description')));
        echo $this->Form->input('Client', array('select' => 'multiple', 'label' => __('Project Members'), 'class' => 'chosen_selector', 'data-placeholder' => __('Select clients')));
        ?>
    </fieldset>
    <div class="form-actions">
        <?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Create Project'), array('class' => 'btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="ico-cancel"></i> ' . __('Cancel'), array('action' => 'index'), array('escape' => false, 'class' => 'btn')); ?>
    </div>    
    <?php echo $this->Form->end(); ?>
</div>
