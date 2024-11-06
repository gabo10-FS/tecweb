<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 3</title>
</head>
<body>
    <?php
    /*
    use EJEMPLOS\POP\Cabecera as Cabecera;
    require_once __DIR__.'/cabecera.php';
    $cab= new Cabecera('El rincon del programador', 'center');
    $cab->graficar();
    */
    use EJEMPLOS\POP\Cabecera2 as Cabecera;
    require_once __DIR__.'/cabecera.php';
    $cab= new Cabecera('El rincon del programador', 'center', 'http://www.cs.buap.mx/');
    $cab->graficar();
    ?>
</body>
</html>