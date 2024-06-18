<?php
    include '../conexion.php';
    $mail = $_POST['mail'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $collection = $tabla->clientes;
    $collection->updateOne(['mail' => $mail],['$set' => ['name' => $name, 'password' => $password, 'level' => $level]]);
    header('Location: ../actualizar/modifica_clientes.php');
?>
