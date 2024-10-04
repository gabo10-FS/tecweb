<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Registro</title>
		<style type="text/css">
			body {margin: 20px; 
			background-color: #6fa8dc;
			font-family: Verdana, Helvetica, sans-serif;
			font-size: 90%;}
			h1 {color: #005825;
			border-bottom: 1px solid #005825;}
			h2 {font-size: 1.2em;
			color: #4A0048;}
		</style>
	</head>
	<body>
        <?php 
            $nombre = isset($_POST["nombre"])? $_POST["nombre"] : 'nombre_producto';
            $marca = isset($_POST["marca"])? $_POST["marca"] : 'marca_producto';
            $modelo = isset($_POST["modelo"])? $_POST["modelo"] : 'modelo_producto';
            $detalles = isset($_POST["descripcion"])? $_POST["descripcion"] : 'detalles_producto';
            $precio = isset($_POST["precio"])? $_POST["precio"] : 1.0;
            $unidades = isset($_POST["unidad"])? $_POST["unidad"] : 1;
            $imagen = isset($_POST["img"])? $_POST["img"] : 'img/imagen.png';
            /** SE CREA EL OBJETO DE CONEXION */
            @$link = new mysqli('localhost', 'root', 'gaboas', 'marketzone');	
            /** comprobar la conexión */
            if ($link->connect_errno) 
            {
                die('Falló la conexión: '.$link->connect_error.'<br/>');
                /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
            }

            $sql = "SELECT * FROM productos WHERE nombre = '$nombre' AND marca = '$marca' AND modelo = '$modelo'";
            $result = $link->query($sql);

            if ($result->num_rows > 0) {
                echo '<p><h1>El producto:</h1>';
                echo '<strong>Nombre:</strong> '.$nombre.'<br>';
                echo '<strong>Marca:</strong> '.$marca.'<br>';
                echo '<strong>Modelo:</strong> '.$modelo.'<br>';
                echo '<h2>Ya existe en la base de datos.</h2><br></p>';
            } else {
                /** Crear una tabla que no devuelve un conjunto de resultados */
                //$sql = "INSERT INTO productos VALUES (NULL, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";
                $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";

                if ($link->query($sql)) {
                    // Mostrar resumen de datos insertados
                    echo '<h1>Producto Registrado</h1>';
		            echo '<h2>Producto:</h2>';
                    echo '<p>ID: '.$link->insert_id.'<br/><p>';
                    echo '<h3>Resumen de los datos insertados:</h3>';
                    echo '<p><strong>Nombre:</strong> '.$nombre.'</p>';
                    echo '<p><strong>Marca:</strong> '.$marca.'</p>';
                    echo '<p><strong>Modelo:</strong> '.$modelo.'</p>';
                    echo '<p><strong>Precio:</strong> '.$precio.'</p>';
                    echo '<p><strong>Detalles:</strong> '.$detalles.'</p>';
                    echo '<p><strong>Unidades:</strong> '.$unidades.'</p>';
                    echo '<p><strong>Imagen:</strong> <img src="'.$imagen.'" alt="Imagen del producto" /></p>';
                } else {
                    echo '<p>El Producto no pudo ser insertado =(</p>';
                }
            }

            $link->close();
        ?>
	</body>
</html>