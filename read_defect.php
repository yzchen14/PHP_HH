<!DOCTYPE html>



<html>


<head>
<link rel="stylesheet" type="text/css" href="mystyle2.css?version=51">
<script src="inc/jquery.min.js"></script>



</head>
<body>


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- The Close Button -->
  <span class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">
  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>

<?php

    $servername = "localhost";
    $username = "yzchen14";
    $password = "tsmcdefect";
    $dbname = "mytest";


    // Create connection
    $now = new DateTime();

    echo '<form method="post">';
    echo 'Week: <input type="number" name="Weeks" min="1" max="53" value='.$now->format('W').'>';
    echo '<pre class="tab"></pre>';
    echo '<input type="submit" name="test" id="test" value="Query" /><br/>';
    echo '</form>';
    //refresh($now->format('W'));

    
    function refresh($weeks)
    {
        $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
        
        $sql ="select * from `defect_data` WHERE Week=".$weeks." ORDER BY ID DESC";
        $result = mysqli_query($conn, $sql);
        #echo "Connected successfully <br>";
        //echo "<center>";
        echo "<table class=customers id=myTable>";
        echo "<th>id</th><th>Date</th><th>MASK</th><th>Tool</th><th>OM</th>";
        echo '<tbody>';
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['ID'] . "</td>";
            echo "<td>". '<label id=date_'.$row['ID'].'>'.$row['Date'].'</label>'. "</td>";
            echo "<td>". '<label id=mask_'.$row['ID'].'>'.$row['Mask'].'</label>'. "</td>";
            echo "<td>". '<label id=tool_'.$row['ID'].'>'.$row['Tool'].'</label>'. "</td>";
            echo "<td>" .'<img class="image" id=OM_'.$row['ID'].' onclick="MyFunction(this)" src='.$row['OM'] ." width=80 height=50></td>";       
            //echo "<td>" . '<button onclick="myFunction('.$row['id'].')">Click me</button>' . "</td>";
            echo "</tr>";
    
        }
        echo '</tbody>';
    
        echo "</table>";
        //echo "</center>";
    
    
        $conn->close();
    }
    
    if(array_key_exists('test',$_POST)){
       refresh($_POST['Weeks']);
    }
    
    
?>


<script type="text/javascript">

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

}


</script>
</body>
</html>
