<?php
    $servername = "localhost";
    $username = "yzchen14";
    $password = "ntutalons829";
    $dbname = "mytest";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
//header('Content-Type: application/json; charset=UTF-8'); //設定資料類型為 json，編碼 utf-8
if ($_SERVER['REQUEST_METHOD'] == "POST") { //如果是 POST 請求
    @$idx = $_POST["idx"]; 
    @$name = $_POST["name"]; 
    @$age = $_POST["age"];
    if ($idx != null && $name != null && $age != null) { //如果 nickname 和 gender 都有填寫
        //回傳 nickname 和 gender json 資料
        $conn = new mysqli($servername, $username, $password, $dbname);
        echo ($name);
        $sql = "UPDATE `animals` SET `name`='$name', age='$age' WHERE `id` = $idx";
        $conn->query($sql);

} 
}
?>