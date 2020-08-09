
<!DOCTYPE HTML>
<html>
<head>  
<script src="plotly-latest.min.js"></script>
</head>
<body>


<div id="myDiv" style="width:800px;height:600px;"></div>


<script type="text/javascript">
    var initialTime = new Date(2020, 2, 1); 

    var endTime = new Date(); 
    var time_arr = [];
    
    var total_day = 0;

    while( initialTime < endTime ){
    initialTime.setDate(initialTime.getDate() + 1);
    time_arr.push(new Date(initialTime));
    total_day++;
    }
    documnet.write("OK");
    //time_arr.forEach(element => documnet.write(element.yyyymmdd()));
    alert("OK");





function plot_figure(){



    var myPlot = document.getElementById('myDiv'),
    x= ['2013-10-04 22:23:00', '2013-11-04 22:23:00', '2013-12-04 22:23:00'],
    y1= [1, 3, 6],
    move  = [200,200,30],
        //d3 = Plotly.d3,
        //N = 100,
        //x = d3.range(N),
       // y1 = d3.range(N).map( d3.random.normal() ),
       // y2 = d3.range(N).map( d3.random.normal(-2) ),
        //y3 = d3.range(N).map( d3.random.normal(2) ),
    trace1 = { x:x, y:y1, type:'scatter', mode:'lines+markers', name:'Jeff' },
    trace2 = { x:x, y:move, type:'bar', name:'Move', yaxis: 'y2' },

        //trace2 = { x:x, y:y2, type:'scatter', mode:'lines', name:'Terren' },
        //trace3 = { x:x, y:y3, type:'scatter', mode:'lines', name:'Arthur' },
        //data = [ trace1, trace2, trace3 ],
    data = [trace1, trace2],
    
    layout = {
        hovermode:'closest',
        title:'Click on Points to add an Annotation on it',
        yaxis2: {
        title: 'yaxis2 title',
        titlefont: {color: 'rgb(148, 103, 189)'},
        tickfont: {color: 'rgb(148, 103, 189)'},
        overlaying: 'y',
        side: 'right'
    }
        };
    Plotly.newPlot('myDiv', data, layout, {showSendToCloud: false});

    myPlot.on('plotly_click', function(data){
        var pts = '';
        for(var i=0; i<data.points.length; i++){
            annotate_text = "EDX: Sn";
            annotation = {
              text: annotate_text,
              x: data.points[i].x,
              y: parseFloat(data.points[i].y.toPrecision(4)),
              arrowcolor: "#636363",
              ax: 0,
            }
            annotations = myPlot.layout.annotations || [];
            annotations.push(annotation);
            Plotly.relayout('myDiv',{annotations: annotations})
            }
        }


    );



}
</script>


      <?php
echo "<script type='text/javascript'>plot_figure();</script>";
?>

</body>
</html>    