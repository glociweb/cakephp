$(document).on('click', '#fullview', function() {
    $('#myDiagram').addClass('fullscreendata');
    $(this).addClass('smallscreenlink');
    reload();
})

$(document).on('click', '.smallscreenlink', function() {
    $('#myDiagram').removeClass('fullscreendata');
    $(this).removeClass('smallscreenlink');
})

$(document).scroll(function() {
    var x = $("#sample").position();
    var menupostion = x.top - $(document).scrollTop();
    if (menupostion <= 0) {
        $('#myPalette').addClass('fixed');
        $('#paletteDraggable').addClass('fixed-setting')
    }
    if (menupostion > 0) {
        $('#myPalette').removeClass('fixed');
        $('#paletteDraggable').removeClass('fixed-setting');
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
                allowDrop: false, // must be true to accept drops from the Palette
                "LinkDrawn": showLinkLabel, // this DiagramEvent listener is defined below
                "LinkRelinked": showLinkLabel,
                "animationManager.duration": 800, // slightly longer than default (600ms) animation
                "undoManager.isEnabled": true // enable undo & redo
            });

    myDiagram.isReadOnly = true; // Disable the diagram!
    var nodeSelectionAdornmentTemplate =
        GO(go.Adornment, "Auto",
            GO(go.Shape, {
                fill: null,
                stroke: "deepskyblue",
                strokeWidth: 1.5,
                strokeDashArray: [4, 2]
            }),
            GO(go.Placeholder)
        );
    var nodeResizeAdornmentTemplate =
        GO(go.Adornment, "Spot", {
                locationSpot: go.Spot.Right
            }

        );
    var nodeRotateAdornmentTemplate =
        GO(go.Adornment

        );



    // helper definitions for node templates

    function nodeStyle() {
        return [
            // The Node.location comes from the "loc" property of the node data,
            // converted by the Point.parse static method.
            // If the Node.location is changed, it updates the "loc" property of the node data,
            // converting back using the Point.stringify static method.
            {
                locationSpot: go.Spot.Center
            },
            new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify), {
                selectable: true,
                selectionAdornmentTemplate: nodeSelectionAdornmentTemplate
            }, {
                resizable: false,
                resizeObjectName: "PANEL",
                resizeAdornmentTemplate: nodeResizeAdornmentTemplate
            }, {
                rotatable: false,
                rotateAdornmentTemplate: nodeRotateAdornmentTemplate
            },
            new go.Binding("angle").makeTwoWay()
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
            new go.Binding("angle").makeTwoWay(),
            GO(go.Panel, "Auto", {
                    name: "PANEL"
                },
                new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify),
                GO(go.Shape, "Rectangle", new go.Binding("fill", "color"), {
                        portId: "", // the default port: if no spot on link data, use closest side
                        fromLinkable: false,
                        toLinkable: false,
                        cursor: "pointer",
                        fill: "#00A9C9",
                        stroke: null,
                        name: "SHAPE"
                    },
                    new go.Binding("stroke", "color").makeTwoWay(),
                    new go.Binding("figure", "figure")),
                GO(go.TextBlock, {
                        font: "bold 11pt Helvetica, Arial, sans-serif",
                        stroke: lightText,
                        margin: 8,
                        name: "TEXT",
                        maxSize: new go.Size(60, NaN),
                        wrap: go.TextBlock.WrapFit,
                        editable: false
                    },
                    new go.Binding("stroke", "stroke").makeTwoWay(),
                    new go.Binding("text", "text").makeTwoWay(),
                    new go.Binding("info", "info").makeTwoWay(),
                    new go.Binding("link", "link").makeTwoWay()
                )
            ),
            GO(go.Picture, 
				{ 	source: base_url+"/images/info.png",
					
					width: 20, 
					height: 20 ,
					alignment: new go.Spot(0, 0),
					visible: false,
					
					name: "infoicon"	
				 }, new go.Binding("visible", "visible").makeTwoWay()),
			GO(go.Picture, 
				{ 	source: base_url+"/images/link.png",
					
					width: 15, 
					height: 15 ,
					alignment: new go.Spot(1, 0),
					visible: false,
					
					name: "infoicon2"
			}, new go.Binding("visible", "visible2").makeTwoWay())

        ));
    myDiagram.nodeTemplateMap.add("End",
        GO(go.Node, "Spot", nodeStyle(),
            GO(go.Panel, "Auto", {
                    name: "PANEL"
                },
                new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify),
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
                    },
                    new go.Binding("stroke", "stroke").makeTwoWay(),
                    new go.Binding("text", "text").makeTwoWay(),
                    new go.Binding("info", "info").makeTwoWay(),
                    new go.Binding("link", "link").makeTwoWay())
            ),
           GO(go.Picture, 
				{ 	source: base_url+"/images/info.png",
					
					width: 20, 
					height: 20 ,
					alignment: new go.Spot(0, 0.2),
					visible: false,
					
					name: "infoicon"	
				 }, new go.Binding("visible", "visible").makeTwoWay()),
			GO(go.Picture, 
				{ 	source: base_url+"/images/link.png",
					
					width: 15, 
					height: 15 ,
					alignment: new go.Spot(1, 0.2),
					visible: false,
					
					name: "infoicon2"
			}, new go.Binding("visible", "visible2").makeTwoWay())
        ));
    myDiagram.nodeTemplateMap.add("Diamond", // the default category
        GO(go.Node, "Spot", nodeStyle(),
            // the main object is a Panel that surrounds a TextBlock with a rectangular Shape
            GO(go.Panel, "Auto", {
                    name: "PANEL"
                },
                new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify),
                GO(go.Shape, "Diamond", new go.Binding("fill", "color"), {
                        portId: "", // the default port: if no spot on link data, use closest side
                        fromLinkable: false,
                        toLinkable: false,
                        cursor: "pointer",
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
                    new go.Binding("stroke", "stroke").makeTwoWay(),
                    new go.Binding("text", "text").makeTwoWay(),
                    new go.Binding("info", "info").makeTwoWay(),
                    new go.Binding("link", "link").makeTwoWay()
                )
            ),
            GO(go.Picture, 
				{ 	source: base_url+"/images/info.png",
					
					width: 20, 
					height: 20 ,
					alignment: new go.Spot(0.3, 0.2),
					visible: false,
					
					name: "infoicon"	
				 }, new go.Binding("visible", "visible").makeTwoWay()),
			GO(go.Picture, 
				{ 	source: base_url+"/images/link.png",
					
					width: 15, 
					height: 15 ,
					alignment: new go.Spot(0.7, 0.2),
					visible: false,
					
					name: "infoicon2"
			}, new go.Binding("visible", "visible2").makeTwoWay())

        ));
    myDiagram.nodeTemplateMap.add("Start",
        GO(go.Node, "Spot", nodeStyle(),
            GO(go.Panel, "Auto", {
                    name: "PANEL"
                },
                new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify),
                GO(go.Shape, "Circle", new go.Binding("fill", "color"), {
                        minSize: new go.Size(40, 60),
                        fill: "#79C900",
                        stroke: null,
                        name: "SHAPE"
                    },
                    new go.Binding("stroke", "color").makeTwoWay(),
                    new go.Binding("figure", "figure")
                ),
                GO(go.TextBlock, "Start", {
                        margin: 5,
                        font: "bold 11pt Helvetica, Arial, sans-serif",
                        name: "TEXT",
                        stroke: lightText
                    },
                    new go.Binding("stroke", "stroke").makeTwoWay(),
                    new go.Binding("text", "text").makeTwoWay(),
                    new go.Binding("info", "info").makeTwoWay(),
                    new go.Binding("link", "link").makeTwoWay())
            ),
            GO(go.Picture, 
				{ 	source: base_url+"/images/info.png",
					
					width: 20, 
					height: 20 ,
					alignment: new go.Spot(0, 0.2),
					visible: false,
					
					name: "infoicon"	
				 }, new go.Binding("visible", "visible").makeTwoWay()),
			GO(go.Picture, 
				{ 	source: base_url+"/images/link.png",
					
					width: 15, 
					height: 15 ,
					 alignment: new go.Spot(1, 0.2),
					visible: false,
					
					name: "infoicon2"
			}, new go.Binding("visible", "visible2").makeTwoWay())

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


    myDiagram.nodeTemplateMap.add("directdata",
        GO(go.Node, "Spot", nodeStyle(),

            GO(go.Panel, "Auto", {
                    name: "PANEL"
                },
                new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify),
                GO(go.Shape, "DirectData", new go.Binding("fill", "color"), {
                        minSize: new go.Size(40, 40),
                        fill: "transparent",
                        name: "SHAPE"
                    },
                    new go.Binding("stroke", "color").makeTwoWay(),
                    new go.Binding("figure", "figure"),
                    new go.Binding("strokeWidth", "10"),
                    new go.Binding("strokeDashArray", "dash")),
                GO(go.TextBlock, "DirectData", {
                        margin: 5,
                        font: "bold 11pt Helvetica, Arial, sans-serif",
                        name: "TEXT",
                        editable: false
                    },
                    new go.Binding("text", "text").makeTwoWay(),
                    new go.Binding("info", "info").makeTwoWay(),
                    new go.Binding("link", "link").makeTwoWay()
                )
            ),
            GO(go.Shape, "Circle", {

                fill: "red",
                alignment: new go.Spot(0, 0),
                visible: false,
                desiredSize: new go.Size(12, 12),
                name: "infoicon"
            }, new go.Binding("visible", "visible").makeTwoWay()),
            GO(go.Shape, "Circle", {

                fill: "green",
                alignment: new go.Spot(1, 0),
                visible: false,
                desiredSize: new go.Size(12, 12),
                name: "infoicon2"
            }, new go.Binding("visible", "visible2").makeTwoWay())

        ));


    // replace the default Link template in the linkTemplateMap
    myDiagram.linkTemplate =
        GO(go.Link, // the whole link panel
            {
                routing: go.Link.AvoidsNodes,
                curve: go.Link.JumpOver,
                corner: 5,
                toShortLength: 4,
                relinkableFrom: false,
                relinkableTo: false,
                reshapable: false
            },
            new go.Binding("points").makeTwoWay(),
            new go.Binding("strokeDashArray", "dash").makeTwoWay(),
            new go.Binding("stroke", "color").makeTwoWay(),
            GO(go.Shape, // the link path shape
                {
                    isPanelMain: true,
                    strokeWidth: 2,
                    name: "link"
                },
                new go.Binding("stroke", "color").makeTwoWay(),
                new go.Binding("strokeDashArray", "dash").makeTwoWay()
            ),
            GO(go.Shape, // the arrowhead
                {
                    toArrow: "standard",
                    stroke: null,
                    name: "link"
                }, new go.Binding("stroke", "color").makeTwoWay(),
                new go.Binding("strokeDashArray", "dash").makeTwoWay()
            ),
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
                        name: "link"
                    }, new go.Binding("fill", "color")),
                GO(go.TextBlock, "Yes", // the label
                    {
                        textAlign: "center",
                        font: "10pt helvetica, arial, sans-serif",
                        stroke: "#333333",
                        editable: false,
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



    var info = document.getElementById("myInfo");
    myDiagram.addDiagramListener("TextEdited", function(e1) {
        //alert('edited');	

    });

    myDiagram.addDiagramListener("ChangedSelection", function(e1) {
        var sel = e1.diagram.selection;
        var str = "";
        if (sel.count === 0) {

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
        str += "<p><strong>Text:</strong>" + txtblock.text + "</p>";
        if (txtblock.info) {
            str += "<p><strong>Information:</strong>" + txtblock.info + "</p>";
        };

        if (txtblock.link) {
            str += '<p><a  href="javascript:scroltoview(\'' + txtblock.link + '\')"><strong>Attacment</strong></a></p>';
        };

        info.innerHTML = str;
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


function reload() {
    myDiagram.model = go.Model.fromJson(myDiagram.model.toJson());
}

// Show the diagram's model in JSON format that the user may edit

function showchart(chartcode, id, type) {

    var url = base_url + '/flowcharts/getflowchart';
    if (type == 'org') {
        url = base_url + '/flowcharts/getorgflowchart';
    }
    $.ajax({
        url: url,
        type: 'POST',
        datatype: 'json',
        data: "chartcode=" + chartcode,
        beforeSend: function() {
            $('canvas').addClass('processing');
            $('#myDiagram').prepend('<img class="loader" src="' + base_url + '/images/loader.gif">');
        },
        success: function(data) {
            try {
                var data = jQuery.parseJSON(data);
                if (data.status == "success") {
					$('.nav-tabs a[href="#charts"]').tab('show');
                    $('#flowchartcode').val(data.code);
                    $('#flowchartname').val(data.name);
                    $('#wiki-div').html(data.wiki);
                    myDiagram.model = go.Model.fromJson(data.json);
                    $('canvas').removeClass('processing');
					$('.loader').remove();
                }
            } catch (e) {
                showchart(chartcode, id, type);
            }

        },

        complete: function() {
            
        },

        error: function(data) {
            alert("There may an error on uploading. Try again later");
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
    myDiagram.model = go.Model.fromJson(document.getElementById("mySavedModel").value);
}

// add an SVG rendering of the diagram at the end of this page
function makeSVG(json) {

    myDiagram.model = go.Model.fromJson(json);
    var svg = myDiagram.makeSvg({
        scale: 1.5
    });

    svg.style.border = "1px solid #e2e2e2";
    obj = document.getElementById("SVGArea");
    obj.appendChild(svg);
    if (obj.children.length > 0)
        obj.replaceChild(svg, obj.children[0]);
}
function createimage()
{
	  var json = myDiagram.model.toJson();
	myDiagram.model = go.Model.fromJson(json);
    var svg = myDiagram.makeImage({
        scale: 1
    });

    svg.style.border = "1px solid #e2e2e2";
    svg.style.padding = "10px";
    obj = document.getElementById("chartimage");
    obj.appendChild(svg);
    if (obj.children.length > 0)
        obj.replaceChild(svg, obj.children[0]);
}

function showsvg(code) {
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
function scroltoview(href)
{
	var element_to_scroll_to = $('a[href="'+href+'"]');
	$('#wiki-div a').removeAttr('style');
	setTimeout(
    function() {
      $.scrollTo(element_to_scroll_to);//scroll to target
    }, 300);
	element_to_scroll_to.css('font-size','20px');
	element_to_scroll_to.css('background','yellow');
	$('.nav-tabs a[href="#wiki"]').tab('show');
}

function showLinkLabel(e) {
    var label = e.subject.findObject("LABEL");
    if (label !== null) label.visible = (e.subject.fromNode.data.figure === "Diamond");
}
