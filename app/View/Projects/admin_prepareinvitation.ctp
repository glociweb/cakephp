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
echo $this->Html->script('jquery/chosen/chosen.jquery.min');
echo $this->Html->css('/js/jquery/chosen/chosen.min');
?>
<script type="text/javascript">
    $(function() {
        $(".chosen_selector").chosen({no_results_text: "<?php echo __('No results matched'); ?>"});

        $('.select_all').on('click', function(e) {
            e.preventDefault();
            $('.chosen_selector option').prop('selected', true);
            $('.chosen_selector').trigger('liszt:updated');
            $('.chosen_selector').blur();
        });
    });
</script>
<div class="projects view">
    <h2><?php echo __('Prepare Project Invitation Email'); ?></h2>
    <dl>
        <dt><?php echo __('Name'); ?></dt>
        <dd>
            <?php echo h($project['Project']['title']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Url'); ?></dt>
        <dd>
            <?php echo h($project['Project']['slug']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Description'); ?></dt>
        <dd>
            <?php echo h($project['Project']['description']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Phases'); ?></dt>
        <dd>
            <?php echo h($project['Project']['phase_count']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('% Completed'); ?></dt>
        <dd>
            <?php echo h($project['Project']['percent_completed']); ?>%
            &nbsp;
        </dd>
        <dt><?php echo __('Date Start'); ?></dt>
        <dd>
            <?php echo $this->Layout->displayProjectDates($project['Project']['date_start']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Date End'); ?></dt>
        <dd>
            <?php echo $this->Layout->displayProjectDates($project['Project']['date_end']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Project Duration'); ?></dt>
        <dd>
            <?php echo $this->Time->dateDiffDays($project['Project']['date_start'], $project['Project']['date_end']); // TODO ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo $this->Layout->displayTimeDefault($project['Project']['created']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd>
            <?php echo $this->Layout->displayTimeDefault($project['Project']['modified']); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<hr/>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <div class="btn-toolbar">
        <div class="btn-group">		
            <?php echo $this->Html->link('<i class="ico-cancel"></i> ' . __('Back to Overview'), array('controller' => 'projects', 'action' => 'view', $project['Project']['id'], 'admin' => true), array('class' => 'btn', 'escape' => false)); ?>
        </div>
    </div>
</div>
<hr/>

<?php echo $this->Form->create('Configuration', array('type' => 'file')); ?>
<h3><?php echo __('Invitation Settings'); ?></h3>
<hr/>
<fieldset>
    <?php
    $recipients = array();

    foreach ($project['Client'] as $client)
    {
        $recipients[$client['title']] = array();
        foreach ($client['User'] as $user)
            $recipients[$client['title']][$user['id']] = $user['username'];
    }

    echo $this->Form->input('Invitation.recipients', array('label' => __('Recipients') . ' ' . $this->Html->link(__('Select all'), '#', array('class' => 'btn btn-mini select_all')), 'select' => 'multiple', 'multiple' => true, 'options' => $recipients, 'class' => 'chosen_selector', 'data-placeholder' => __('Select recipients')));
    echo $this->Form->input('Invitation.subject', array('label' => __('Invitation Email Subject')));
    echo $this->Form->input('Invitation.body', array('label' => __('Invitation Email Template'), 'type' => 'textarea', 'style' => 'width: 500px; height: 250px', 'class' => 'textarea-template'));
    ?>
</fieldset>
<div class="form-actions">
    <?php echo $this->Form->button('<i class="ico-email"></i> ' . __('Send Invitations'), array('class' => 'btn btn-primary blockinterface', 'escape' => false)); ?>
</div>    


<?php echo $this->Form->end(); ?>