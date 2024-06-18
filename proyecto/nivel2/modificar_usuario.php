<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PortalGame</title>
    <link rel="stylesheet" href="../estilos.css">
    <link rel="shortcut icon" href="../favicon.ico" />
    <script>
        function confirmarModificar() {
            var confirmacion = confirm("¿Los datos nuevos son correctos?");
        } else {
            return false;
        }
    </script>
</head>
<body>
    <header>
        <div id="menu">
            <ul>
                <li><a href="../nivel1/administradores.php">Inicio</a></li>
                <li><a>registro</a>
                    <ul>
                        <li><a href="../registro/registra_admin.php">Clientes</a></li>
                        <li><a href="../registro/registra_usuarios.php">Usuarios (AD)</a></li>
                        <li><a href="../registro/registra_juegos.php">Juegos</a></li>
                    </ul>
                </li>
                <li><a>Consultar</a>
                    <ul>
                        <li><a href="../actualizar/modifica_clientes.php">Clientes</a></li>
                        <li><a href="../actualizar/modifica_usuarios.php">Usuarios (AD)</a></li>
                        <li><a href="../actualizar/modifica_juegos.php">Juegos</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>
    <main>
<?php
        $name = $_GET['name'];
        include "../conexion.php";
        $result = $tabla->usuarios->findOne(['name' => $name]);
?>
<h1>Registrar Clientes</h1>
    <form action="../nivel2/actualiza_usuario.php" method="POST">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required value="<?php echo $result['name']; ?>"><br><br>
        <label for="game">Juego:</label>
        <input type="text" id="game" name="game" required value="<?php echo $result['game']; ?>"><br><b>
        <input type="hidden" id="id" name="id" value="<?php echo $result['name']; ?>">
        <button type="submit" onclick="confirmarModificar()">Registrar</button>
    </form>
<?php include "../footer.php"; ?>