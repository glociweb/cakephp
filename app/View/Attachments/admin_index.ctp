<div class="attachments index">
    <h2><?php echo __('Attachments'); ?></h2>


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


    <table class="table table-bordered table-striped">
        <?php foreach ($comments as $comment): ?>
            <tr>
                <td>
                    <?php echo $this->Html->link($comment['Phase']['title'], array('controller' => 'projects', 'action' => 'phase', $comment['Phase']['slug'])); ?>
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