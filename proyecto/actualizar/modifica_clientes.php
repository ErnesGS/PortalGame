<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PortalGame</title>
    <link rel="stylesheet" href="../estilos.css">
    <link rel="shortcut icon" href="../favicon.ico" />
    <script>
        function confirmarBorrado(event) {
            var confirmacion = confirm("¿Estás seguro de que deseas borrar este usuario?");
            if (!confirmacion) {
                event.preventDefault();
            }
        } 
    </script>
</head>
<body>
    <header>
        <div id="menu">
            <ul>
                <li><a href="../nivel1/administradores.php">Inicio</a></li>
                <li><a>Registro</a>
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
                <li><a>Jugar</a>
                    <ul>
                        <li><a href="../biblioteca/selecciona_juego.php">biblioteca</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>
    <main>
    <?php
        include "../conexion.php";
        $result = $tabla->clientes->find();
    ?>
<table id="resultados">
        <thead>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Nivel</th>
            <th>Eliminar</th>
            <th>Modificar</th>
        </thead>

            <tbody>
            <?php
            foreach ($result as $results) {
            ?>
            <tr>
                <td><?php echo $results['name']; ?></td>
                <td><?php echo $results['mail']; ?></td>
                <td><?php echo $results['level']; ?></td>
                <td><form action="../nivel2/borrar_usuario.php" method="GET" onsubmit="confirmarBorrado(event)">
                <input type="hidden" id="mail" name="mail" value="<?php echo $results['mail']; ?>">
                <button type="submit">Borrar</button>
                </form>
                </td>
                <td><form action="../nivel2/modificar_cliente.php" method="GET">
                <input type="hidden" id="mail" name="mail" value="<?php echo $results['mail']; ?>">
                <button type="submit">Modificar</button>
                </form>
                </td>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
<?php include "../footer.php"; ?>