<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JASON A OBJETO
        $jsonOBJ = json_decode($producto);

        $precio = $jsonOBJ->precio;
        $unidades = $jsonOBJ->unidades;
        $modelo = $jsonOBJ->modelo;
        $detalles = $jsonOBJ->detalles;
        $imagen = $jsonOBJ->imagen;
        $nombre = $jsonOBJ->nombre;
        $marca = $jsonOBJ->marca;
        /**
         * SUSTITUYE LA SIGUIENTE LÍNEA POR EL CÓDIGO QUE REALICE
         * LA INSERCIÓN A LA BASE DE DATOS. COMO RESPUESTA REGRESA
         * UN MENSAJE DE ÉXITO O DE ERROR, SEGÚN SEA EL CASO.
         */
        $sql = "SELECT * FROM productos WHERE nombre = '$nombre' AND eliminado = 0";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                echo "El producto ya está registrado =/\n";
            } else {
                /** Crear una tabla que no devuelve un conjunto de resultados */
                //$sql = "INSERT INTO productos VALUES (NULL, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";
                $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";

                if ($conexion->query($sql)) {
                    echo "El producto se registró correctamente =D\n";
                } else {
                    echo "El producto no pudo ser insertado =(\n";
                }
            }

            $conexion->close();
            echo '[SERVIDOR] Nombre: '.$jsonOBJ->nombre;
    }else {
        echo "No se recibieron datos.";
    }
?>