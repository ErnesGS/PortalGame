<?php
    include '../conexion.php';
    $name = $_GET['name'];

    $collection = $tabla->juegos;
    $collection->DeleteOne(['name' => $name]);
    header('Location: ../actualizar/modifica_juegos.php');
?>
