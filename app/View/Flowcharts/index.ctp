<?php
   /* @var $this CreateflowchartController */
   
   $this->breadcrumbs=array(
   'Createflowchart',
   );
   ?>
<p class="oop"></p>
<div id="sample">
   <div class="container-fluid">
      <div class="sidebar left">
         <p id="expandcharts" style="display:none;" class="link fixedlink"><i class="fa fa-plus"></i></p>
         <input type="hidden" value="" name="flowcharcode" id="flowchartcode">
         <div id="floating-left" style="width:240px;display:inline-block;">
            <div style="clear:both"></div>
            <div class="panel panel-default">
               <div class="panel-heading">
                  <i class="fa fa-sitemap"></i> Available Flow Charts  <i id="closecharts" style="float:right;padding: 3px;" class="fa fa-minus link"></i>
               </div>
               <div class="panel-body">
                  <div id="all-flowchart" class="">
                     <?php 
                        $count=1;
                        foreach($flowcharts as $key=>$chart) { ?>
                     <div class="col-lg-12 flowcharts <?php echo $count==1? 'active':'' ?>">
                        <a href="javascript:showchart('<?php echo $chart['Charts']['id']; ?>',this);">
                        <?php echo $chart['Charts']['chart_name']; ?>
                        </a>
                     </div>
                     <?php
                        $count++;
                         } ?>
                     <!-- /.col-lg-8 (nested) -->
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.panel-body -->
            </div>
         </div>
      </div>
      <div class="sidebar right">
         <div  class="panel panel-default " >
            <div class="panel-heading">
               <i class="fa fa-floppy-o"></i> Chart information
               <p class="remaining" style="float: right;"></p>
            </div>
            <div class="buttons panel-body">
               <div class="form-group">
                  <input type="text" readonly class="Flowcharts_chart_name form-control" id="flowchartname" name="flowchartname" value="<?php echo  !empty($flowcharts) ? $flowcharts[0]['Charts']['chart_name']: '' ; ?>">
                  <div style="display:none" id="Flowcharts_chart_name_em_" class="errorMessage"></div>
               </div>
               <!-- Button trigger modal -->
				<button onclick="createimage()" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
				  Create Image
				</button>
				
               <!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Chart Image</h4>
						<p class="shareinfo"></p>
					  </div>
					  <div id="chartimage" class="modal-body">
						
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					  </div>
					</div>
				  </div>
				</div>
				<!-- model end -->
            </div>
         </div>
         <div style="clear:both"></div>
         <!--  iNFORMATION DIV	 -->
         <div id="paletteDraggable" class="draggable panel panel-default " >
            <div class="panel-heading">
               <i class="fa fa-info"></i> Node Information
            </div>
            <div id="infoDraggable" class="draggable panel-body">
               <div>
                  <div id="circle" class="info"></div>
                  Contain more Information 
               </div>
               <div>
                  <div id="circle" class="link"></div>
                  Contain attachment link
               </div>
               <div id="myInfo">Selecting nodes in the main Diagram will display information here</div>
            </div>
         </div>
      </div>
      <!-- information div end here	-->
      <div class="content">
         <!-- Main hero unit for a primary marketing message or call to action -->
         <span class="chart-outer">
            <div class="col-md">
				<ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#charts">Flow Chart</a></li>
                  <li><a data-toggle="tab" href="#wiki">Wiki Doc</a></li>
               </ul>
               
            </div>
            <div id="charts" class="tab-pane fade in active">
               <div id="myDiagram" style="overflow:hidden;border: solid 1px #e2e2e2; height: 720px">
                  <i class="fa fa-arrows-alt link"></i>
               </div>
               <textarea style="display:none" id="mySavedModel" style="width:100%;height:300px">
				  <?php echo  !empty($flowcharts) ?$flowcharts[0]['Charts']['chart_json']: '' ; ?>
		</textarea>
         </span>
         </div>
         <div id="wiki" class="tab-pane fade">
            <div id="wiki-div" style="padding:5px;border: solid 1px #e2e2e2;overflow:hidden; min-height: 720px">
               <?php echo  !empty($flowcharts) ?$flowcharts[0]['Charts']['chart_wiki']: '' ; ?>
            </div>
         </div>
      </div>
   </div>
</div>
