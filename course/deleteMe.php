<?php
    $derpVar = "0.89_100_0.85_100_-1_100_-1_100_0.90_";
    exec("deleteMe.exe $derpVar", $out);
    foreach($out as $line)
    {
        echo ($line . "<br />");
    }
?>