<?php
    include_once __DIR__.'/database.php';
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_POST['id']) ) {
        $id = $_POST['id'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql = "SELECT * FROM productos WHERE id = {$id}";
        $result = mysqli_query($conexion, $sql);
        if ( $conexion->query($sql) ) {
            $json = array();
            while($row = mysqli_fetch_array($result)){
                $json[] = array(
                    'id' => $row['id'],
                    'nombre' => $row['nombre'],
                    'precio' => $row['precio'],
                    'unidades' => $row['unidades'],
                    'modelo' => $row['modelo'],
                    'marca' => $row['marca'],
                    'detalles' => $row['detalles'],
                    'imagen' => $row['imagen']
                );
            }
		} else {
            die('Query fallida');
        }
		$conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($json[0], JSON_PRETTY_PRINT);
?>