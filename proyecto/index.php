<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <main>
    <h1>Inicio de Sesión</h1>
    <form action="/nivel1/comprueba_usuario.php" method="POST">
        <label for="email">Usuario:</label>
        <input type="text" id="email" name="email" required placeholder='Usuario o Correo'>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Iniciar Sesión</button>
    </form>
    <br>
    <form action="./registro/registra_cliente.php" method="GET">
        <button type="submit">Registrarse</button>
    </form>
</main>
</body>
</html>
