<!DOCTYPE html>



<html>


<head>
<link rel="stylesheet" type="text/css" href="mystyle2.css?version=51">
<script src="include/jquery.min.js"></script>
<script src="include/plotly-latest.min.js"></script>

<title>EDX Handover</title>
<link rel="icon" href="img/icon.png">
</head>
<body>

<div id="tab-demo">
    <ul class="tab-title">
        <li><a href="#tab01">EDX Input</a></li>
        <li><a href="#tab02">EDX Table</a></li>
        <li><a href="#tab03">EDX Chart</a></li>
    </ul>
    <div id="tab01" class="tab-inner">
        <table class=customers id=EDXtable></table>
    </div>
    <div id="tab02" class="tab-inner">
        <label class=time_label for="select_tool">Tool: </label>
        <select class="custom-select1" id=select_tool name="SCN">
        <option value="All">All</option>
        <option value="G301">G301</option>
        <option value="G306">G306</option>
        <option value="K302">K302</option>
        <option value="K303">K303</option>
        <option value="K304">K304</option>
        </select>

        <label class=time_label for="start_date">Start date: </label>
        <input type="date" id= start_date name="bday" value="2019-06-01">

        <label class=time_label for="end_date">End date: </label>
        <input type="date" id= end_date name="bday">
        <input type="submit" name="query_table" onclick=query_table() id=query_table value="Query" />
        <input type="submit" name="last_three" onclick=query_table(1) id=last_three value="Last 3 weeks" />
        <input type="submit" name="Export" onclick=export_table() id=export_btn value="Export" />

        <br>
        <div style="width:100%;height:auto;overflow:auto;">
        <table class=customers2 id=EDXView></table>
        </div>
        <div><!-- show SEM image and spectrum -->
            <image id="SEM01" >
        </div>

        <div id="myModal" class="modal">

        <!-- The Close Button -->
        <span class="close">&times;</span>

        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="img01">
        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
        </div>
    </div>

    
    <div id="tab03" class="tab-inner">
        <image src=img/construction.gif>
        <!-- <div id="plot_1" style="width:800px;height:600px;"></div>-->

    </div>
</div>


<?php


?>
<script type="text/javascript">
var ID_list = [];

// set today to end date for the edx table
document.getElementById('end_date').valueAsDate = new Date();

function query_table(last=0){
    if(last){
        var end_date = document.getElementById("end_date").value;
    }
    else{
        var start_date = document.getElementById("start_date").value;
        var end_date = document.getElementById("end_date").value;
    }

    var selected_tool = document.getElementById("select_tool").value;
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "query_table.php",
        data:{
            start_date:start_date,
            end_date:end_date,
            selected_tool:selected_tool,
            ID_list:ID_list

        },
        success: function(obj, textstatus) {
            document.getElementById('EDXView').innerHTML  = obj.result;
            ID_list = obj.ID_list;
            //alert(obj.result);
            //ID_list.forEach(element => console.log(element));
        }
    }
    );

}
/*
function export_table(){
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "export_table.php",
        data:{
            ID_list:ID_list

        },
        success: function(obj, textstatus) {
            console.log(obj.rsl);
        }
    }
    ); 
 
}
*/
// refresh input table
function refresh(){
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "refresh_table.php",
        success: function(obj, textstatus) {
            document.getElementById('EDXtable').innerHTML  = obj.result;
            console.log("Refreshed");
            //alert(obj.result);
        }
    }
    );}
// initial input table
refresh(); 
//plot_figure();
//Inert new data
function insertData(){
    var date_in = document.getElementById('date').value;
    var mask_in = document.getElementById('mask_ID').value;
    var x8_in = document.getElementById('X8_tool').value;
    var scn_in = document.getElementById('SCN_tool').value;
    var comp_in = document.getElementById('COMP').value;
    var posx = document.getElementById('POS_X').value;
    var posy = document.getElementById('POS_Y').value;
    var sem_size =  document.getElementById('P_size').value;
    var bx_status = document.getElementById('BX_clean').value;

    if (document.getElementById('X8_request').value=="Yes"){
        var x8_request = 1;
    }
    else{
        var x8_request = 0;

    }
    if (document.getElementById('RR_check').value=="Yes"){
        var RR_request = 1;
    }
    else{
        var RR_request = 0;

    }
    var EE_name = document.getElementById('EE_name').value;
    var Note = document.getElementById('Note_in').value;

    //alert(x8_request);
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "insertData.php",
        data: { 
                        date_in: date_in,
                        mask_in:mask_in,
                        x8_in: x8_in,
                        scn_in:scn_in,
                        comp_in:comp_in,
                        posx:posx,
                        posy:posy,
                        sem_size:sem_size,
                        bx_status:bx_status,
                        x8_request:x8_request,
                        RR_request:RR_request,
                        EE_name:EE_name,
                        Note:Note
                    },
        success: function(obj, textstatus) {
            console.log(obj); // Inspect this in your console
            //$('#myTable').append('<tr><td></tr>');
            refresh();
        }
    }
    );}
//update existed item
function updateData(id){
        var date_in = document.getElementById('DATE_'+id).value;
        var mask_in = document.getElementById('MASK_'+id).value;
        var x8_in = document.getElementById('X8_tool_'+id).value;
        var scn_in = document.getElementById('SCN_tool_'+id).value;
        var comp_in = document.getElementById('COMP_'+id).value;
        var posx = document.getElementById('POS_X_'+id).value;
        var posy = document.getElementById('POS_Y_'+id).value;
        var sem_size = document.getElementById('P_size_'+id).value;

        var bx_status = document.getElementById('BX_clean_'+id).value;
        //console.log(document.getElementById('X8_request_'+id).value);

        if (document.getElementById('X8_request_'+id).value=="Yes"){
            var x8_request = 1;
        }
        else{
            var x8_request = 0;
        }


        var EE_name = document.getElementById('EE_name_'+id).value;
        var Note = document.getElementById('Note_in_'+id).value;
        if (document.getElementById('RR_check_'+id).value=="Yes"){
            var RR_request = 1;
        }else{
            var RR_request = 0;

        }
        

        $.ajax({
        type: "POST",
        dataType: 'json',
        url: "updateData.php",

        data: { 
                        idx: id,
                        date_in: date_in,
                        mask_in:mask_in,
                        x8_in: x8_in,
                        scn_in:scn_in,
                        comp_in:comp_in,
                        posx:posx,
                        posy:posy,
                        sem_size:sem_size,
                        bx_status:bx_status,
                        x8_request:x8_request,
                        RR_request:RR_request,
                        EE_name:EE_name,
                        Note:Note
                    },
        success: function(data) {
            //console.log(x8_request); // Inspect this in your console
            refresh();
        }
    });

    
                }

// delete item
function deleteData(id){


    var yes = confirm('你確定嗎？');


    if (yes) {
        $.ajax({
        type: "POST",
        dataType: 'json',
        url: "deleteData.php",
        data: { 
                        idx: id,

                    },
        success: function(data) {
            console.log(data); // Inspect this in your console
            refresh();
        }
        
    });

    }                 }
                    
// function for tap
$(function(){
    var $li = $('ul.tab-title li');
        $($li. eq(0) .addClass('active').find('a').attr('href')).siblings('.tab-inner').hide();
    
        $li.click(function(){
            $($(this).find('a'). attr ('href')).show().siblings ('.tab-inner').hide();
            $(this).addClass('active'). siblings ('.active').removeClass('active');
        });
    });

function show_image(idx){
    var SEM01 = document.getElementById("SEM01");
    var img1 = document.getElementById("SEM_"+idx);
    //SEM01.src = img1.src;
}



function modal_Image(img){
    var modal = document.getElementById("myModal");
    // Get the image and insert it inside the modal - use its "alt" text as a caption
    //var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    modal.style.display = "block";
    modalImg.src = img.src;
    //captionText.innerHTML = img.alt;
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
    }

    window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
    }
    window.onkeyup = function(e) {
   var key = e.keyCode ? e.keyCode : e.which;

   if (key == 27) {
    modal.style.display = "none";
   }
        }

}



function plot_figure(){

    var myPlot = document.getElementById('plot_1'),
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
    Plotly.newPlot('plot_1', data, layout, {showSendToCloud: false});

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
</body>
</html>
