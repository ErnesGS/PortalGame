<?php include "../header.php"; ?>
    <h1>Registrar Clientes</h1>
    <form action="../nivel2/guarda_admin.php" method="POST">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <label for="mail">Correo electronico:</label>
        <input type="email" id="mail" name="mail" required>
        <label for="level">Nivel:</label>
        <select id="level" name="level">
            <option value="administrator">Administrador</option>
            <option value="user">Estándar</option>
        </select><br><br>
        <button type="submit">Registrar</button>
    </form>
<?php include "../footer.php"; ?>