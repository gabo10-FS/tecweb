<?php
    $id = isset($_POST["id"]) ? $_POST["id"] : null;
    $nombre = isset($_POST["nombre"])? $_POST["nombre"] : 'nombre_producto';
    $marca = isset($_POST["marca"])? $_POST["marca"] : 'marca_producto';
    $modelo = isset($_POST["modelo"])? $_POST["modelo"] : 'modelo_producto';
    $detalles = isset($_POST["descripcion"])? $_POST["descripcion"] : 'detalles_producto';
    $precio = isset($_POST["precio"])? $_POST["precio"] : 1.0;
    $unidades = isset($_POST["unidad"])? $_POST["unidad"] : 1;
    $imagen = isset($_POST["img"])? $_POST["img"] : 'img/imagen.png';
    /* MySQL Conexion*/
    $link = mysqli_connect("localhost", "root", "gaboas", "marketzone");
    // Chequea coneccion
    if($link === false){
    die("ERROR: No pudo conectarse con la DB. " . mysqli_connect_error());
    }
    // Ejecuta la actualizacion del registro
    $sql = "UPDATE productos SET nombre = '$nombre', marca = '$marca', modelo = '$modelo', detalles = '$detalles', precio = '$precio', unidades = '$unidades', imagen = '$imagen'  WHERE id='$id'";
    if(mysqli_query($link, $sql)){
    echo "<h1>Registro actualizado.</h1>";
    } else {
    echo "ERROR: No se ejecuto $sql. " . mysqli_error($link);
    }
    echo '<h2>Ver productos</h2>
            <ul>
                <li><a href="http://penguin.linux.test/tecweb/practicas/p09/get_productos_xhtml_v2.php" target="_blank">Ver productos por tope</a></li>
                <li><a href="http://penguin.linux.test/tecweb/practicas/p09/get_productos_vigentes_v2.php" target="_blank">Ver productos vigentes</a></li>
            </ul>';
    // Cierra la conexion
    mysqli_close($link);
?>