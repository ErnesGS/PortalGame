<?php
    require 'vendor/autoload.php';

    $client = new MongoDB\Client("mongodb://192.168.1.16:27017");
    $tabla = $client->portalgame;
?>
