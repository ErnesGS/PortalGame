<?php include "../header.php"; ?>
    <h1>Registrar Clientes</h1>
    <form action="../nivel2/guarda_juego.php" method="POST">
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required>
        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen" id="imagen" accept="image/*" ><br>
        <label for="developer">Desarrollador:</label>
        <input type="text" id="developer" name="developer" required><br><br>
        <button type="submit">Registrar</button>
    </form>
<?php include "../footer.php"; ?>
