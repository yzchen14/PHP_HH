<?php
    $servername = "localhost";
    $username = "yzchen14";
    $password = "tsmcdefect";
    $dbname = "mytest";

    // Create connection
//header('Content-Type: application/json; charset=UTF-8'); //設定資料類型為 json，編碼 utf-8
if ($_SERVER['REQUEST_METHOD'] == "POST") { //如果是 POST 請求

    // create csv file
    $csv_filename = 'db_export_'.date('Y-m-d').'.csv';
    $csv_export = '';

    @$ID_list = $_POST['ID_list'];
    $field_name = [];

    $aResult = array();
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = 'SHOW COLUMNS FROM edx_table';
    // query to get data from database
    $result = mysqli_query($conn, $sql);
    //$field = mysql_num_fields($result);
    
    //$csv_export.= 'dummy,';
    while($row = mysqli_fetch_array($result))
    {
        array_push($field_name, $row['Field']);
        $csv_export.= $row['Field'].',';
       // echo $row['Field'];
    }
    $csv_export.= '
    ';
 //   $field = mysql_num_fields($query);
/*
    for($i = 0; $i < $field; $i++) {
        $csv_export.= mysql_field_name($query,$i).',';
      }

    $csv_export.= ' 
    ';

                for($i = 0; $i < $field; $i++) {
                $csv_export.= '"'.$row[mysql_field_name($result,$i)].'",';
              }	
              $csv_export.= '
            ';	
*/

    foreach($ID_list as $IDX){
        $sql ='select * from edx_table WHERE ID ='.$IDX;
        $result = mysqli_query($conn, $sql);
        //$field = mysql_num_fields($result);
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            foreach($field_name as $name){
                $csv_export.= $row[$name].',';
            }
            $csv_export.= '
            ';	
            
        }
        
    }

    $aResult['rsl'] =$csv_export;



    echo json_encode($aResult);
}
?>