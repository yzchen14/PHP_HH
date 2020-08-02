<!DOCTYPE html>



<html>


<head>

</head>
<body>
<?php
$user =shell_exec("wmic computersystem get username");
echo $user. "<br>";
echo strpos($user, "YZ"). "<br>";
echo substr($user, strpos($user, "\\")+1, -1);
?>
</body>
</html>

