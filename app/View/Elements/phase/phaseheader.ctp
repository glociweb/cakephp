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
<div class="well">
    <?php if (AppAuth::is(UserRoles::Admin)) echo $this->Layout->editActions(array('edit', 'delete'), array('id' => $project['Phase']['id'], 'controller' => 'phases', 'class' => 'pull-right', 'linktext' => __('Actions'), 'btn' => '')); ?>
    <?php
    $status = $this->Layout->getPhaseStatus($project['Phase']);
    ?>
    <h1><?php echo $project['Phase']['title']; ?></h1>
    <p><?php echo $project['Phase']['description']; ?></p>
    <p>
        <strong><?php echo __('Start Date'); ?>: </strong> <?php echo $this->Layout->displayProjectDates($project['Phase']['date_start']); ?><br />
        <strong><?php echo __('End Date'); ?>: </strong> <?php echo $this->Layout->displayProjectDates($project['Phase']['date_end']); ?> <br />
        <strong><?php echo __('Duration'); ?>: </strong> <?php echo $this->Time->dateDiffDays($project['Phase']['date_start'], $project['Phase']['date_end']); ?>
        <?php echo ($status != PhaseStatus::Completed) ? '(' . $this->Time->dateDiffDaysFromNow($project['Phase']['date_end']) . ')' : ''; ?>
    </p>
    <hr />
    <?php
    $icon = $this->Layout->phaseStatusToIcon($status);
    $progress_style = $this->Layout->phaseStatusToProgStyle($status);
    ?>
    <div>
        <div class="row-fluid">
            <div class="span1">
                <div class="pull-right">
                    <?php echo $icon; ?>
                </div>
            </div>
            <div class="span11">
                <div class="<?php echo $progress_style; ?>" style="height: 15px;">
                    <div class="bar phaseprogress <?php echo $project['Phase']['id']; ?>" data-progress="<?php echo $project['Phase']['percent_completed']; ?>" style="width: <?php echo $project['Phase']['percent_completed']; ?>%; <?php echo ($project['Phase']['percent_completed'] == 0) ? 'color: #000;' : ''; ?>"><?php echo $project['Phase']['percent_completed']; ?>%</div>
                </div>
            </div>
        </div>

        <?php if ($project['Project']['archived'] === false && ( AppAuth::is(UserRoles::Admin) || $project['Phase']['client_can_update'] === true)): ?>
            <?php echo $this->Form->create('Phase', array('url' => array('controller' => 'phases', 'action' => 'update_progress', 'admin' => false))); ?>
            <div class="row-fluid">
                <div class="span1">
                    <?php
                    echo $this->Form->button('<i class="ico-arrow_refresh"></i>', array('id' => 'btn-updateprogress', 'class' => 'btn btn-mini btn-primary pull-right blockinterface', 'escape' => false, 'disabled' => true, 'title' => __('Update')));
                    echo $this->Form->hidden('Phase.id', array('value' => $project['Phase']['id']));
                    echo $this->Form->hidden('Phase.percent_completed', array('value' => $project['Phase']['percent_completed'], 'id' => 'percent_completed'));
                    $this->Form->unlockField('Phase.percent_completed');
                    ?>
                </div>
                <div class="span11">
                    <div class="progress-slider" style="margin-top: 3px;"></div>
                </div>
                <?php
                $this->Html->scriptBlock('
                    $(function() {
                            $( ".progress-slider" ).slider({
                                min: 0,
                                max: 100,
                                value: ' . $project['Phase']['percent_completed'] . ',
                                slide: function( event, ui ) {
                                            $(".' . $project['Phase']['id'] . '.phaseprogress").each(function(){
                                                $(this).attr("data-progress", ui.value );
                                                $(this).css("width", ui.value + "%"); 
                                                if(!$(this).hasClass("progress-large"))
                                                    $(this).html(ui.value + "%");
                                                else
                                                    $(this).attr("title", ui.value + "%");
                                            });
                                            $("#percent_completed").val(ui.value); 
                                },
                                change: function(event, ui) {
                                    $("#btn-updateprogress").attr("disabled", false);
                                    $(".chk-notify").fadeIn();
                                }
                            });
                    });', array('inline' => false));
                ?>
            </div>
            <div class="row-fluid">
                <div class="span12 chk-notify" style="display: none;">
                    <?php
                    echo $this->Form->input('send_activity', array('type' => 'checkbox', 'checked' => AppConfig::read('Email.checked_default'), 'label' => __('Send email notification to project members?')));
                    ?>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        <?php endif; ?>

    </div>
</div>