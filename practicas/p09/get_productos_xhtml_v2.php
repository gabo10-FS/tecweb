<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
	<?php
	if(isset($_GET['tope']))
    {
		$tope = $_GET['tope'];
    }
    else
    {
        die('Parámetro "tope" no detectado...');
    }

	if (!empty($tope))
	{
		/** SE CREA EL OBJETO DE CONEXION */
		@$link = new mysqli('localhost', 'root', 'gaboas', 'marketzone');	

		/** comprobar la conexión */
		if ($link->connect_errno) 
		{
			die('Falló la conexión: '.$link->connect_error.'<br/>');
			    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
		}

		/** Crear una tabla que no devuelve un conjunto de resultados */
		if ($result = $link->query("SELECT * FROM productos WHERE unidades <= $tope") ) 
		{
			$row = $result->fetch_all(MYSQLI_ASSOC);

			/** útil para liberar memoria asociada a un resultado con demasiada información */
			$result->free();
		}

		$link->close();
	}
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
                var img = data[6].getAttribute('data-img');;

                send2form(name, marca, modelo, desc, precio, unid, img);
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
					<?php
                            foreach($row as $num => $registro) {   
                                echo '<tr id="'.$registro['id'].'">';    
                                echo '<th scope="row">'.$registro['id'].'</th>';
                                echo '<td class="row-data">'.$registro['nombre'].'</td>';
                                echo '<td class="row-data">'.$registro['marca'].'</td>';
                                echo '<td class="row-data">'.$registro['modelo'].'</td>';
                                echo '<td class="row-data">'.$registro['precio'].'</td>';
                                echo '<td class="row-data">'.$registro['unidades'].'</td>';
                                echo '<td class="row-data">'.$registro['detalles'].'</td>';
                                echo '<td class="row-data" data-img="'.$registro['imagen'].'"><img src='.$registro['imagen'].'></td>';							
								echo '<td><input type="button" value="Editar" onclick="getData()" /></td>';
                                echo '</tr>';
                            }
                        ?>	
				</tbody>
			</table>

		<?php elseif(!empty($id)) : ?>

			 <script>
                alert('El ID del producto no existe');
             </script>

		<?php endif; ?>
		<script>
            function send2form(name, marca, modelo, desc, precio, unid, img) {
                var form = document.createElement("form");

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