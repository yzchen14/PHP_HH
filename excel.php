<?php
    header("Content-type: text/x-csv");
    header("Content-Disposition: attachment; filename=output.csv");
    echo $_GET["data"];
?>