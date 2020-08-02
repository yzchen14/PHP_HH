<!DOCTYPE html>
<html>
<body>

<head>
<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<?php
function showInfo($ID){
echo "ID is :". $ID ."<br>";


}
$myfile = fopen("test.txt", "r") or die("Unable to open file!");

while (($line = fgets($myfile)) !== false) {
    // process the line read.
    echo $line ."<br>";
}
fclose($myfile);


$myfile = fopen("newfile.csv", "w") or die("Unable to open file!");
$txt = "John Doe\n";
fwrite($myfile, $txt);
$txt = "Jane Doe\n";
fwrite($myfile, $txt);
fclose($myfile);

// this is a comment
?>



</body>
</html>