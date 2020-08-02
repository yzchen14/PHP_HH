<!DOCTYPE html>
<html>
<body>

<head>
<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<?php

$xml = new SimpleXMLElement("000.xml",null,True);

foreach ($xml->Scan as $element) {
    foreach($element as $key => $val) {
        if ($key=="Move"){
            echo "{$key}: {$val}". "<br>";
            foreach($val as $tool =>$number){
                echo "    "."{$tool}: {$number}". "<br>";
            }
            
        }
        else{
            echo "{$key}: {$val}". "<br>";
            echo "Test" . "<br>";
            echo "Hello" . "<br>";

        }
    }
  }


?>



</body>
</html>