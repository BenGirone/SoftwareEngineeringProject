<?php
    $derpVar = "0.89_100_0.85_100_-1_100_-1_100_0.90_";

    chdir("../C");
    exec("algorithm.exe $derpVar", $out);
    echo $out[0];
    chdir("../test");
?>