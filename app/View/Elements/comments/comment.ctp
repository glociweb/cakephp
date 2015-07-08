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

if ($comment['needsaction'] === true)
    $class .= ' comment_is_task';
?>
<div class="comments-container<?php echo $class; ?>">


    <div class="avatar-container">
        <?php echo $this->Layout->renderAvatar($comment['User']); ?>
    </div>
    <div class="comment-inner" id="<?php echo $comment['id']; ?>">
        <div class="comment-head">
            <?php echo $this->Layout->renderUsername($comment['User'], true, false); ?>
            <?php echo $comment['admin_only'] ? ' <i class="ico-eye" data-rel="tooltip" data-original-title="' . __('This comment is hidden from clients') . '"></i> ' : ''; ?>
            <?php if (AppAuth::is(UserRoles::Admin)) echo $this->Layout->editActions(array('edit', 'delete'), array('id' => $comment['id'], 'controller' => 'comments', 'class' => 'pull-right', 'linktext' => __('Actions'), 'btn' => '')); ?>
            <small class="pull-right muted displaytime">
                <?php echo $this->Layout->displayTimeDefault($comment['created']); ?>
            </small>
        </div>
        <div class="comment-body">
            <?php if ($comment['needsaction']): ?>
                <?php echo $this->Layout->renderTaskCheckbox($comment, $project['archived']); ?>
            <?php endif; ?>
            <div class="comment-content">
                <?php echo $comment['content']; //$this->Text->autoLinkUrls($comment['content'], array('escape' => false, 'target' => '_blank')); ?>
            </div>
            <div class="clearfix"></div>
        </div>

        <?php if (count($comment['Attachment']) > 0): ?>
            <div class="attachments-body">
                <?php
                foreach ($comment['Attachment'] as $attachment)
                    echo $this->Layout->renderAttachmentInfo($attachment) . '<br />';
                ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="subcomments-container">
		
        <?php if ($comment['parent_id'] == null && count($comment['ChildComment']) > 0) echo $this->Html->link(String::insert(__n('Show :num_comments hidden comment', 'Show :num_comments hidden comments', count($comment['ChildComment'])), array('num_comments' => count($comment['ChildComment']))), '#', array('class' => 'btn-show-comment-thread', 'style' => 'display: none;')); ?>
        <?php if (isset($comment['ChildComment'])) foreach ($comment['ChildComment'] as $childComment): ?>
                <?php echo $this->element('comments/comment', array('comment' => $childComment, 'project' => $project)); ?>
            <?php endforeach; ?>
    </div>
    <?php
    if ($comment['parent_id'] == null && $project['archived'] === false)
        echo $this->Html->link('<i class="ico ico-comments_add"></i> ' . __('Reply'), array('controller' => 'comments', 'action' => 'add', $comment['phase_id'], $comment['id']), array('class' => 'btn btn-mini btn-primary btn-reply', 'escape' => false));
    ?>
    
    <?php if (!isset($comment['parent_id'])) echo $this->element('comments/createform', array('comment' => $comment, 'phase_id' => $comment['phase_id'])); ?>
</div>
