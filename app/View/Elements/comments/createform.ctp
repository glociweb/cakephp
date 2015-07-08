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
$class = '';
if ($comment['parent_id'] == null)
    $class = ' rootline';
?>
<div class="comments-create-form well" style="display: none;">
    <?php echo $this->Form->create('Comment', array('url' => array('action' => 'add', $phase_id, $comment['id']), 'type' => 'file', 'class' => 'form-horizontal form-comments', 'inputDefaults' => array('disabled' => true))); ?>
    <fieldset>

        <?php
        echo $this->Form->input('parent_id', array('type' => 'hidden', 'value' => $comment['id']));
        echo $this->Form->input('phase_id', array('type' => 'hidden', 'value' => $phase_id));
        echo $this->Form->tinyMce('content', array('style' => 'width: 100%; height: 50px;', 'inputOnly' => true, 'label' => false));
        echo AppAuth::is(UserRoles::Admin) ? $this->Form->input('admin_only', array(
                    'label' => __('Hide from Clients') . ' ' . $this->Layout->renderHelpIcon('Note: you have to also hide any sub-comments since these may otherwise appear in search results.'),
                    'after' => '</div>')) : '';
        echo $this->Form->input('needsaction', array(
            'label' => __('Make this a task'),
            'class' => 'check-needsaction',
            'after' => ' ' . $this->Form->input('priority', array(
                'inputOnly' => true,
                'style' => 'display: none',
                'class' => 'select-priority',
                'type' => 'select',
                'value' => TaskPriority::Normal,
                'options' => TaskPriority::getAll())) . '</div>'));
        echo $this->Form->input('send_activity', array('type' => 'checkbox', 'checked' => AppConfig::read('Email.checked_default'), 'label' => __('Send email notification to project members?')));
        ?>

        <table class="table table-striped table-bordered table-condensed attachments-table">
            <thead>
                <tr class="attachments-table-title">
                    <th colspan="4"><?php echo $this->Html->link(__('Add attachments'), '#', array('class' => 'preventDefault')); ?> <?php echo $this->Layout->renderExtBlacklistIcon(); ?></th>
                </tr>
                <tr class="attachments-table-header" style="display: none;">
                    <th><?php echo __('Attachment'); ?></th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody class="attachments-table-body" style="display: none;">
                <tr>
                    <td colspan="2">
                        <?php echo $this->Html->link('<i class="ico-attach"></i> ' . __('Add attachment'), array(), array('class' => 'btn btn-mini btn-inverse pull-right btn-add-attachment', 'escape' => false)); ?>
                    </td>
                </tr>
            </tbody>
        </table>


    </fieldset>
    <div class="form-actions">
        <?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-primary btn-comment-submit', 'div' => false)); ?>
        <?php echo $this->Form->button(__('Cancel'), array('type' => 'reset', 'class' => 'btn btn-comment-cancel')); ?>
    </div> 
    <?php echo $this->Form->end(); ?>
</div>
