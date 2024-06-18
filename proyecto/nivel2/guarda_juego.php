<?php
    include '../conexion.php';
    $name = $_POST['name'];
    $developer = $_POST['developer'];
    $imagen = $_POST['imagen'];

    $collection = $tabla->juegos;

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
            $url = "https://portal-game.duckdns.org/registro/registra_juegos.php";
        
            echo "<script type='text/javascript'>
                      alert('$message');
                      window.location.href = '$url';
                 </script>";
            $errores=1;
        }

        if($nombre_imagen==''){
            $collection->insertOne(['name' => $name, 'developer' => $developer]);
        }
        

        else {
            $nombreCompleto=$directorioSubida.$nombre_imagen;
            move_uploaded_file($directorio_tmp_imagen,$nombreCompleto);
            $collection->updateOne(['name' => $name, 'developer' => $developer, 'image' => $nombre_imagen]);
        }}
    header('Location: ../actualizar/modifica_juegos.php');
?>