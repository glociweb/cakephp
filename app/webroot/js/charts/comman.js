 function save() {
    var json = myDiagram.model.toJson();
   var chartcode=$('#flowchartcode').val();
   var flowchartname=$('#flowchartname').val();
    $.ajax({
       url: base_url+'/createflowchart/saveflowchart',
        type: 'POST',
        datatype:'json',
        data:"flowchartname="+flowchartname+"&chartcode="+chartcode+"&content="+json,
        beforeSend: function() {
			$('#SaveButton').text('saving...');
			
            // do some loading options
        },
        success: function (data) {
			var data = jQuery.parseJSON( data );
			if(data.status=="success")
			{
					var html ='<div class="col-lg-10">';
						html+='<a href="javascript:showchart(\''+data.code+'\');">';
						html+=data.name+'</a></div>';
					if(chartcode==null) $('#all-flowchart').append(html);		
					$('#flowchartcode').val(data.code);
					$('#flowchartname').val(data.name);
			}else
			{
				$.each(data, function(key, val) 
               {
					
					$("."+key).css('border','1px solid red'); 
					$("#"+key+"_em_").text(val);                                                    
					$("#"+key+"_em_").show();
            	});
			}
        		//$(update).html(data);
        	},
 
        complete: function() {
            // success alerts
            $('#SaveButton').text('Save');
        },
 
        error: function (data) {
           alert("There may an error on uploading. Try again later");
        },
        
    });
     myDiagram.isModified = false;
  }
  
  function showchart(chartcode)
  {
	   $.ajax({
       url: base_url+'/createflowchart/showflowchart',
        type: 'POST',
        datatype:'json',
        data:"chartcode="+chartcode,
        beforeSend: function() {
            
        },
        success: function (data) {
			var data = jQuery.parseJSON( data );
			if(data.status=="success")
			{
				$('#flowchartcode').val(data.code);
				$('#flowchartname').val(data.name);
				myDiagram.model = go.Model.fromJson(data.json);
			}
        		//$(update).html(data);
        	},
 
        complete: function() {
            
        },
 
        error: function (data) {
           alert("There may an error on uploading. Try again later");
        },
        
    });
  }
  function load() {
	$('#flowchartcode').val("");
	$('#flowchartname').val("");
    myDiagram.model = go.Model.fromJson(document.getElementById("mySavedModel").value);
  }
	setInterval(function(){
	if (myDiagram.isModified==true)
	{
		
		save();       // auto save the chart
	}
     
    },10000);
  // add an SVG rendering of the diagram at the end of this page
  function makeSVG() {
    var svg = myDiagram.makeSvg({
        scale: 0.5
      });
    svg.style.border = "1px solid black";
    obj = document.getElementById("SVGArea");
    obj.appendChild(svg);
    if (obj.children.length > 0) 
      obj.replaceChild(svg, obj.children[0]);
  }
