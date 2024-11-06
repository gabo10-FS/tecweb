<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 2</title>
</head>
<body>
    <?php
    require_once __DIR__ . '\Menu.php';
    $menu = new Menu;
    $menu->cargar_opcion('http://www.facebook.com', 'Facebook');
    $menu->cargar_opcion('http://www.youtube.com', 'Youtube');
    $menu->cargar_opcion('http://www.instagram.com', 'Instagram');
    $menu->cargar_opcion('http://www.x.com', 'X');
    $menu->mostrar();
    ?>
</body>
</html>