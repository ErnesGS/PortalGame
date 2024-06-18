<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>registro</title>
</head>
<body>
    <h1>Registrar Clientes</h1>
    <form action="../nivel2/guarda_cliente.php" method="POST">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <label for="mail">Correo electronico:</label>
        <input type="email" id="mail" name="mail" required><br><br>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>
