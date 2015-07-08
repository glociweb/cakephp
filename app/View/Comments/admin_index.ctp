<div class="comments index">
    <h2><?php echo __('Tasks'); ?></h2>


    <div class="well smallpadding">
        <span class="label"><?php echo __('Sorting Options: '); ?></span>
        <div class="toolbar">
            <div class="">
                <?php echo $this->Html->link(__('Reset'), array('action' => 'index', 'sort' => 'created', 'direction' => 'desc'), array('class' => 'btn btn-small btn-inverse')); ?>
                <?php echo $this->Paginator->sort('phase_id', __('Phase'), array('class' => 'btn btn-small')); ?>
                <?php echo $this->Paginator->sort('content', __('Comment'), array('class' => 'btn btn-small')); ?>
                <?php echo $this->Paginator->sort('attachment_count', __('Attachments'), array('class' => 'btn btn-small')); ?>
                <?php echo $this->Paginator->sort('created', __('Created'), array('class' => 'btn btn-small')); ?>
            </div>
        </div>
    </div>


    <ul class="nav nav-tabs">
        <?php
        $sel = !empty($this->request->params['named']['status']) ? $this->request->params['named']['status'] : '';
        ?>
        <li<?php echo ($sel == '') ? ' class="active"' : ''; ?>><?php echo $this->Html->link(__('All'), array('action' => 'index')); ?></li>
        <li<?php echo ($sel == 'completed') ? ' class="active"' : ''; ?>><?php echo $this->Html->link(__('Completed'), Hash::merge($this->request->params['named'], array('status' => 'completed'))); ?></li>
        <li<?php echo ($sel == 'pending') ? ' class="active"' : ''; ?>><?php echo $this->Html->link(__('Pending'), Hash::merge($this->request->params['named'], array('status' => 'pending'))); ?></li>
    </ul>

    <table class="table table-bordered table-striped">
        <?php foreach ($comments as $comment): ?>
            <tr>
                <td>
                    <?php echo $this->Html->link($comment['Phase']['title'], array('controller' => 'projects', 'action' => 'phase', $comment['Phase']['slug'], 'admin' => false)); ?><br />
                    <?php if ($comment['Comment']['needsaction']): ?>
                        <?php echo __('Priority') . ': ' . $this->Layout->renderTaskPriorityLabel($comment['Comment']); ?><br />
                        <?php echo __('Completed') . ': ' . ($comment['Comment']['completed_date'] == null ? __('N/A') : $this->Layout->displayTimeDefault($comment['Comment']['completed_date'])); ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php
                    echo $this->Layout->renderUsername($comment['User'], false);

                    echo $this->Layout->displayTimeDefault($comment['Comment']['created']);
                    echo '<small class="comment-preview">' . $this->Text->truncate($comment['Comment']['content'], 150, array('exact' => false, 'ending' => ' [...]', 'html' => true)) . '</small>';

                    foreach ($comment['Attachment'] as $attachment)
                        echo $this->Layout->renderAttachmentInfo($attachment) . '<br />';
                    ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('controller' => 'projects', 'action' => 'phase', $comment['Phase']['slug'], '#' => $comment['Comment']['id'], 'admin' => false), array('class' => 'btn btn-mini')); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($comments)): ?>
            <tr>
                <td colspan="9"><?php echo __('Currently, no attachments exist.'); ?></td>
            </tr>
        <?php endif; ?>
    </table>
    <?php echo $this->element('common/defaultpagination'); ?>

</div>