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
        <legend><?php echo __('Edit Project'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('title', array('label' => __('Name')));
        echo $this->Form->input('slug', array('label' => __('Url')));
        echo $this->Form->input('description', array('label' => __('Description')));
        echo $this->Form->input('archived', array('label' => __('Archived')));
        if (!empty($clients))
            echo $this->Form->input('Client', array('select' => 'multiple', 'label' => __('Project Members'), 'class' => 'chosen_selector', 'data-placeholder' => __('Select clients')));
        ?>
    </fieldset>
    <div class="form-actions">
        <?php echo $this->Form->button('<i class="ico-disk"></i> ' . __('Save'), array('class' => 'btn btn-primary blockinterface', 'div' => false, 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="ico-cancel"></i> ' . __('Cancel'), array('action' => 'view', $this->Form->value('Project.id')), array('escape' => false, 'class' => 'btn')); ?>
    </div>    
    <?php echo $this->Form->end(); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <div class="btn-toolbar">
        <div class="btn-group">
            <?php echo $this->Html->link('<i class="ico-folder_go"></i> ' . __('View Project'), array('action' => 'view', $this->Form->value('Project.id')), array('escape' => false, 'class' => 'btn')); ?>		
            <?php echo $this->Form->postLink('<i class="ico-bin_closed"></i> ' . __('Delete'), array('action' => 'delete', $this->Form->value('Project.id')), array('escape' => false, 'class' => 'btn btn-danger'), __('Are you sure you want to delete %s?', $this->Form->value('Project.title'))); ?>	
            <?php echo $this->Html->link('<i class="ico-table"></i> ' . __('List Projects'), array('action' => 'index'), array('escape' => false, 'class' => 'btn')); ?>
        </div>
    </div>
</div>
