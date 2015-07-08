 function init() {
    if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this

    // Note that we do not use $ here as an alias for go.GraphObject.make because we are using $ for jQuery
    var GO = go.GraphObject.make;  // for conciseness in defining templates

    myDiagram =
      GO(go.Diagram, "myDiagram",  // must name or refer to the DIV HTML element
         { allowDrop: true });  // must be true to accept drops from the Palette

    // define several shared Brushes
    var grad1 = GO(go.Brush, go.Brush.Linear, { 0: "rgb(115,220,241)", 0.5: "rgb(105,210,231)", 1: "rgb(75,180,201)" });
    var brush1 = "rgb(65,180,181)";

    var grad2 = GO(go.Brush, go.Brush.Linear, { 0: "rgb(177,229,226)", 0.5: "rgb(167,219,216)", 1: "rgb(137,189,186)" });
    var brush2 = "rgb(127,179,176)";

    var grad3 = GO(go.Brush, go.Brush.Linear, { 0: "rgb(234,238,214)", 0.5: "rgb(224,228,204)", 1: "rgb(194,198,174)" });
    var brush3 = "rgb(184,188,164)";

    var grad4 = GO(go.Brush, go.Brush.Linear, { 0: "rgb(253,164,58)", 0.5: "rgb(243,134,48)", 1: "rgb(213,104,18)" });
    var brush4 = "rgb(203,84,08)";

    myDiagram.nodeTemplateMap.add("", // default category
      GO(go.Node, "Auto",
        { locationSpot: go.Spot.Center },
        new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
        GO(go.Shape, "Ellipse",
          { strokeWidth: 2, fill: grad1, name: "SHAPE" },
          new go.Binding("figure", "figure"),
          new go.Binding("fill", "fill"),
          new go.Binding("stroke", "stroke")
          ),
        GO(go.TextBlock,
          { margin: 5,
            maxSize: new go.Size(200, NaN),
            wrap: go.TextBlock.WrapFit,
            textAlign: "center",
            editable: true,
            font: "bold 9pt Helvetica, Arial, sans-serif",
            name: "TEXT" },
          new go.Binding("text", "text").makeTwoWay())));


    // initialize the Palette that is in a floating, draggable HTML container
    myPalette = new go.Palette("myPalette");  // must name or refer to the DIV HTML element
    myPalette.nodeTemplateMap = myDiagram.nodeTemplateMap;
    myPalette.model = new go.GraphLinksModel([
      { text: "Lake", fill: grad1, stroke: brush1, figure: "Hexagon" },
      { text: "Ocean", fill: grad2, stroke: brush2, figure: "Rectangle" },
      { text: "Sand", fill: grad3, stroke: brush3, figure: "Diamond" },
      { text: "Goldfish", fill: grad4, stroke: brush4, figure: "Octagon" }
    ]);

    myPalette.addDiagramListener("InitialLayoutCompleted", function(diagramEvent) {
      var pdrag = document.getElementById("paletteDraggable");
      var palette = diagramEvent.diagram;
      var paddingHorizontal = palette.padding.left + palette.padding.right;
      var paddingVertical = palette.padding.top + palette.padding.bottom;
      pdrag.style.width = palette.documentBounds.width + 20  + "px";
      pdrag.style.height = palette.documentBounds.height + 30 + "px";
    });

    var info = document.getElementById("myInfo");
    myDiagram.addDiagramListener("ChangedSelection", function (e) {
      var sel = e.diagram.selection;
      var str = "";
      if (sel.count === 0) {
        str = "Selecting nodes in the main Diagram will display information here.";
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
      str += "Selected Node:";
      str += "Figure: " + shape.figure + "";
      str += "Text: " + txtblock.text + "";
      var strokeColor = shape.stroke;
      str += 'Color: ';
      info.innerHTML = str;

      // Initialize color picker
      $("#custom").spectrum({
          color: strokeColor,

          // Change colors by constructing a gradient
          change: function(color) {
            var c = color.toRgb();
            var r,g,b;
            var grad1 = new go.Brush(go.Brush.Linear);
            r = Math.min(c.r + 10, 255);
            g = Math.min(c.g + 10, 255);
            b = Math.min(c.b + 10, 255);
            grad1.addColorStop(0, "rgb(" + r +","+ g +","+ b + ")");
            grad1.addColorStop(0.5, color.toRgbString());
            r = Math.max(c.r - 30, 0);
            g = Math.max(c.g - 30, 0);
            b = Math.max(c.b - 30, 0);
            grad1.addColorStop(1, "rgb(" + r +","+ g +","+ b+  ")");
            shape.fill = grad1;
            shape.stroke = "rgb(" + r +","+ g +","+ b+  ")";

            txtblock.stroke = (r < 100 && g < 100 && b < 100) ? "white" : "black";
          }
      });
    });




  }
