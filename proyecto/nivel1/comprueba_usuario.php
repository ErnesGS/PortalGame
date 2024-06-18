<?php

include '../conexion.php';

$email = $_POST['email'];
$password = $_POST['password'];

$user = $tabla->clientes->findOne(array('$or' => array(array('mail' => $email, 'password' => $password), array('name' => $email, 'password' => $password))));

if ($user) {
    if ($user['level'] == 'administrator') {
        header('Location: administradores.php');
    } else {
        header('Location: ..\biblioteca\selecciona_juego.php');
    }
    exit;
} else {
    $message = "Nombre de usuario o contraseña incorrectos.";
    $url = "https://portal-game.duckdns.org/index.php";

    echo "<script type='text/javascript'>
              alert('$message');
              window.location.href = '$url';
         </script>";
}
?>
