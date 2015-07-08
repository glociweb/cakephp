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
<ul class="nav nav-tabs phonereflow">
    <li class="">
        <h3 class="pull-right project-tab-header" style="margin: 0 10px 10px 0">
            <?php echo $project['Project']['title']; ?><br/>
            <div class="progress" style="height: 10px">
                <div class="bar" title="<?php echo $project['Project']['percent_completed']; ?>%" data-progress="<?php echo $project['Project']['percent_completed']; ?>" style="width: <?php echo $project['Project']['percent_completed']; ?>%; <?php echo ($project['Project']['percent_completed'] == 0) ? 'color: #000;' : ''; ?>"><?php echo $project['Project']['percent_completed']; ?>%</div>
            </div>
        </h3>
    </li>
    <li class="clearfix"><h3 class="" style=""></h3></li>
    <?php if (count($project['Project']['Phase']) < 1) echo __('No phases'); ?>
    <?php foreach ($project['Project']['Phase'] as $phase): ?>
        <?php
        $status = $this->Layout->getPhaseStatus($phase);

        $data_content = (__('Start:') . ' ' . $this->Layout->displayProjectDates($phase['date_start']) . '<br />' . __('End:') . ' ' . $this->Layout->displayProjectDates($phase['date_end'])) . '<br />';
        $data_content .= __('Duration:') . ' ' . $this->Time->dateDiffDays($phase['date_start'], $phase['date_end']) . (($status != PhaseStatus::Completed) ? ' (' . $this->Time->dateDiffDaysFromNow($phase['date_end']) . ')' : '');

        $icon = $this->Layout->phaseStatusToIcon($status);

        $progress_style = $this->Layout->phaseStatusToProgStyle($status);

        $progress_bar = '<div class="' . $progress_style . '" title="' . $phase['percent_completed'] . '%" style="margin: 3px 0 3px 0; height: 5px">
                                    <div class="bar phaseprogress progress-large ' . $phase['id'] . '" style="width: ' . $phase['percent_completed'] . '%" data-progress="' . $phase['percent_completed'] . '"></div>
                                </div>';

        $phase_num = '<span class="pull-left phase-number">
                                ' . $phase['position'] . '
                                </span>';
        ?>
        <li<?php echo (isset($project['Phase']['id']) ? ($phase['id'] == $project['Phase']['id'] ? ' class="active"' : '' ) : ''); ?>>
            <?php echo $this->Html->link($phase_num . '<div class="inline">' . $icon . ' ' . $phase['title'] . '</div>' . $progress_bar, array('action' => 'phase', $phase['slug']), array('escape' => false, 'data-rel' => 'popover', 'data-original-title' => $phase['title'], 'data-content' => $data_content)); ?>
        </li>
    <?php endforeach; ?>
    <br />
    <br />
    <br />
</ul>