<?php
    $servername = "localhost";
    $username = "yzchen14";
    $password = "tsmcdefect";
    $dbname = "mytest";

    // Create connection
//header('Content-Type: application/json; charset=UTF-8'); //設定資料類型為 json，編碼 utf-8
if ($_SERVER['REQUEST_METHOD'] == "POST") { //如果是 POST 請求

    @$start_date= $_POST['start_date'];
    @$end_date= $_POST['end_date'];
    @$selected_tool= $_POST['selected_tool'];
    @$ID_list = $_POST['ID_list'];
    $ID_list = array();

    if($start_date==NULL){ // sub 21 days
        $start_date = date_create($end_date);
        date_sub($start_date,date_interval_create_from_date_string("21 days"));
        $start_date = date_format($start_date,"Y-m-d");
    }

    //$test = strtotime($start_date)->format('Ymd');

    $aResult = array();
    $conn = new mysqli($servername, $username, $password, $dbname);

    //$sql ='select * from `edx_table` WHERE DATE_EDX BETWEEN'.$start_date.' AND '. $end_date.' ORDER BY ID DESC';
    if ($selected_tool=="All"){
       $sql ='select * from `edx_table` WHERE DATE_EDX BETWEEN '.str_replace("-","",$start_date).' AND '.str_replace("-","",$end_date).' ORDER BY DATE_EDX DESC';

    }
    else{
        $sql ='select * from `edx_table` WHERE (SCN_TOOL = "'.$selected_tool.'" ) AND (DATE_EDX BETWEEN '.str_replace("-","",$start_date).' AND '.str_replace("-","",$end_date).')  ORDER BY DATE_EDX DESC';

    }
    //$sql ="select * from `edx_table`  ORDER BY ID DESC";
    
    
    $result = mysqli_query($conn, $sql);
    $return_html = "<th>Date</th
    ><th>Mask ID</th><th>X8/KT Tool</th>
    <th>Scanner Tool</th><th>Composition</th>
    <th>Particle X</th><th>Particle Y</th><th>Size (nm)</th>
    <th>SEM</th><th>OM</th>
    <th>BX</th><th>X8</th>
    <th>RR</th><th>Engineer</th>
    <th>Remark</th>";
    $return_html .= '<tr>';
    $return_html .= '<tbody>';
    
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        array_push($ID_list, $row['ID']);
        $return_html .= "<tr>";
        //$return_html .= "<td>" . $row['id'] . "</td>";
        $return_html .= "<td>" . $row['DATE_EDX']."</td>";
        //$return_html .= '<td><input type="button" class="button" onclick=show_image('.$row['ID'].') value='.$row['MASK_ID'].'></td>';
        $return_html .= '<td>'.$row['MASK_ID']."</td>";
        $return_html .= '<td>'.$row['X8_TOOl']."</td>";
        $return_html .= '<td>'.$row['SCN_TOOL']."</td>";
        $return_html .= '<td>'.$row['COMPOSITION']."</td>";
        $return_html .= '<td>'.$row['PX']."</td>";
        $return_html .= '<td>'.$row['PY']."</td>";
        $return_html .= '<td>'.$row['SEM_SIZE']."</td>";
        $return_html .= '<td><img class="image" id=SEM_'.$row['ID'].' onclick="modal_Image(this)" alt= "None" src='.$row['SEM'] .' width=80 height=50></td>';
        $return_html .= '<td><img class="image" id=OM_'.$row['ID'].' onclick="modal_Image(this)" alt= "None" src='.$row['OM'] .' width=80 height=50></td>';
      
        
        if ($row['BX']=="Wait"){
            $return_html .= '<td style="background-color:yellow">'.$row['BX']."</td>";
        }
        else{
        $return_html .= '<td style="background-color:green">'.$row['BX']."</td>";

        }


        if ($row['X8']==1){
            $return_html .= '<td style="background-color:green" >Yes</td>';

        }
        else{
            $return_html .= '<td style="background-color:yellow">No</td>';

        }
        if ($row['RR']==1){
            $return_html .= '<td style="background-color:yellow">Yes</td>';

        }
        else{
            $return_html .= '<td style="background-color:green">No</td>';

        }
        $return_html .= '<td>'.$row['ENGINEER']."</td>";
        $return_html .= '<td>'.$row['NOTE']."</td>";
        $return_html .= "</tr>";
    }
    $return_html .= '</tbody>';
    $aResult['result']  = $return_html;
    $aResult['ID_list']  =($ID_list);



    echo json_encode($aResult);
}
?>