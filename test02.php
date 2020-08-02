

<form method="post">
    <input type="submit" name="test" id="test" value="Add" /><br/>
</form>

<?php

function add_history(){
    $servername = "localhost";
    $username = "yzchen14";
    $password = "ntutalons829";
    $dbname = "mytest";


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    $mask = 'TMMNP98-7V0A-10';
    $loaded = new DateTime('2020-07-18 10:20:20');
    $unload = new DateTime('2020-07-18 10:58:20');
    $ll = $loaded->format('Y-m-d H:i:s');
    $uu = $unload->format('Y-m-d H:i:s');
    $interval = $unload->getTimestamp() - $loaded->getTimestamp();
    echo $loaded->format('Y-m-d H:i:s');

    $sql = "INSERT INTO bxlog (Reticle_ID, load_time, unload_time, duration)
    VALUES ('$mask',
    '$ll',
    '$uu', 
    $interval/60)";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully ". "<br>";
        ShowInfo($mask);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}

function ShowInfo($maskID){
    echo "Mask ID:" . $maskID . "<br>";
}


if(array_key_exists('test',$_POST)){
    add_history();
 }

?>