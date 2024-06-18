<?php
    include '../conexion.php';
    $name = $_POST['name'];
    $password = $_POST['password'];
    $mail = $_POST['mail'];

    $collection = $tabla->clientes;
    $collection->insertOne(['name' => $name, 'password' => $password, 'mail' => $mail, 'level' => 'user']);
    header('Location: ../index.php');
?>

