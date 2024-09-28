<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 4</title>
</head>
<body>
    <h1>Practica 4: Manejo de variables con PHP</h1>
    <p>
    <a href="https://validator.w3.org/markup/check?uri=referer"><img
      src="https://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a>
    </p>
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
        
        echo '<h4>Solución:</h4>';   
    
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
    <p>Proporcionar los valores de $a, $b, $c como sigue:<br />
    $a = "ManejadorSQL";<br />
    $b = 'MySQL';<br />
    $c = &amp;$a;<br /><br />
    <b>a.</b> Ahora muestra el contenido de cada variable<br />
    <b>b.</b> Agrega al código actual las siguientes asignaciones:<br /><br />
    $a = "PHP server";<br />
    $b = &amp;$a;<br /><br />
    <b>c.</b> Vuelve a mostrar el contenido de cada uno<br /></p>
    <p><b>Solución:<br /></b></p>
    <?php
    $a = "ManejadorSQL";
    $b = 'MySQL';
    $c = &$a;
    echo '<p>Inciso a.'."<br />";
    echo '$a: '.$a."<br />";
    echo '$b: '.$b."<br />";
    echo '$c: '.$c."<br /><br />";
    $a = "PHP server";
    $b = &$a;
    echo 'Inciso b.'."<br />";
    echo '$a: '.$a."<br />";
    echo '$b: '.$b."<br />";
    echo '$c: '.$c."<br /></p>";

    unset($a,$b,$c);
    ?>
    <p>Lo que ocurrió en la primera impresión fue el cambio de valor de la variable $a = "PHP server" 
        y la variable $b = &amp;$a, es decir, hace referencia a la variable $a (su valor). Entonces, al 
    imprimir todas las variables, se imprime el mismo resultado "PHP server", esto porque tanto $b 
    como $c hacen referencia a $a, por lo que el valor de ambos cambia cuando el de $a lo hace.</p>

    <h2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación,
    verificar la evolución del tipo de estas variables (imprime todos los componentes de los
    arreglo):<br />
    $a = "PHP5";<br />
    $z[] = &amp;$a;<br />
    $b = "5a version de PHP";<br />
    $c = $b*10;<br />
    $a .= $b;<br />
    $b *= $c;<br />
    $z[0] = "MySQL";<br /><br /></p>
    <p><b>Solución:<br /></b></p>
    <?php
        $a = "PHP5";
        echo '<p>$a: '.$a."<br />";
        $z[] = &$a;
        print_r ($z);
        echo "<br />";
        $b = "5a version de PHP";
        echo '$b: '.$b."<br />";
        @$c = $b*10;
        echo '$c: '.$c."<br />";
        $a .= $b;
        echo '$a: '.$a."<br />";
        $b = (int) $b * $c;
        echo '$b: '.$b."<br />";
        $z[0] = "MySQL";
        print_r ($z);
        echo "</p>";
    ?>

    <h2>Ejercicio 4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de
    la matriz $GLOBALS o del modificador global de PHP.</p>
    <p><b>Solución:<br /></b></p>
    <?php
        echo "<p>";
        echo '$a en el ámbito global: '.$GLOBALS['a']."<br />";       
        echo '$b en el ámbito global: '.$GLOBALS['b']."<br />";       
        echo '$c en el ámbito global: '.$GLOBALS['c']."<br />";
        echo '$z en el ámbito global: ';print_r ($GLOBALS['z']);
        echo "<br /></p>";
        
        unset($a,$b,$z,$c);
    ?>

    <h2>Ejercicio 5</h2>
    <p>Dar el valor de las variables $a, $b, $c al final del siguiente script:<br />
    $a = "7 personas";<br />
    $b = (integer) $a;<br />
    $a = "9E3";<br />
    $c = (double) $a;<br /></p>
    <p><b>Solución:<br /></b></p>
    <?php 
        $a = "7 personas";
        $b = (integer) $a;
        $a = "9E3";
        $c = (double) $a;
        echo "<p>";
        echo '$a: '.$a."<br />";
        echo '$b: '.$b."<br />";
        echo '$c: '.$c."<br /></p>";
    ?>

    <h2>Ejercicio 6</h2>
    <p>Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas
    usando la función var_dump().<br />
    Después investiga una función de PHP que permita transformar el valor booleano de $c y $e
    en uno que se pueda mostrar con un echo:<br />
    $a = "0";<br />
    $b = "TRUE";<br />
    $c = FALSE;<br />
    $d = ($a OR $b);<br />
    $e = ($a AND $c);<br />
    $f = ($a XOR $b);<br /></p>
    <p><b>Solución:<br /></b></p>
    <?php 
        $a = "0";
        $b = "TRUE";
        $c = FALSE;
        $d = ($a OR $b);
        $e = ($a AND $c);
        $f = ($a XOR $b);
        echo "<p>";
        echo '$a: ';
        var_dump($a);
        echo "<br />";
        echo '$b: ';
        var_dump($b);
        echo "<br />";
        echo '$c: ';
        var_dump($c);
        echo "<br />";
        echo '$d: ';
        var_dump($d);
        echo "<br />";
        echo '$e: ';
        var_dump($e);
        echo "<br />";
        echo '$f: ';
        var_dump($f);
        echo "<br />";
        echo 'Valores transformados a enteros usando la función intval() para $c y $e'."<br />";
        echo '$c : '.intval($c)."<br />";
        echo '$e : '.intval($e)."<br /></p>";

        unset($a,$b,$c,$d,$e,$f);
    ?>

    <h2>Ejercicio 7</h2>
    <p>Usando la variable predefinida $_SERVER, determina lo siguiente:<br />
    a. La versión de Apache y PHP,<br />
    b. El nombre del sistema operativo (servidor),<br />
    c. El idioma del navegador (cliente).<br /></p>
    <p><b>Solución:<br /></b></p>
    <?php 
        echo "<p>";
        echo 'Versión de APACHE y PHP: '.$_SERVER['SERVER_SOFTWARE']."<br />";
        echo 'Nombre del sistema operativo (servidor): '. PHP_OS."<br />";
        echo 'Idioma del navegador (cliente): '.$_SERVER['HTTP_ACCEPT_LANGUAGE']."<br /></p>";
    ?>
</body>
</html>