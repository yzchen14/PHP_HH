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
    $status = "";

    if ($idx != null ) { //如果 nickname 和 gender 都有填寫
        //回傳 nickname 和 gender json 資料
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "DELETE FROM edx_table WHERE id=$idx";
        if($conn->query($sql)){
            $status.="OK";
        }

        echo json_encode($status);

} 
}
?>