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
 * @since           ClientEngage - Project Platform v 1.1.0
 * 
 */
?>
<div class="updater form">
    <?php
    $testing = true;

    echo $this->Html->image('common/logo-clientengage-large.png', array('alt' => 'ClientEngage Logo', 'style' => 'margin-bottom: 25px;'));
    ?>
    <ul class="breadcrumb">
        <li><strong>Update Steps:</strong></li>
        <li class="active">Requirements <span class="divider">/</span></li>
        <li class="active">Update <span class="divider">/</span></li>
        <li class="muted">Completed</li>
    </ul>

    <div class="progress">
        <div class="bar" style="width: 50%; color: #000;">50%</div>
    </div>

    <hr />

    <?php echo $this->Form->create(null); ?>
    <?php echo $this->Form->submit('Perform Update', array('class' => 'btn btn-primary btn-large')); ?>
    <?php echo $this->Form->end(); ?>

</div>
