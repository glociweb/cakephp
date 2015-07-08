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
<div style="float:left;width: 100%;" class="col-sm-4">
   <div class="span8">
      <?php 
         if(empty($p_notification)) echo "<div class='well'>No recent activity</div>";
         foreach($p_notification as $notification)
         {
         ?>
      <?php echo $this->Layout->renderNotification($notification); ?>
      <?php } ?>
   </div>
   <div style="width:27%;float:left;margin-left:27px" class="well">
      <h4>My action Items</h4>
      <div>
         <!-- Nav tabs -->
         <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#pending" aria-controls="pending" role="tab" data-toggle="tab">Pending</a></li>
            <li role="presentation"><a href="#completed" aria-controls="profile" role="tab" data-toggle="tab">Completed</a></li>
         </ul>
         <!-- Tab panes -->
         <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="pending">	
               <ul style="margin:0px">
                  <?php //echo "<pre>";print_r($mytactonitems);
                     if(empty($mytactonitems)) echo "<li style='list-style:none'><i></i>There is no pending Action Items for now.</i></li>";
                     foreach($mytactonitems as $mytactonitem)
                     { ?>
                  <li class='actio-list' style="list-style:none">
                     <input data-original-title="mark as done" data-rel="tooltip" type="checkbox" name="close" class='mark-as-complete' alt="<?php echo $mytactonitem['Actionitems']['id'] ?>">
                     <?php echo $this->Html->link( __($mytactonitem['Actionitems']['action_content']), array('controller' => 'notes', 'action' => 'view', $mytactonitem['Actionitems']['id']), array('escape' => false)); ?>
                     on <?php echo $this->Html->link( __($mytactonitem['Notes']['title']), array('controller' => 'notes', 'action' => 'view', $mytactonitem['Notes']['id']), array('escape' => false)); ?>
                     
                     in <?php echo $this->Html->link( __($mytactonitem['Project']['title']), array('controller' => 'projects', 'action' => 'dashboard', $mytactonitem['Project']['slug']), array('escape' => false)); ?>
                     </br>
                     <i  class="label"><?php echo $this->Time->timeAgoInWords($mytactonitem['Actionitems']['modified']); ?></i>	
                  </li>
                  <?php } ?>
               </ul>
            </div>
            <div role="tabpanel" class="tab-pane" id="completed">
               <?php 
                  //echo "<pre>";print_r($mytactonitems);
                  if(empty($mytactonitems_completed)) echo "<li style='list-style:none'><i></i>There is no Completed Action Items for now.</i></li>";
                  foreach($mytactonitems_completed as $completed)
                  { ?>
               <li class='actio-list' style="list-style:none">
                  <input checked data-original-title="reopen this item" data-rel="tooltip" type="checkbox" name="reopen" class='mark-as-complete' alt="<?php echo $completed['Actionitems']['id'] ?>">
                     <?php echo $this->Html->link( __($completed['Actionitems']['action_content']), array('controller' => 'notes', 'action' => 'view', $completed['Actionitems']['id']), array('escape' => false)); ?>
                     on <?php echo $this->Html->link( __($completed['Notes']['title']), array('controller' => 'notes', 'action' => 'view', $completed['Notes']['id']), array('escape' => false)); ?>
                     
                     in <?php echo $this->Html->link( __($completed['Project']['title']), array('controller' => 'projects', 'action' => 'dashboard', $completed['Project']['slug']), array('escape' => false)); ?>
                     </br>
                  completed <i  class="label"><?php echo $this->Time->timeAgoInWords($completed['Actionitems']['modified']); ?></i>	
               </li>
               <?php } ?>
            </div>
         </div>
      </div>
      <h4>Latest Notes</h4>
      <ul style="margin:0px">
         <?php 
            if(empty($latestnotes)) echo "<li>There is no latest note for now.</li>";
            foreach($latestnotes as $notes)
            { ?>
         <li class='actio-list' style="list-style:none">
            <?php echo $this->Html->link( __($notes['Notes']['title']), array('controller' => 'notes', 'action' => 'view', $notes['Notes']['id']), array('escape' => false)); ?>
            <i style='float:right' class="label"><?php echo $this->Time->timeAgoInWords($notes['Notes']['created']); ?></i>	
         </li>
         <?php } ?>
      </ul>
      <h4>Latest Organization Flowcharts</h4>
      <?php $flowcharts = $this->requestAction(array('controller' => 'flowcharts', 'action' => 'latestorganization','admin' => false, 'plugin' => null));
      
       ?>
      
      <ul style="margin:0px">
         <?php 
            if(empty($flowcharts)) echo "<li>There is no latest Organization chart for you.</li>";
            foreach($flowcharts as $orgchart)
            { ?>
         <li class='actio-list' style="list-style:none">
            <?php echo $this->Html->link( __($orgchart['OrgCharts']['chart_name']), array('controller' => 'flowcharts', 'action' => 'orgflowchart', $orgchart['OrgCharts']['id']), array('escape' => false)); ?>
            <i style='float:right' class="label"><?php echo $this->Time->timeAgoInWords($orgchart['OrgCharts']['created']); ?></i>	
         </li>
         <?php } ?>
      </ul>
      <h4>latest Flowcharts</h4>
      <?php $flowcharts2 = $this->requestAction(array('controller' => 'flowcharts', 'action' => 'latestcharts','admin' => false, 'plugin' => null));
      
       ?>
      <ul style="margin:0px">
         <?php 
            if(empty($flowcharts2)) echo "<li>There is no latest chart for you.</li>";
            foreach($flowcharts2 as $chart)
            { ?>
         <li class='actio-list' style="list-style:none">
            <?php echo $this->Html->link( __($chart['Charts']['chart_name']), array('controller' => 'flowcharts', 'action' => 'flowchart', $chart['Charts']['id']), array('escape' => false)); ?>
            <i style='float:right' class="label"><?php echo $this->Time->timeAgoInWords($chart['Charts']['created']); ?></i>	
         </li>
         <?php } ?>
      </ul>
   </div>
</div>
