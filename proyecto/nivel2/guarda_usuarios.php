<?php
    include '../conexion.php';
    $name = $_POST['name'];
    $password = $_POST['password'];
    $game = $_POST['game'];

    $collection = $tabla->usuarios;
    $collection->insertOne(['name' => $name, 'password' => $password, 'game' => $game, 'state' => 'disconnect']);
    header('Location: ../actualizar/modifica_juegos.php');
?>
