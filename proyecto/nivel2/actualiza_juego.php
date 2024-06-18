<?php
    include '../conexion.php';
    $developer = $_POST['developer'];
    $name = $_POST['name'];
    $id = $_POST['id'];

    $collection = $tabla->juegos;
    $max_file_size="5120000";

    // Valores de informacion de imagen
    if(isset($_FILES['imagen'])){
        $errores=0;
        $nombre_imagen=$_FILES['imagen']['name'];
        $tamaño_imagen=$_FILES['imagen']['size'];
        $directorio_tmp_imagen='../insertados/';
        $tipo_imagen=$_FILES['imagen']['type'];
        $arrayarchivo=pathinfo($nombre_imagen);
        $extension=$arrayarchivo['extension'];
    
        if($tamaño_imagen>$max_file_size){
            $message = "Tamaño de archivo demasiado grande";
            $url = "https://portal-game.duckdns.org/nivel2/modificar_juego.php";
        
            echo "<script type='text/javascript'>
                      alert('$message');
                      window.location.href = '$url';
                 </script>";
            $errores=1;
        }

        if($nombre_imagen==''){
            $collection->updateOne(['name' => $id],['$set' => ['name' => $name, 'developer' => $developer]]);
        }
        

        else {
            $nombreCompleto=$directorioSubida.$nombre_imagen;
            move_uploaded_file($directorio_tmp_imagen,$nombreCompleto);
            $collection->updateOne(['name' => $id],['$set' => ['name' => $name, 'developer' => $developer, 'image' => $nombre_imagen]]);
        }}
    header('Location: ../actualizar/modifica_juegos.php');
?>
