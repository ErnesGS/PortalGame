<?php
    include '../conexion.php';
    $mail = $_GET['mail'];

    $collection = $tabla->clientes;
    $collection->DeleteOne(['mail' => $mail]);
    header('Location: ../actualizar/modifica_clientes.php');
?>
