<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Ejercicio 5</title>
</head>
<body style="background-color: lightblue">
    <?php
        $edad = $_POST["edad"];
        $sexo = $_POST["sexo"];
        /*if($edad >= 18 && $edad <= 35 && $sexo == "mujer"){
            echo 'Bienvenida, usted está en el rango de edad permitido :D';
        }else{
            echo '<b>'.'ERROR'.'</b>'.'<br>'.'Su edad está fuera del rango permitido';
        }*/
        //echo 'Tienes  ' . htmlspecialchars($_POST["edad"]) . '!';
        echo '<center>';
        if($edad >= 18 && $edad <= 35){
            if($sexo == "mujer"){
                echo '<h2><em>Bienvenida</em>, usted está en el rango de edad permitido :D</h2>';
            }else{
                echo '<h2><em>Bienvenido</em>, usted está en el rango de edad permitido :D</h2>';
            }
        }else{
            echo '<h1>ERROR</h1>'.'<br>'.'<h2>Su edad está fuera del rango permitido :(</h2>';
        }
        echo '</center>';
    ?>
</body>
</html>