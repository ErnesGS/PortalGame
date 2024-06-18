<?php
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
}
    $collection = $tabla->usuarios;

    if ($usuario) {
        $collection->updateOne(
            ['name' => $usuario],
            ['$set' => ['state' => 'connect']]
        );
    }
?>
