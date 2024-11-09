<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 9</title>
    <script src="validar_formulario_producto.js" defer></script>
</head>
<body>
    <h1>Actualización de productos en almacén</h1>

    <form id="formularioProductos" action="http://penguin.linux.test/tecweb/practicas/p09/update_producto.php" method="post">
    <input type="hidden" name="id" value="<?= !empty($_POST['id']) ? $_POST['id'] : '' ?>">
    <h2>Producto</h2>
    <fieldset>
        <legend>Información propia del producto</legend>

        <ul>
            <li><label for="form-nombre">Nombre:</label> <input type="text" name="nombre" id="form-nombre" value="<?= !empty($_POST['nombre'])?$_POST['nombre']:'' ?>"></li>
            <p>Marca: 
                <select name="marca" id="form-marca">
                    <option value="0"></option>
                    <option value="APPLE" <?= isset($_POST['marca']) && $_POST['marca'] === 'APPLE' ? 'selected' : '' ?>>APPLE</option>
                    <option value="HUAWEI" <?= isset($_POST['marca']) && $_POST['marca'] === 'HUAWEI' ? 'selected' : '' ?>>HUAWEI</option>
                    <option value="LG" <?= isset($_POST['marca']) && $_POST['marca'] === 'LG' ? 'selected' : '' ?>>LG</option>
                    <option value="MSI" <?= isset($_POST['marca']) && $_POST['marca'] === 'MSI' ? 'selected' : '' ?>>MSI</option>
                    <option value="DELL" <?= isset($_POST['marca']) && $_POST['marca'] === 'DELL' ? 'selected' : '' ?>>DELL</option>
                    <option value="SAMSUNG" <?= isset($_POST['marca']) && $_POST['marca'] === 'SAMSUNG' ? 'selected' : '' ?>>SAMSUNG</option>
                    <option value="LENOVO" <?= isset($_POST['marca']) && $_POST['marca'] === 'LENOVO' ? 'selected' : '' ?>>LENOVO</option>
                    <option value="ASUS" <?= isset($_POST['marca']) && $_POST['marca'] === 'ASUS' ? 'selected' : '' ?>>ASUS</option>
                    <option value="HP" <?= isset($_POST['marca']) && $_POST['marca'] === 'HP' ? 'selected' : '' ?>>HP</option>
                    <option value="ACER" <?= isset($_POST['marca']) && $_POST['marca'] === 'ACER' ? 'selected' : '' ?>>ACER</option>
                    <option value="SONY" <?= isset($_POST['marca']) && $_POST['marca'] === 'SONY' ? 'selected' : '' ?>>SONY</option>
                    <option value="TOSHIBA" <?= isset($_POST['marca']) && $_POST['marca'] === 'TOSHIBA' ? 'selected' : '' ?>>TOSHIBA</option>
                </select>
            </p>
            <li><label for="form-modelo">Modelo:</label> <input type="text" name="modelo" id="form-modelo" value="<?= !empty($_POST['modelo'])?$_POST['modelo']:'' ?>"></li>
            <li><label for="form-descripcion">Descripción</label><br><textarea name="descripcion" rows="4" cols="60" id="form-descripcion" placeholder="No más de 300 caracteres de longitud"><?= !empty($_POST['descripcion'])?$_POST['descripcion']:$_GET['descripcion'] ?></textarea></li>
        </ul>
    </fieldset>

    <h2>Almacén</h2>

    <fieldset>
        <legend>Información del producto en tienda</legend>

        <ul>
            <li><label for="form-precio">Precio:</label> <input type="number" name="precio" id="form-precio" step="0.01" value="<?= !empty($_POST['precio'])?$_POST['precio']:'' ?>"></li>
            <li><label for="form-unidad">Unidades</label> <input type="number" name="unidad" id="form-unidad" value="<?= !empty($_POST['unidad'])?$_POST['unidad']:'' ?>"></li>
            <li><label for="form-img">Ruta de la imagen</label> <input type="text" name="img" id="form-img" value="<?= !empty($_POST['img'])?$_POST['img']:'' ?>"></li>
        </ul>
    </fieldset>

    <p>
        <input type="submit" value="Actualizar">
    </p>

    </form>
</body>
</html>