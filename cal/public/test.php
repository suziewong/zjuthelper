<?php
    include_once '../sys/core/init.inc.php';
    $obj = new Admin($dbo);

    $pass =$obj->testSaltedHash("admin");
    echo "admin<br/>".$pass;
?>
