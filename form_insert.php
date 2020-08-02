<!DOCTYPE html>


<?php

    $connect = new PDO("mysql:host=localhost;dbname=mytest",
     "yzchen14",
      "ntutalons829");


    $query = "SELECT * FROM haman ORDER BY idx DESC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

?>




<html>


<head>
<title>How to Use Ajax PHP to Append Last Inserted Data to HTML Tables | Using AJAX to append database rows to HTML tables</title>
  <link rel="stylesheet" href="inc/bootstrap.min.css" />
  <script src="inc/jquery.min.js"></script>
  <script src="inc/bootstrap.min.js"></script>  
</head>
<body>
<div class="container">
   <br />
   <br />
   <h2 align="center">How to Use Ajax PHP to Append Last Inserted Data to HTML Tables</h2><br />
   <h3 align="center">Add Details</h3>
   <br />
   <form method="post" id="add_details">
    <div class="form-group">
     <label>First Name</label>
     <input type="text" name="first_name" class="form-control" required />
    </div>
    <div class="form-group">
     <label>Last Name</label>
     <input type="text" name="last_name" class="form-control" required />
    </div>
    <div class="form-group">
     <input type="submit" name="add" id="add" class="btn btn-success" value="Add" />
    </div>
   </form>
   <br />
   <h3 align="center">View Details</h3>
   <br />
   <table class="table table-striped table-bordered">
    <thead>
     <tr>
      <th>First Name</th>
      <th>Last Name</th>
     </tr>
    </thead>
    <tbody id="table_data">
    <?php
    foreach($result as $row)
    {
     echo '
     <tr>
      <td>'.$row["First_name"].'</td>
      <td>'.$row["Last_name"].'</td>
     </tr>
     ';
    }
    ?>
    </tbody>
   </table>
  </div>

</body>
</html>


<script>
$(document).ready(function(){
 
 $('#add_details').on('submit', function(event){
  event.preventDefault();
  $.ajax({
   url:"insert.php",
   method:"POST",
   data:$(this).serialize(),
   dataType:"json",
   beforeSend:function(){
    $('#add').attr('disabled', 'disabled');
   },
   success:function(data){
    $('#add').attr('disabled', false);
    if(data.first_name)
    {
     var html = '<tr>';
     html += '<td>'+data.first_name+'</td>';
     html += '<td>'+data.last_name+'</td></tr>';
     $('#table_data').prepend(html);
     $('#add_details')[0].reset();
    }
   }
  })
 });
 
});
</script>