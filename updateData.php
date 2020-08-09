<?php
    $servername = "localhost";
    $username = "yzchen14";
    $password = "tsmcdefect";
    $dbname = "mytest";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
//header('Content-Type: application/json; charset=UTF-8'); //設定資料類型為 json，編碼 utf-8
if ($_SERVER['REQUEST_METHOD'] == "POST") { //如果是 POST 請求
    @$idx = $_POST["idx"]; 
    @$date_in= $_POST['date_in'];
    @$mask_in= $_POST['mask_in'];
    @$x8_in= $_POST['x8_in'];
    @$scn_in= $_POST['scn_in'];
    @$comp_in= $_POST['comp_in'];
    @$posx= $_POST['posx'];
    @$posy= $_POST['posy'];
    @$sem_size = $_POST['sem_size'];
    @$bx_status= $_POST['bx_status'];
    @$x8_request= $_POST['x8_request'];
    @$RR_request= $_POST['RR_request'];
    @$EE_name = $_POST['EE_name'];
    @$NOTE = $_POST['Note'];
    $status = "";
    if ($idx != null ) { //如果 nickname 和 gender 都有填寫
        //回傳 nickname 和 gender json 資料
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "UPDATE `edx_table` SET DATE_EDX='$date_in', MASK_ID='$mask_in',
         X8_TOOl='$x8_in', X8=$x8_request, SCN_TOOL='$scn_in', COMPOSITION='$comp_in',
          PX='$posx', PY='$posy',SEM_SIZE='$sem_size', BX='$bx_status', RR=$RR_request, ENGINEER='$EE_name', NOTE='$NOTE' WHERE `id` = $idx";
        if($conn->query($sql)){
            $status.="OK";
        }
    echo json_encode($status);

} 
}
?>