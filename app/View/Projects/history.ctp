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
$this->Html->scriptBlock('
$(function() {

});

', array('inline' => false));
?>

<ul class="nav nav-tabs">
    <li class=""><?php echo $this->Html->link('<i class="ico-comment"></i> ' . __('Discussion, Tasks & Attachments'), array('action' => 'phase', $project['Phase']['slug']), array('escape' => false)); ?></li>
    <li class="active"><?php echo $this->Html->link('<i class="ico-date_previous"></i> ' . __('Phase History'), array('action' => 'history', $project['Phase']['slug']), array('escape' => false)); ?></li>
</ul>

<?php echo $this->element('common/defaultpagination'); ?>
<?php foreach ($notifications as $notification): ?>
    <?php echo $this->Layout->renderNotification($notification); ?>
<?php endforeach; ?>
<?php echo $this->element('common/defaultpagination'); ?>