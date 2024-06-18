<?php
    include '../conexion.php';
    $name = $_POST['name'];
    $password = $_POST['password'];
    $mail = $_POST['mail'];
    $level = $_POST['level'];
    $collection = $tabla->clientes;
    $collection->insertOne(['name' => $name, 'password' => $password, 'mail' => $mail, 'level' => $level]);
    header('Location: ../actualizar/modifica_usuarios.php');
?>
