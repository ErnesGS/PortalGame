<?php
    include '../conexion.php';
    $juego = $_GET['juego'];

    $collection = $tabla->usuarios;
    $usuario = $collection->findOne(['state' => 'disconnect', 'game' => $juego]);
    $nombre = $usuario['name'];
    $password = $usuario['password'];

    if ($usuario) {
        header("Location: pantalla_carga.php?url=https://portal-open.duckdns.org/myrtille/?__EVENTTARGET=&__EVENTARGUMENT=&server=172.31.56.243&user=$nombre&password=$password&width=1530&height=690&connect=Connect%21");
    } else {
        $message = "Esperando a que un usuario quede libre.";
        $url = "https://portal-game.duckdns.org/biblioteca/selecciona_juego.php";

        echo "<script type='text/javascript'>
                  alert('$message');
                  window.location.href = '$url';
             </script>";
    }
?>
