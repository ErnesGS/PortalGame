<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PortalGame</title>
    <link rel="stylesheet" href="../estilos.css">
</head>
<body>
<h1>biblioteca</h1>
<div id="biblioteca">
    <?php
        include "../conexion.php";
        $result = $tabla->juegos->find([]);
    ?>
    <ul>
    <?php
    foreach ($result as $results) {
    ?>
        <li>
            <img src="<?php echo '../insertados/'.$result['image']; ?>" width="150" alt="../insertados/error.png" >
            <div class="overlay">
            <a href="../nivel1/busca_conexion.php?juego=<?php echo $results['name']; ?>">Seleccionar</a>
            </div>
            <p>Desarrollado por: <?php echo $results['developer']; ?></p>
        </li>
    <?php
    }
    ?>
    </ul>
    </div>
</body>
</html>
