<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 5</title>
</head>
<body>
    <?php
    require_once __DIR__.'/Pagina.php';
    $pag= new Pagina('El rincon del Programador', 'center', 'El Sotano del programador');
    for($i=0;$i<15;$i++){
        $pag->insertar_cuerpo('Prueba NO. '.($i+1).' que debe aparecer en la pagina');
    }
    $pag->graficar();

    ?>
</body>
</html>