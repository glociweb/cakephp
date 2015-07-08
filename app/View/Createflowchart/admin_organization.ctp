<?php
   /* @var $this CreateflowchartController */
   
   $this->breadcrumbs=array(
   'Createflowchart',
   );
   ?>
<script>		
   setInterval(function() {
       if (myDiagram.isModified == true) {
   
           save('org'); // auto save the chart
       }
       
   }, 10000);
   setInterval(function() {
   	if (myDiagram.isModified == true) {
   
   		var old=$('.remaining t').text();
   		$('.remaining t').text(+old + +1);
       }
       
   }, 1000);
   
</script>
<p class="oop"></p>
<div id="sample">
<span class="check">
   <div id="myPalette" style="border: solid 1px #e2e2e2; height: 76px"></div>
</span>
<div class="container-fluid">
   <div class="sidebar left">
      <p id="expandcharts" style="display:none;" class="link fixedlink"><i class="fa fa-plus"></i></p>
      <input type="hidden" value="" name="flowcharcode" id="flowchartcode">
      <div id="floating-left" style="width:240px;display:inline-block;">
         <div class="panel panel-default">
            <div class="panel-heading">
               <i class="fa fa-sitemap"></i> Available Flow Charts  <i id="closecharts" style="float:right;padding: 3px;" class="fa fa-minus link"></i>
            </div>
            <div class="panel-body">
               <div id="all-flowchart" class="">
                  <?php 
     
                     foreach($flowcharts as $key=>$chart) { ?>
                  <div class="col-lg-12 flowcharts">
                     <a href="javascript:showchart('<?php echo $chart['OrgCharts']['id']; ?>',this,'org');">
                     <?php echo $chart['OrgCharts']['chart_name']; ?></a>
                     <i onclick="deletechart('<?php echo $chart['OrgCharts']['id']; ?>',this,'org')" class="fa fa-times-circle-o link deletechart"></i>
                  </div>
                  <?php
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
            <i class="fa fa-floppy-o"></i> Operations
            <p class="remaining" style="float: right;"></p>
         </div>
         <div class="buttons panel-body">
            <div class="form-group">
               <input type="text" class="Flowcharts_chart_name form-control" id="flowchartname" name="flowchartname" placeholder="Name Your flowchart">
               <div style="display:none" id="OrgCharts_chart_name_em_" class="errorMessage"></div>
            </div>
            <button class="savebtn btn btn-primary" id="SaveButton" onclick="save('org')">Save</button>
            <button class="savebtn btn btn-primary" id="newbutton" onclick="load()">Create New</button>
            <!-- Button trigger modal -->
			<button style="padding: 6px 9px;" onclick="createimage()" type="button" class="savebtn btn btn-primary" data-toggle="modal" data-target="#myModal">
				  Create Image
			</button>
			<button id="sharebutton" style="padding: 6px 9px;" onclick="shareorgchart()" type="button" class="savebtn btn btn-primary" data-toggle="modal" data-target="#myModal">
				  Share
				</button>
         </div>
         <!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Chart Image</h4>
						<p class='shareinfo'></p>
					  </div>
					  
					  <div id="chartimageadmin" class="modal-body share">
						  
					  </div>
					  <div class="modal-footer">
						
						
					  </div>
					</div>
				  </div>
				</div>
				<!-- model end -->
      </div>
      <div style="clear:both"></div>
      <div id="objectinformation" class="">
         <div id="paletteDraggable" class="draggable panel panel-default " >
            <div class="panel-heading">
               <i class="fa fa-wrench"></i> Node Setting
            </div>
            <div id="paletteDraggableHandle" class="handle"></div>
            <div id="paletteContainer">
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
               <div id="infoDraggableHandle" class="handle">Information</div>
               <p style="display:none;" class="shapes">Figure:<select  class="form-control" id='shapes'></select>
               <p>
               <div id="myInfo">Selecting nodes in the main Diagram will display information here</div>
            </div>
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
				  { "class": "go.GraphLinksModel",
			  "linkFromPortIdProperty": "fromPort",
			  "linkToPortIdProperty": "toPort",
			  "nodeDataArray": [],
			  "linkDataArray": []}
		</textarea>
      </span>
      </div>
      <div id="wiki" class="tab-pane fade">
         <div id="wiki-div" style="overflow:hidden;  height: 720px">
            <textarea style="height:100%" placeholder="Enter Wiki description here" name='wiki_description' class='richtext form-control' id='wikieditor'></textarea>
         </div>
      </div>
   </div>
</div>
