<?php
    $servername = "localhost";
    $username = "yzchen14";
    $password = "tsmcdefect";
    $dbname = "mytest";

    // Create connection
//header('Content-Type: application/json; charset=UTF-8'); //設定資料類型為 json，編碼 utf-8
    // create csv file
    $csv_filename = 'db_export_'.date('Y-m-d').'.csv';
    $csv_export = '';
    $where = 'WHERE 1 ORDER BY 1';
    $db_record = 'edx_table';


    $aResult = array();
    $conn = new mysqli($servername, $username, $password, $dbname);
    $sql = 'SHOW COLUMNS FROM edx_table';
    // query to get data from database
    $result = mysqli_query($conn, $sql);
    //$field = mysql_num_fields($result);
    $csv_export.= 'dummy,';
    while($row = mysqli_fetch_array($result))
    {
        $csv_export.= $row['Field'].',';
       // echo $row['Field'];
    }
    header("Content-type: text/x-csv");
    header("Content-Disposition: attachment; filename=".$csv_filename."");
    echo($csv_export);
  
    //echo $csv_export



 //   $field = mysql_num_fields($query);
/*
    for($i = 0; $i < $field; $i++) {
        $csv_export.= mysql_field_name($query,$i).',';
      }

    $csv_export.= ' 
    ';
*/
/*
    foreach($ID_list as $IDX){
        $sql ='select * from `edx_table` WHERE ID='.$IDX;
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            for($i = 0; $i < $field; $i++) {
                $csv_export.= '"'.$row[mysql_field_name($query,$i)].'",';
              }	
              $csv_export.= '
            ';	
        }
    }
*/


?>

