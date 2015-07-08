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
<div class="well222">
    <div class="row-fluid">
        <div class="span6">
            <div class="pull-right">
                <?php
                echo $this->element('projects/favourite_button', array('project' => $project));
                ?>
            </div>
            <h2><?php echo $project['title']; ?></h2>
            <p>
                <?php echo $this->Text->truncate($project['description'], 150, array('exact' => false, 'ending' => ' [...]')); ?>
                <br/>
                <strong><?php echo __('Phases'); ?>: </strong> <?php echo $project['phase_count']; ?><br />
                <strong><?php echo __('Start Date'); ?>: </strong> <?php echo $this->Layout->displayProjectDates($project['date_start']); ?><br />
                <strong><?php echo __('End Date'); ?>: </strong> <?php echo $this->Layout->displayProjectDates($project['date_end']); ?>
            </p>
            <?php echo $this->Html->link('<i class="ico-report"></i> ' . __('Launch Project'), array('controller' => 'projects', 'action' => 'dashboard', $project['slug'], 'admin' => false), array('escape' => false, 'class' => 'btn btn-primary btn-large')); ?>
        </div>
        <div class="span6">
            <div class="visible-phone" style="padding: 5px;"></div>
            <div class="progress">
                <div class="bar" data-progress="<?php echo $project['percent_completed']; ?>" style="width: <?php echo $project['percent_completed']; ?>%; <?php echo ($project['percent_completed'] == 0) ? 'color: #000;' : ''; ?>"><?php echo $project['percent_completed']; ?>%</div>
            </div>






            <?php if (!empty($project['Phase'])): ?>
                <ul style="list-style: none;">
                    <?php foreach ($project['Phase'] as $phase): ?>
                        <?php
                        $status = $this->Layout->getPhaseStatus($phase);
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
                            <?php echo $this->Html->link($phase_num . '<div class="inline">' . $icon . ' ' . $phase['title'] . '</div>' . $progress_bar, array('controller' => 'projects', 'action' => 'phase', $phase['slug'], 'admin' => false), array('escape' => false)); ?>
                        </li>
                    <?php endforeach; ?>                
                </ul>
            <?php endif; ?>






        </div>
    </div>
    <hr />
    <?php if (!empty($project['Notification'])): ?>
        <div class="accordion" style="background-color: #fff;">
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse"  href="#<?php echo $project['id']; ?>">
                        <?php
                        $firstNotification = AppLib::arrayFirstEntry($project['Notification']);
                        $newIcon = $this->Time->isToday($firstNotification['created']) ? ' <i class="ico-new" data-original-title="' . String::insert(__('Last activity: :created'), array('created' => $this->Time->timeAgoInWords($firstNotification['created']))) . '" data-rel="tooltip"></i>' : '';
                        ?>
                        <i class="ico-bell"></i> <?php echo __('Recent Project Activity') . $newIcon; ?>
                    </a>
                </div>
                <div id="<?php echo $project['id']; ?>" class="accordion-body collapse" style="height: 0px; ">
                    <div class="accordion-inner">
                        <?php foreach ($project['Notification'] as $notification): ?>
                            <?php echo $this->Layout->renderNotification($notification); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <small class="muted smalltext"><?php echo String::insert(__('Created: :created | Modified: :modified'), array('created' => $this->Layout->displayTimeDefault($project['created']), 'modified' => $this->Layout->displayTimeDefault($project['modified']))); ?></small>


</div>
