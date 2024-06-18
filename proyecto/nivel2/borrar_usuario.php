<?php
    include '../conexion.php';
    $name = $_GET['name'];

    $collection = $tabla->usuarios;
    $collection->DeleteOne(['name' => $name]);
    header('Location: ../actualizar/modifica_usuarios.php');
?>
