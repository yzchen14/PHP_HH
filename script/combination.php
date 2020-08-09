<!DOCTYPE html>
<html>
<body>

<head>
<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>

<?php
    $combfile = fopen( 'combination.csv', "w" );


    $total_File = 0;
    $files = glob("./test/*.csv");
    foreach($files as $filepath) {
        echo $filepath. "<br>";
        if ($handle = fopen($filepath, "r")) {
            while (($line = fgets($handle)) !== false) {
                // process the line read.
                //echo $line ."<br>";
                fwrite( $combfile, $line);
            }
            $total_File ++;
            fclose($handle);
        }
        

    }
    fclose($combfile);

    echo "Successfully combined ". $total_File . " files <br>";




?>



</body>
</html>