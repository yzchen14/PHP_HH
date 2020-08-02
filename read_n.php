<!DOCTYPE html>



<html>


<head>
<link rel="stylesheet" type="text/css" href="mystyle2.css?version=51">
<script src="inc/jquery.min.js"></script>

</head>
<body>

<?php

    $servername = "localhost";
    $username = "yzchen14";
    $password = "ntutalons829";
    $dbname = "mytest";


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);


  

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql ="select * from `animals`  ORDER BY ID DESC";
    $result = mysqli_query($conn, $sql);

    #echo "Connected successfully <br>";
    //echo "<center>";
    echo "<table class=customers id=myTable>";
    echo "<th>id</th><th>name</th><th>score</th><th>  </th>";
    echo '<tr>';
    echo '<td> </td>';
    echo '<td><input type="text", value ="" id = new_name></td>';
    echo '<td><input type="text", value ="" id = new_age></td>';
    echo '<td> <input type="submit" onclick="insertData()" value=Insert></td>';
    echo '</tr>';

    echo '<tbody>';

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . '<input type="text", value = '.$row['name'].' id = name_'.$row['id'].'>'. "</td>";
        echo "<td>" . '<input type="text", value = '.$row['age'].' id = age_'.$row['id'].'>'. "</td>";
        echo "<td>" . '<input type="submit" onclick="myFunction('.$row['id'].')" value=Update>' . "</td>";
        
        //echo "<td>" . '<button onclick="myFunction('.$row['id'].')">Click me</button>' . "</td>";
        echo "</tr>";

    }
    echo '</tbody>';

    echo "</table>";
    //echo "</center>";


    $conn->close();

?>
<script type="text/javascript">

function insertData(){
    var name_in = document.getElementById('new_name').value;
    var age_in = document.getElementById('new_age').value;
    $.ajax({
        type: "POST",
        url: "insertData.php",
        data: { 
                        name: name_in,
                        age:age_in
                    },
        success: function(data) {
            console.log(data); // Inspect this in your console
            //$('#myTable').append('<tr><td></tr>');
            history.go(0);
        }
    }
    );
}


function myFunction(id){
        var name_in = document.getElementById('name_'+id).value;
        var age_in = document.getElementById('age_'+id).value;
        $.ajax({
        type: "POST",
        url: "service.php",
        data: { 
                        idx: id,
                        name: name_in,
                        age:age_in
                    },
        success: function(data) {
            console.log(data); // Inspect this in your console
        }
    });

                }
                    

        </script>
</body>
</html>
