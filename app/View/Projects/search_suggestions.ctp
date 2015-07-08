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
 * @since           ClientEngage - Project Platform v 1.3.3
 * 
 */
?>

<ul class="search-list" style="max-height: 350px;overflow-y: scroll;">
	
	<!-- Project start -->
    <?php if (!empty($results['Project'])): ?>
		<div class="search-outer">
        <li class="nav-header Project"><?php echo __('Projects'); ?></li>
        <?php foreach ($results['Project'] as $res): ?>
            <li>
                <?php echo $this->Html->link($res['Project']['title'], array('controller' => 'projects', 'action' => 'dashboard', $res['Project']['slug'], 'admin' => false), array('class' => 'resultlink')); ?>
                <small><?php echo $this->Text->truncate($res['Project']['description'], 50); ?></small>
            </li>
        <?php endforeach; ?>
        <?php echo  count($results['Project']) == $limit? "<a class='viewall' alt='Project'>view all projects</a>" :''; ?>
        </div>
    <?php endif; ?>
    <!-- project emd -->
    
    
    
    <!-- phase start -->
    <?php if (!empty($results['Phase'])): ?>
    <div class="search-outer">
        <li class="nav-header Phase"><?php echo __('Phases'); ?></li>
        <?php foreach ($results['Phase'] as $res): ?>
            <li>
                <?php echo $this->Html->link($res['Phase']['title'], array('controller' => 'projects', 'action' => 'phase', $res['Phase']['slug'], 'admin' => false), array('class' => 'resultlink')); ?>
                <small><?php echo $this->Text->truncate($res['Phase']['description'], 50); ?></small>
            </li>
        <?php endforeach; ?>
        <?php echo  count($results['Phase']) == $limit? "<a class='viewall' alt='Phase'>view all phases</a>" :''; ?>
        </div>
    <?php endif; ?>
    <!-- end phase -->
    
    <!-- Comment start -->
    <?php if (!empty($results['Comment'])): ?>
    <div class="search-outer">
        <li class="nav-header Comment"><?php echo __('Comments'); ?></li>
        <?php foreach ($results['Comment'] as $res): ?>
            <li>
                <?php
                echo $this->Html->link($this->Text->truncate(str_replace('&nbsp;', '', strip_tags($res['Comment']['content'])), 60), array('controller' => 'projects', 'action' => 'phase', $res['Phase']['slug'], '#' => $res['Comment']['id'], 'admin' => false), array('class' => 'resultlink'));
                ?>
            </li>
        <?php endforeach; ?>
        <?php echo  count($results['Comment']) == $limit? "<a class='viewall' alt='Comment'>view all comments</a>" :''; ?>
        <div>
    <?php endif; ?>
    <!-- Comment end -->
    
    
    <!-- notes start -->
    <?php if (!empty($results['Notes'])): ?>
    <div class="search-outer">
        <li class="nav-header Notes"><?php echo __('Notes'); ?></li>
        <?php foreach ($results['Notes'] as $res): ?>
            <li>
                <?php
                echo $this->Html->link($this->Text->truncate(str_replace('&nbsp;', '', strip_tags($res['Notes']['title'])), 60), array('controller' => 'Notes', 'action' => 'view', $res['Notes']['id'],'admin' => false), array('class' => 'resultlink'));
                ?>
                <small><?php echo strip_tags($this->Text->truncate($res['Notes']['description'], 50)); ?></small>
            </li>
        <?php endforeach; ?>
        <?php echo  count($results['Notes']) == $limit? "<a class='viewall' alt='Notes'>view all notes</a>" :''; ?>
         </div>
    <?php endif; ?>
    <!-- notes end -->
    
    
    <!-- notesComment start -->
    <?php if (!empty($results['Notescomment'])): ?>
		<div class="search-outer">
        <li class="nav-header Notescomment"><?php echo __('Notes Comment'); ?></li>
        <?php foreach ($results['Notescomment'] as $res): ?>
            <li>
                <?php
                echo $this->Html->link($this->Text->truncate(str_replace('&nbsp;', '', strip_tags($res['Notescomment']['content'])), 60), array('controller' => 'notes', 'action' => 'view', $res['Notescomment']['note_id'],'#' => $res['Notescomment']['id'], 'admin' => false), array('class' => 'resultlink'));
                ?>
            </li>
        <?php endforeach; ?>
			<?php echo  count($results['Notescomment']) == $limit? "<a class='viewall' alt='Notescomment'>view all notecomments</a>" :''; ?>
			 </div>
    <?php endif; ?>
    <!-- notesComment end -->
    
    <!-- if all empty -->
    <?php if (empty($results['Project']) && empty($results['Phase']) && empty($results['Comment']) && empty($results['Notes']) && empty($results['Notescomment'])): ?>
        <li class="nav-header"><?php echo __('No results...'); ?></li>
    <?php endif; ?>
    
    
</ul>
<?php if (count($results['Project']) >1 || count($results['Phase'])>1 || count($results['Comment'])>1 || count($results['Notes'])>1 || count($results['Notescomment'])>1): ?>
<?php echo $this->Html->link(__('View all'), array('controller' => 'projects', 'action' => 'searchresults', $query, 'admin' => false), array('class' => 'btn','style'=>'width:90%')); ?>
<?php endif; ?>
