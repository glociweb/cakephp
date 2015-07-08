<?php
   /* @var $this CreateflowchartController */
   
   $this->breadcrumbs=array(
   'Createflowchart',
   );
   ?>
<p class="oop"></p>
<div id="sample">
   <div class="container-fluid">
      <div class="sidebar right">
         <div  class="panel panel-default " >
            <div class="panel-heading">
               <i class="fa fa-floppy-o"></i> Chart information
               <p class="remaining" style="float: right;"></p>
            </div>
            <div class="buttons panel-body">
               <div class="form-group">
                  <input type="text" readonly class="Flowcharts_chart_name form-control" id="flowchartname" name="flowchartname" value="<?php echo  !empty($chart) ? $chart['Charts']['chart_name']: '' ; ?>">
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
						<p>you can save image with right click->save as</p>
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
      <div style="display:flex;">
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
				  <?php echo  !empty($chart) ?$chart['Charts']['chart_json']: '' ; ?>
		</textarea>
         </span>
         </div>
         <div id="wiki" class="tab-pane fade">
            <div id="wiki-div" style="padding:5px;border: solid 1px #e2e2e2;overflow:hidden; min-height: 720px">
               <?php echo  !empty($chart) ?$chart['Charts']['chart_wiki']: '' ; ?>
            </div>
         </div>
      </div>
   </div>
</div>
