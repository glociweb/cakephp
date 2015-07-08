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
<div class="projects index">
    <h2><?php echo String::insert(__('Projects of :clientname'), array('clientname' => $overview['Client']['title'])); ?></h2>
    <hr />
    <?php foreach ($overview['Project'] as $project): ?>
        <?php echo $this->element('projects/overview', array('project' => $project)); ?>
    <?php endforeach; ?>
</div>
