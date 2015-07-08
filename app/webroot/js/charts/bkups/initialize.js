$(document).on('click','#fullview',function()
{
	$('#myDiagram canvas').addClass('fullscreendata');
	$(this).addClass('smallscreenlink');
})

$(document).on('click','.smallscreenlink',function()
{
	$('#myDiagram canvas').removeClass('fullscreendata');
	$(this).removeClass('smallscreenlink');
})

$(document).scroll(function() {
    var x = $("#sample").position();
    var menupostion = x.top - $(document).scrollTop();
    if (menupostion <= 0) {
        $('#myPalette').addClass('fixed');
        $('#objectinformation').addClass('fixed-setting')
    }
    if (menupostion > 0) {
        $('#myPalette').removeClass('fixed');
        $('#objectinformation').removeClass('fixed-setting');
    }
});



function init() {
    //if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
    var GO = go.GraphObject.make; // for conciseness in defining templates
    	
    var yellowgrad = GO(go.Brush, go.Brush.Linear, {
        0: "rgb(254, 201, 0)",
        1: "rgb(254, 162, 0)"
    });
    var greengrad = GO(go.Brush, go.Brush.Linear, {
        0: "#98FB98",
        1: "#9ACD32"
    });
    var bluegrad = GO(go.Brush, go.Brush.Linear, {
        0: "#B0E0E6",
        1: "#87CEEB"
    });
    var redgrad = GO(go.Brush, go.Brush.Linear, {
        0: "#C45245",
        1: "#7D180C"
    });
    var whitegrad = GO(go.Brush, go.Brush.Linear, {
        0: "#F0F8FF",
        1: "#E6E6FA"
    });
    var bigfont = "bold 13pt Helvetica, Arial, sans-serif";
    var smallfont = "bold 11pt Helvetica, Arial, sans-serif";
    myDiagram =
        GO(go.Diagram, "myDiagram", // must name or refer to the DIV HTML element
            {
                initialContentAlignment: go.Spot.Center,
                allowDrop: true, // must be true to accept drops from the Palette
                "LinkDrawn": showLinkLabel, // this DiagramEvent listener is defined below
                "LinkRelinked": showLinkLabel,
                "animationManager.duration": 800, // slightly longer than default (600ms) animation
                "undoManager.isEnabled": true // enable undo & redo
            });
	
    // when the document is modified, add a "*" to the title and enable the "Save" button
    myDiagram.addDiagramListener("Modified", function(e) {
        var button = document.getElementById("SaveButton");
        if (button) button.disabled = !myDiagram.isModified;
        var idx = document.title.indexOf("*");
        if (myDiagram.isModified) {
            if (idx < 0) document.title += "*";
        } else {
            if (idx >= 0) document.title = document.title.substr(0, idx);
        }
    });

    // helper definitions for node templates

    function nodeStyle() {
        return [
            // The Node.location comes from the "loc" property of the node data,
            // converted by the Point.parse static method.
            // If the Node.location is changed, it updates the "loc" property of the node data,
            // converting back using the Point.stringify static method.
            new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify), {
                // the Node.location is at the center of each node
                locationSpot: go.Spot.Center,
                //isShadowed: true,
                //shadowColor: "#888",
                // handle mouse enter/leave events to show/hide the ports
                mouseEnter: function(e, obj) {
                    showPorts(obj.part, true);
                },
                mouseLeave: function(e, obj) {
                    showPorts(obj.part, false);
                }
            }
        ];
    }

    // Define a function for creating a "port" that is normally transparent.
    // The "name" is used as the GraphObject.portId, the "spot" is used to control how links connect
    // and where the port is positioned on the node, and the boolean "output" and "input" arguments
    // control whether the user can draw links from or to the port.
    function makePort(name, spot, output, input) {
        // the port is basically just a small circle that has a white stroke when it is made visible
        return GO(go.Shape, "Circle", {
            fill: "transparent",
            stroke: null, // this is changed to "white" in the showPorts function
            desiredSize: new go.Size(8, 8),
            alignment: spot,
            alignmentFocus: spot, // align the port on the main Shape
            portId: name, // declare this object to be a "port"
            fromSpot: spot,
            toSpot: spot, // declare where links may connect at this port
            fromLinkable: output,
            toLinkable: input, // declare whether the user may draw links to/from here
            cursor: "pointer" // show a different cursor to indicate potential link point
        });
    }

    // define the Node templates for regular nodes

    var lightText = 'whitesmoke';

    myDiagram.nodeTemplateMap.add("", // the default category
        GO(go.Node, "Spot", nodeStyle(),
            // the main object is a Panel that surrounds a TextBlock with a rectangular Shape
            GO(go.Panel, "Auto",
                GO(go.Shape, "Rectangle", new go.Binding("fill", "color"), {
                        fill: "#00A9C9",
                        stroke: null,
                        name: "SHAPE"
                    },
                    new go.Binding("stroke", "color").makeTwoWay(),
                    new go.Binding("figure", "figure").makeTwoWay()),
                GO(go.TextBlock, {
                        font: "bold 11pt Helvetica, Arial, sans-serif",
                        stroke: lightText,
                        margin: 8,
                        name: "TEXT",
                        maxSize: new go.Size(60, NaN),
                        wrap: go.TextBlock.WrapFit,
                        editable: true
                    },
                    new go.Binding("text", "text").makeTwoWay(),
                    new go.Binding("info", "info").makeTwoWay(),
                     new go.Binding("link", "link").makeTwoWay()
                    )
            ),
            // four named ports, one on each side:
            makePort("T", go.Spot.Top, false, true),
            makePort("L", go.Spot.Left, true, true),
            makePort("R", go.Spot.Right, true, true),
            makePort("B", go.Spot.Bottom, true, false)
        ));

    myDiagram.nodeTemplateMap.add("Start",
        GO(go.Node, "Spot", nodeStyle(),
            GO(go.Panel, "Auto",
                GO(go.Shape, "Circle", new go.Binding("fill", "color"), {
                        minSize: new go.Size(40, 60),
                        fill: "#79C900",
                        stroke: null,
                        name: "SHAPE"
                    },
                    new go.Binding("stroke", "color").makeTwoWay(),
                    new go.Binding("figure", "figure").makeTwoWay()
                ),
                GO(go.TextBlock, "Start", {
                    margin: 5,
                    font: "bold 11pt Helvetica, Arial, sans-serif",
                    name: "TEXT",
                    stroke: lightText,
                     editable: true
                },
                new go.Binding("text", "text").makeTwoWay(),
                    new go.Binding("info", "info").makeTwoWay(),
                     new go.Binding("link", "link").makeTwoWay()
                )
            ),
            // three named ports, one on each side except the top, all output only:
            makePort("L", go.Spot.Left, true, false),
            makePort("R", go.Spot.Right, true, false),
            makePort("B", go.Spot.Bottom, true, false)
        ));

    var defaultAdornment =
        GO(go.Adornment, "Spot",
            GO(go.Panel, "Auto",
                GO(go.Shape, {
                    fill: null,
                    stroke: "dodgerblue",
                    strokeWidth: 4
                }),
                GO(go.Placeholder)),
            // the button to create a "next" node, at the top-right corner
            GO("Button", {
                    alignment: go.Spot.TopRight,
                    click: addNodeAndLink
                }, // this function is defined below
                new go.Binding("visible", "", function(a) {
                    return !a.diagram.isReadOnly;
                }).ofObject(),
                GO(go.Shape, "PlusLine", {
                    desiredSize: new go.Size(6, 6)
                })
            )
        );
    myDiagram.nodeTemplateMap.add("page",
        GO(go.Node, "Spot", nodeStyle(), {
                selectionAdornmentTemplate: defaultAdornment
            },
            // the main object is a Panel that surrounds a TextBlock with a rectangular Shape
            GO(go.Panel, "Auto",
                GO(go.Shape, "Rectangle", new go.Binding("fill", "color"), {
                        fill: "#00A9C9",
                        stroke: null,
                        name: "SHAPE"
                    },
                    new go.Binding("stroke", "color").makeTwoWay(),
                    new go.Binding("figure", "figure").makeTwoWay()
                ),
                GO(go.TextBlock, {
                        font: "bold 11pt Helvetica, Arial, sans-serif",
                        stroke: lightText,
                        margin: 8,
                        name: "TEXT",
                        maxSize: new go.Size(60, NaN),
                        wrap: go.TextBlock.WrapFit,
                        editable: true
                    },
                    new go.Binding("text", "text").makeTwoWay(),
                     new go.Binding("info", "info").makeTwoWay(),
                     new go.Binding("link", "link").makeTwoWay()
                    )
            ),
            // four named ports, one on each side:
            makePort("T", go.Spot.Top, false, true),
            makePort("L", go.Spot.Left, true, true),
            makePort("R", go.Spot.Right, true, true),
            makePort("B", go.Spot.Bottom, true, false)
        ));


    myDiagram.nodeTemplateMap.add("directdata",
        GO(go.Node, "Spot", nodeStyle(),

            GO(go.Panel, "Auto",
                GO(go.Shape, "DirectData", new go.Binding("fill", "color"), {
                        minSize: new go.Size(40, 40),
                        fill: "transparent",
                        name: "SHAPE"
                    },
                    new go.Binding("stroke", "color").makeTwoWay(),
                    new go.Binding("figure", "figure").makeTwoWay(),
                    new go.Binding("strokeWidth", "10"),
                    new go.Binding("strokeDashArray", "dash")),
                GO(go.TextBlock, "DirectData", {
                        margin: 5,
                        font: "bold 11pt Helvetica, Arial, sans-serif",
                        name: "TEXT",
                        editable: true
                    },
                    new go.Binding("text", "text").makeTwoWay(),
                    new go.Binding("info", "info").makeTwoWay(),
                     new go.Binding("link", "link").makeTwoWay()
                )
            ),
            // three named ports, one on each side except the bottom, all input only:
            makePort("L", go.Spot.Left, true, false),
            makePort("R", go.Spot.Right, true, false),
            makePort("B", go.Spot.Bottom, true, false)
        ));

    myDiagram.nodeTemplateMap.add("End",
        GO(go.Node, "Spot", nodeStyle(),
            GO(go.Panel, "Auto",
                GO(go.Shape, "Circle", new go.Binding("fill", "color"), {
                        minSize: new go.Size(40, 60),
                        fill: "#DC3C00",
                        stroke: null,
                        name: "SHAPE"
                    },
                    new go.Binding("stroke", "color").makeTwoWay(),
                    new go.Binding("figure", "figure").makeTwoWay()
                ),
                GO(go.TextBlock, "End", {
                    margin: 5,
                    font: "bold 11pt Helvetica, Arial, sans-serif",
                    name: "TEXT",
                    stroke: lightText
                })
            ),
            // three named ports, one on each side except the bottom, all input only:
            makePort("T", go.Spot.Top, false, true),
            makePort("L", go.Spot.Left, false, true),
            makePort("R", go.Spot.Right, false, true)

        ));

    myDiagram.nodeTemplateMap.add("Comment",
        GO(go.Node, "Auto", nodeStyle(),
            GO(go.Shape, "File", new go.Binding("fill", "color"), {
                    fill: "#EFFAB4",
                    stroke: null,
                    name: "SHAPE"
                },
                new go.Binding("figure", "figure")
            ),
            GO(go.TextBlock, {
                    margin: 5,
                    maxSize: new go.Size(200, NaN),
                    wrap: go.TextBlock.WrapFit,
                    textAlign: "center",
                    editable: true,
                    name: "TEXT",
                    font: "bold 12pt Helvetica, Arial, sans-serif",
                    stroke: '#454545'
                },
                new go.Binding("text", "text").makeTwoWay(),
                new go.Binding("info", "info").makeTwoWay(),
                new go.Binding("link", "link").makeTwoWay()
                )
            // no ports, because no links are allowed to connect with a comment
        ));


    // replace the default Link template in the linkTemplateMap
    myDiagram.linkTemplate =
        GO(go.Link, // the whole link panel
            {
                routing: go.Link.AvoidsNodes,
                curve: go.Link.JumpOver,
                corner: 5,
                toShortLength: 4,
                relinkableFrom: true,
                relinkableTo: true,
                reshapable: true
            },
            new go.Binding("points").makeTwoWay(),
            GO(go.Shape, // the link path shape
                {
                    isPanelMain: true,
                    
                    strokeWidth: 2,
                    name: "SHAPE"
                },
                new go.Binding("fill", "color").makeTwoWay()),
            GO(go.Shape, // the arrowhead
                {
                    toArrow: "standard",
                    stroke: null,
					name: "SHAPE"
                },new go.Binding("fill", "color").makeTwoWay()),
            GO(go.Panel, "Auto", // the link label, normally not visible
                {
                    visible: false,
                    name: "LABEL",
                    segmentIndex: 2,
                    segmentFraction: 0.5
                },
                new go.Binding("visible", "visible").makeTwoWay(),
                GO(go.Shape, "RoundedRectangle", // the label shape
                    {
                        fill: "#F8F8F8",
                        stroke: null,
                        name: "SHAPE"
                    },new go.Binding("fill", "color")),
                GO(go.TextBlock, "Yes", // the label
                    {
                        textAlign: "center",
                        font: "10pt helvetica, arial, sans-serif",
                        stroke: "#333333",
                        editable: true,
                        name: "TEXT",
                    },
                    new go.Binding("text", "text").makeTwoWay())
            )
        );

    // Make link labels visible if coming out of a "conditional" node.
    // This listener is called by the "LinkDrawn" and "LinkRelinked" DiagramEvents.
   
    // temporary links used by LinkingTool and RelinkingTool are also orthogonal:
    myDiagram.toolManager.linkingTool.temporaryLink.routing = go.Link.Orthogonal;
    myDiagram.toolManager.relinkingTool.temporaryLink.routing = go.Link.Orthogonal;

    load(); // load an initial diagram from some JSON text

    // initialize the Palette that is on the left side of the page
    myPalette =
        GO(go.Palette, "myPalette", // must name or refer to the DIV HTML element
            {
                "animationManager.duration": 800, // slightly longer than default (600ms) animation
                nodeTemplateMap: myDiagram.nodeTemplateMap, // share the templates used by myDiagram
                model: new go.GraphLinksModel([ // specify the contents of the Palette
                    {
                        category: "Start",
                        text: "Start"
                    },

                    {
                        category: "page",
                        text: "Page"
                    }, {
                        text: "Step"
                    }, {
                        text: "???",
                        figure: "Diamond"
                    }, {
                        text: "Data",
                        figure: "Parallelogram1"
                    }, {
                        text: "Stop",
                        figure: "StopSign"
                    }, {
                        text: "Message",
                        figure: "MessageToUser"
                    }, {
                        category: "directdata",
                        text: "Data",
                        figure: "Cylinder3"
                    }, {
                        category: "directdata",
                        text: "Data",
                        figure: "Cylinder2"
                    },{
                        category: "End",
                        text: "End"
                    }, {
                        category: "Comment",
                        text: "Comment",
                        figure: "RoundedRectangle"
                    }
                ])
            });


    myPalette.addDiagramListener("InitialLayoutCompleted", function(diagramEvent) {
        var pdrag = document.getElementById("paletteDraggable");
        var palette = diagramEvent.diagram;
        var paddingHorizontal = palette.padding.left + palette.padding.right;
        var paddingVertical = palette.padding.top + palette.padding.bottom;
        //pdrag.style.width = palette.documentBounds.width + 20  + "px";
        //pdrag.style.height = palette.documentBounds.height + 30 + "px";
    });

    var info = document.getElementById("myInfo");
    myDiagram.addDiagramListener("TextEdited", function(e1) 
    {
	//alert('edited');	
		
	});
    
    myDiagram.addDiagramListener("ChangedSelection", function(e1) {
        var sel = e1.diagram.selection;
        var str = "";
        if (sel.count === 0) {
            str = "";
            info.innerHTML = str;
            return;
        } else if (sel.count > 1) {
            str = sel.count + " objects selected.";
            info.innerHTML = str;
            return;
        }
        // One object selected, display some information
        var elem = sel.first();

        var shape = elem.findObject("SHAPE");
        var txtblock = elem.findObject("TEXT");
        str+="<p>Figure:"+shape.figure+"<p>";
        str += "<p>Text: <textarea style='height: 54px; margin: 0px; width: 100%;' id='nodetext'> " + txtblock.text + "</textarea></p>";
        str += "<p>Info: <textarea style='height: 54px; margin: 0px; width: 100%;' id='nodeinfo'> " + txtblock.info + "</textarea></p>";
        str += "<p>Link: <textarea style='height: 54px; margin: 0px; width: 100%;' id='nodelink'> " + txtblock.link + "</textarea></p>";
        var strokeColor = shape.stroke;
        str += '<p style="float: left; margin-right: 10px;">Color: <input type="text" id="custom" /></p>';
        info.innerHTML = str;

        
        $(document).on('keyup','#nodelink',function(a)
        {
			var sel = e1.diagram.selection;
			var elem = sel.first();
			var shape = elem.findObject("SHAPE");
			var txtblock = elem.findObject("TEXT");
			txtblock.link=$(this).val()	;
			//myDiagram.model = go.Model.fromJson(myDiagram.model=myDiagram.model.toJson());
		})
        
        $(document).on('keyup','#nodeinfo',function(a)
        {
			var sel = e1.diagram.selection;
			var elem = sel.first();
			var shape = elem.findObject("SHAPE");
			var txtblock = elem.findObject("TEXT");
			txtblock.info=$(this).val()	;
			 //myDiagram.model = go.Model.fromJson(myDiagram.model=myDiagram.model.toJson());
		})
		$(document).on('keyup','#nodetext',function(a)
        {
			var sel = e1.diagram.selection;
			var elem = sel.first();
			var shape = elem.findObject("SHAPE");
			var txtblock = elem.findObject("TEXT");
			txtblock.text=$(this).val()	;
			//myDiagram.model = go.Model.fromJson(myDiagram.model=myDiagram.model.toJson());
		})
        // Initialize color picker
        $("#custom").spectrum({
            color: strokeColor,

            // Change colors by constructing a gradient
            change: function(color) {
                var c = color.toRgb();
                var r, g, b;
                var grad1 = new go.Brush(go.Brush.Linear);
                r = Math.min(c.r + 10, 255);
                g = Math.min(c.g + 10, 255);
                b = Math.min(c.b + 10, 255);
                grad1.addColorStop(0, "rgb(" + r + "," + g + "," + b + ")");
                grad1.addColorStop(0.5, color.toRgbString());
                r = Math.max(c.r - 30, 0);
                g = Math.max(c.g - 30, 0);
                b = Math.max(c.b - 30, 0);
                grad1.addColorStop(1, "rgb(" + r + "," + g + "," + b + ")");
                shape.fill = grad1;
                shape.stroke = "rgb(" + r + "," + g + "," + b + ")";
                txtblock.stroke = (r < 100 && g < 100 && b < 100) ? "white" : "black";
            }
        });

    });


    $(function() {
        $("#paletteDraggable").draggable({
            handle: "#paletteDraggableHandle"
        }).resizable({
            // After resizing, perform another layout to fit everything in the palette's viewport
            stop: function() {
                myPalette.layoutDiagram(true);
            }
        });
        $("#infoDraggable").draggable({
            handle: "#infoDraggableHandle"
        });
        $('#myDiagram').prepend('<i id="fullview" class="fa fa-arrows-alt link"></i>');
    });



}

// Make all ports on a node visible when the mouse is over the node
function showPorts(node, show) {
    var diagram = node.diagram;
    if (!diagram || diagram.isReadOnly || !diagram.allowLink) return;
    node.ports.each(function(port) {
        port.stroke = (show ? "white" : null);
    });
}
function reload()
{
	myDiagram.model = myDiagram.model.toJson();
}

// Show the diagram's model in JSON format that the user may edit
function save() {
    var json = myDiagram.model.toJson();
    var chartcode = $('#flowchartcode').val();
    var flowchartname = $('#flowchartname').val();
    $.ajax({
        url: base_url + '/createflowchart/saveflowchart',
        type: 'POST',
        datatype: 'json',
        data: {
				'flowchartname': flowchartname,
				'chartcode': chartcode,
				'content': json,
				},
        //data: "flowchartname=" + flowchartname + "&chartcode=" + chartcode + "&content=" + json,
        beforeSend: function() {
            $('#SaveButton').text('saving...');

            // do some loading options
        },
        success: function(data) {
            var data = jQuery.parseJSON(data);
            if (data.status == "success") {
				$('.remaining').html('saved <t>0</t> sec ago');
                var html = '<div class="col-lg-10">';
                html += '<a href="javascript:showchart(\'' + data.code + '\');">';
                html += data.name + '</a></div>';
                if (chartcode == null) $('#all-flowchart').append(html);
                $('#flowchartcode').val(data.code);
                $('#flowchartname').val(data.name);
                var button = document.getElementById("SaveButton");
				button.disabled = !myDiagram.isModified;
            } else {
                $.each(data, function(key, val) {

                    $("." + key).css('border', '1px solid red');
                    $("#" + key + "_em_").text(val);
                    $("#" + key + "_em_").show();
                });
            }
            //$(update).html(data);
        },

        complete: function() {
            // success alerts
            $('#SaveButton').text('Save');
        },

        error: function(data) {
            alert("There may an error on uploading. Try again later");
        },

    });
    myDiagram.isModified = false;
}

function showchart(chartcode,id) {
	$('.remaining t').text(0);
	$(id).parents('.flowcharts').addClass('active');
    $.ajax({
        url: base_url + '/createflowchart/showflowchart',
        type: 'POST',
        datatype: 'json',
        data: "chartcode=" + chartcode,
        beforeSend: function() {

        },
        success: function(data) {
            var data = jQuery.parseJSON(data);
            if (data.status == "success") {
                $('#flowchartcode').val(data.code);
                $('#flowchartname').val(data.name);
                myDiagram.model = go.Model.fromJson(data.json);
            }
            //$(update).html(data);
        },

        complete: function() {

        },

        error: function(data) {
            alert("There may an error . Try again later");
        },

    });
}

function videolink() {
    alert('hieeeee');
}

function addNodeAndLink(e, obj) {
    var adorn = obj.part;
    if (adorn === null) return;
    e.handled = true;
    var diagram = adorn.diagram;
    diagram.startTransaction("Add State");
    // get the node data for which the user clicked the button
    var fromNode = adorn.adornedPart;
    var fromData = fromNode.data;
    // create a new "State" data object, positioned off to the right of the adorned Node
    var toData = {
        text: "new"
    };
    var p = fromNode.location;
    toData.loc = p.x + 200 + " " + p.y; // the "loc" property is a string, not a Point object
    // add the new node data to the model
    var model = diagram.model;
    model.addNodeData(toData);
    // create a link data from the old node data to the new node data
    var linkdata = {};
    linkdata[model.linkFromKeyProperty] = model.getKeyForNodeData(fromData);
    linkdata[model.linkToKeyProperty] = model.getKeyForNodeData(toData);
    // and add the link data to the model
    model.addLinkData(linkdata);
    // select the new Node
    var newnode = diagram.findNodeForData(toData);
    diagram.select(newnode);
    diagram.commitTransaction("Add State");
}

function load() {
	$('.remaining').html('');
    $('#flowchartcode').val("");
    $('#flowchartname').val("");
    myDiagram.model = go.Model.fromJson(document.getElementById("mySavedModel").value);
}

// add an SVG rendering of the diagram at the end of this page
function makeSVG(json) {
	
	 myDiagram.model=go.Model.fromJson(json);
    var svg = myDiagram.makeSvg({
        scale: 1.5
    });
    
    svg.style.border = "1px solid #e2e2e2";
    obj = document.getElementById("SVGArea");
    obj.appendChild(svg);
    if (obj.children.length > 0)
        obj.replaceChild(svg, obj.children[0]);
}

function showsvg(code)
{
	$.ajax({
        url: base_url + '/flowcharts/getflowchart',
        type: 'POST',
        datatype: 'json',
        data: "chartcode=" + code,
        beforeSend: function() {

        },
        success: function(data) {
            var data = jQuery.parseJSON(data);
            if (data.status == "success") {
				$('#chartname').text(data.name);
                makeSVG(data.json);
            }
            //$(update).html(data);
        },

        complete: function() {

        },

        error: function(data) {
            alert("There may an error on uploading. Try again later");
        },

    });
	
}

 function showLinkLabel(e) {
        var label = e.subject.findObject("LABEL");
        if (label !== null) label.visible = (e.subject.fromNode.data.figure === "Diamond");
    }

