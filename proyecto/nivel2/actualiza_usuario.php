<?php
    include '../conexion.php';
    $game = $_POST['game'];
    $name = $_POST['name'];
    $id = $_POST['id'];

    $collection = $tabla->usuarios;
    $collection->updateOne(['name' => $id],['$set' => ['name' => $name, 'game' => $game]]);
    header('Location: ../actualizar/modifica_usuarios.php');
?>
