<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PortalGame</title>
    <link rel="stylesheet" href="../estilos.css">
    <link rel="shortcut icon" href="../favicon.ico" />
    <script>
        function confirmarModificar() {
            var confirmacion = confirm("¿Son correctos los nuevos datos?");
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
        $mail = $_GET['mail'];
        include "../conexion.php";
        $result = $tabla->clientes->findOne(['mail' => $mail]);
?>
<h1>Registrar Clientes</h1>
    <form action="../nivel2/actualiza_cliente.php" method="POST">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required value="<?php echo $result['name']; ?>"><br><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required value="<?php echo $result['password']; ?>"><br>
        <label for="level">Nivel:</label>
        <select id="level" name="level">
            <option value="administrator">Administrador</option>
            <option value="user" selected>Estándar</option>
        </select><br><br>
        <input type="hidden" id="mail" name="mail" value="<?php echo $result['mail']; ?>">
        <button type="submit" onclick="confirmarModificar()">Registrar</button>
    </form>
<?php include "../footer.php"; ?>