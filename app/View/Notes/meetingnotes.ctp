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
<div class="projects index well">
   <div class="btn-toolbar pull-right">
      <div class="btn-group"> 
         <?php echo $this->Html->link('<i class="ico-add"></i> ' . __('New Meeting Note'), array('action' => 'addmeetingnote'), array('escape' => false, 'class' => 'btn btn-primary')); ?>    
      </div>
   </div>
   <h2><?php echo __('Meeting Notes'); ?></h2>
   <p>&nbsp;</p>
   <div class="well smallpadding">
      <span class="label"><?php echo __('Sorting Options: '); ?></span>
      <div class="toolbar">
         <div class="row-fluid">
            <div class="span10">
               <?php echo $this->Html->link(__('Reset'), array('action' => 'index', 'sort' => 'created', 'direction' => 'desc'), array('class' => 'btn btn-small btn-inverse')); ?>
               <?php echo $this->Paginator->sort('title', __('Title'), array('class' => 'btn btn-small')); ?>
               <?php echo $this->Paginator->sort('description', __('Description'), array('class' => 'btn btn-small')); ?>
               <?php echo $this->Paginator->sort('modified', __('Modified'), array('class' => 'btn btn-small')); ?>
               <?php echo $this->Paginator->sort('created', __('Created'), array('class' => 'btn btn-small')); ?>
            </div>
         </div>
      </div>
   </div>
   <?php //echo $this->element('common/defaultpagination'); ?>
   <div class="col-md-10">
      <table class="table table-bordered table-hover">
         <th>Sr. No</th>
         <th>Title</th>
         <th>Slug</th>
         <th>Created date</th>
         <th>Update date</th>
         <th>Actions</th>
         <?php 
         $count=1;
         foreach ($notes as $note): ?>
         <tr>
            <td><?php echo '#'.$count ; ?></td>
            <td><?php echo $note['Notes']['title'] ; ?></td>
            <td><?php echo $note['Notes']['slug'] ; ?></td>
            <td><?php echo date('d M, Y',strtotime($note['Notes']['created']) ); ?></td>
            <td><?php echo date('d M, Y',strtotime($note['Notes']['modified']) ); ?></td>
            <td>
               <div class="btn-group inline">
                  <button data-toggle="dropdown" class="btn btn-mini btn- dropdown-toggle"><i class="ico-cog"></i> Actions <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                     <li><?php echo $this->Html->link('<i class="ico-folder_go"></i>' . __('View'), array('controller' => 'notes', 'action' => 'view', $note['Notes']['id']), array('escape' => false)); ?></li>
                     <li>
						 <?php echo $this->Html->link('<i class="ico-pencil"></i>' . __('Edit'), array('controller' => 'notes', 'action' => 'edit', $note['Notes']['id']), array('escape' => false)); ?></li>
                     <li class="divider"></li>
                     <li>
                     <?php
						echo $this->Form->postLink(
						   $this->Html->tag('i', '', array('class' => 'ico-bin_closed')). " Delete",
								array('action' => 'delete', $note['Notes']['id']),
								array('escape'=>false),
							__('Are you sure you want to delete # %s?', $note['Notes']['id']),
						   array('class' => 'btn btn-mini')
						);
                    
                     
                     ?>
                     </li>
                  </ul>
               </div>
            </td>
         </tr>
         <?php 
         $count++;
         endforeach; ?>
      </table>
   </div>
   <?php
      if (empty($notes))
          echo '<p>' . __('Currently, no meeting note exist.') . '</p>';
      ?>
   <?php //echo $this->element('common/defaultpagination'); ?>
</div>
