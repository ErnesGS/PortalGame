<?php include "../header.php"; ?>
    <h1>Registrar Clientes</h1>
    <form action="../nivel2/guarda_usuarios.php" method="POST">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <label for="game">Juego:</label>
        <input type="text" id="game" name="game" required><br><br>
        <button type="submit">Registrar</button>
    </form>
<?php include "../footer.php"; ?>
