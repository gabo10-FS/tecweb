<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<?php
    //header("Content-Type: application/json; charset=utf-8"); 
    
	/** SE CREA EL OBJETO DE CONEXION */
    @$link = new mysqli('localhost', 'root', 'gaboas', 'marketzone');
    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */

    /** comprobar la conexión */
    if ($link->connect_errno) 
    {
        die('Falló la conexión: '.$link->connect_error.'<br/>');
        //exit();
    }

    /** Crear una tabla que no devuelve un conjunto de resultados */
    if ( $result = $link->query("SELECT * FROM productos WHERE eliminado = 0") ) 
    {
        /** Se extraen las tuplas obtenidas de la consulta */
        $row = $result->fetch_all(MYSQLI_ASSOC);

        /** Se crea un arreglo con la estructura deseada */
        foreach($row as $num => $registro) {            // Se recorren tuplas
            foreach($registro as $key => $value) {      // Se recorren campos
                $data[$num][$key] = utf8_encode($value);
            }
        }

        /** útil para liberar memoria asociada a un resultado con demasiada información */
        $result->free();
    }

    $link->close();

    /** Se devuelven los datos en formato JSON */
    //echo json_encode($data, JSON_PRETTY_PRINT);
	?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Producto</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script>
            function getData() {
                // se obtiene el id de la fila donde está el botón presinado
                var rowId = event.target.parentNode.parentNode.id;

                // se obtienen los datos de la fila en forma de arreglo
                var data = document.getElementById(rowId).querySelectorAll(".row-data");
                /**
                querySelectorAll() devuelve una lista de elementos (NodeList) que 
                coinciden con el grupo de selectores CSS indicados.
                (ver: https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Selectors)

                En este caso se obtienen todos los datos de la fila con el id encontrado
                y que pertenecen a la clase "row-data".
                */

                var name = data[0].innerHTML;
				var marca = data[1].innerHTML;
				var modelo = data[2].innerHTML;
                var desc = data[5].innerHTML;
				var precio = data[3].innerHTML;
				var unid = data[4].innerHTML;
                var img = data[6].getAttribute('data-img');

                send2form(name, marca, modelo, desc, precio, unid, img, rowId);
            }
        </script>
	</head>
	<body>
		<h3>PRODUCTO</h3>

		<br/>
		
		<?php if( isset($row) ) : ?>
			<table class="table">
				<thead class="thead-dark">
					<tr>
					<th scope="col">#</th>
					<th scope="col">Nombre</th>
					<th scope="col">Marca</th>
					<th scope="col">Modelo</th>
					<th scope="col">Precio</th>
					<th scope="col">Unidades</th>
					<th scope="col">Detalles</th>
					<th scope="col">Imagen</th>
					<th scope="col">Modificar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($row as $value) : ?>
					<tr id="<?= $value['id'] ?>">
						<th scope="row"><?= $value['id'] ?></th>
						<td class="row-data"><?= $value['nombre'] ?></td>
						<td class="row-data"><?= $value['marca'] ?></td>
						<td class="row-data"><?= $value['modelo'] ?></td>
						<td class="row-data"><?= $value['precio'] ?></td>
						<td class="row-data"><?= $value['unidades'] ?></td>
						<td class="row-data"><?= $value['detalles'] ?></td>
						<td class="row-data" data-img="<?= $value['imagen'] ?>"><img src=<?= $value['imagen'] ?> ></td>
						<td><input type="button" value="Editar" onclick="getData()" /></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php elseif(!empty($id)) : ?>

			 <script>
                alert('El ID del producto no existe');
             </script>

		<?php endif; ?>
		<script>
            function send2form(name, marca, modelo, desc, precio, unid, img, rowId) {
                var form = document.createElement("form");

				var idIn = document.createElement("input");
				idIn.type = 'hidden';
				idIn.name = 'id';
				idIn.value = rowId;
				form.appendChild(idIn);

                var nombreIn = document.createElement("input");
                nombreIn.type = 'text';
                nombreIn.name = 'nombre';
                nombreIn.value = name;
                form.appendChild(nombreIn);

                var marcaIn = document.createElement("select");
                marcaIn.name = 'marca';
                var options = ["APPLE", "HUAWEI", "LG", "MSI", "DELL", "SAMSUNG", "LENOVO", "ASUS", "HP", "ACER", "SONY", "TOSHIBA"];
            	options.forEach(function(option) {
                var opt = document.createElement("option");
                opt.value = option;
                opt.textContent = option;
                if (option === marca) {
                    opt.selected = true; // opción correspondiente
                }
                marcaIn.appendChild(opt);
            });
                form.appendChild(marcaIn);

				var modeloIn = document.createElement("input");
                modeloIn.type = 'text';
                modeloIn.name = 'modelo';
                modeloIn.value = modelo;
                form.appendChild(modeloIn);

                var precioIn = document.createElement("input");
                precioIn.type = 'number';
                precioIn.name = 'precio';
                precioIn.value = precio;
                form.appendChild(precioIn);

				var unidIn = document.createElement("input");
                unidIn.type = 'number';
                unidIn.name = 'unidad';
                unidIn.value = unid;
                form.appendChild(unidIn);

				var descIn = document.createElement("input");
                descIn.type = 'text';
                descIn.name = 'descripcion';
                descIn.value = desc;
                form.appendChild(descIn);

				var imgIn = document.createElement("input");
                imgIn.type = 'text';
                imgIn.name = 'img';
                imgIn.value = img;
                form.appendChild(imgIn);	

                form.method = 'POST';
                form.action = 'http://localhost/tecweb/practicas/p09/formulario_productos_v2.php';  

                document.body.appendChild(form);
                form.submit();
            }
        </script>
	</body>
</html>