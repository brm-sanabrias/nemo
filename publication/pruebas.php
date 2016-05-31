<?php
    require 'db/requires.php';
    $obj=MongoNemo::instantiate();
    printVar($obj);
    $var = $obj-> getWordsTw();
    printVar($var);
    
?>