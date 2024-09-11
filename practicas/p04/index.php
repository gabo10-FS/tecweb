<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';

        unset($_myvar,$_7var,$myvar,$var7,$_element1);
    ?>

    <h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:<br>
    $a = “ManejadorSQL”;<br>
    $b = 'MySQL’;<br>
    $c = &$a;<br>
    a. Ahora muestra el contenido de cada variable<br>
    b. Agrega al código actual las siguientes asignaciones:<br>
    $a = “PHP server”;<br>
    $b = &$a;<br>
    c. Vuelve a mostrar el contenido de cada uno<br></p>
    <?php
    $a = "ManejadorSQL";
    $b = 'MySQL';
    $c = &$a;
    echo '$a: '.$a;
    echo '$b: '.$b;
    echo '$c: '.$c;
    $a = "PHP server";
    $b = &$a;
    echo '$a: '.$a;
    echo '$b: '.$b;
    echo '$c: '.$c;

    unset($a,$b,$c);
    ?>
    <p>Lo que ocurrió en la primera impresión fue el cambio de valor de la variable $a = "PHP server" 
        y la variable $b = &$a, es decir, hace referencia a la variable $a (su valor). Entonces, al 
    imprimir todas las variables, se imprime el mismo resultado "PHP server", esto porque tanto $b 
    como $c hacen referencia a $a, por lo que el valor de ambos cambia cuando el de $a lo hace.</p>

    <p2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación,
    verificar la evolución del tipo de estas variables (imprime todos los componentes de los
    arreglo):<br>
    $a = “PHP5”;<br>
    $z[] = &$a;<br>
    $b = “5a version de PHP”;<br>
    $c = $b*10;<br>
    $a .= $b;<br>
    $b *= $c;<br>
    $z[0] = “MySQL”;<br></p>
    <?php
        $a = “PHP5”;
        echo '$a: '.$a."<br>";
        $z[] = &$a;
        print_r ($z);
        $b = "5a version de PHP";
        echo '$b: '.$b."<br>";
        @$c = $b*10;
        echo '$c: '.$c."<br>";
        $a .= $b;
        echo '$a: '.$a."<br>";
        $b = (int) $b * $c;
        echo '$b: '.$b."<br>";
        $z[0] = "MySQL";
        print_r ($z);
        unset($a,$b,$z,$c);
    ?>

    <h2>Ejercicio 4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de
    la matriz $GLOBALS o del modificador global de PHP.</p>
    <?php
        $a = “PHP5”;
        echo '$a en el ámbito global: '.$GLOBALS['a']."<br>";
        $z[] = &$a;
        print_r ($GLOBALS['z']);
        $b = "5a version de PHP";
        echo '$b en el ámbito global: '.$GLOBALS['b']."<br>";
        $c = $b*10;
        echo '$c en el ámbito global: '.$GLOBALS['c']."<br>";
        $a .= $b;
        echo '$a en el ámbito global: '.$GLOBALS['a']."<br>";
        $b *= $c;
        echo '$b en el ámbito global: '.$GLOBALS['b']."<br>";
        $z[0] = "MySQL";
        print_r ($GLOBALS['z']);
        unset($a,$b,$z,$c);
    ?>

    

</body>
</html>