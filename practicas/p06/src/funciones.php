<?php
    function multiploDe(){
        if(isset($_GET['numero']))
        {
            $num = $_GET['numero'];
            if ($num%5==0 && $num%7==0)
            {
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else
            {
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
        }
    }    

    function tresNumerosAleatorios(){
        srand (time());
        //$matriz = [];
        $cont = 0;

        while (true) {  
            //array_push($matriz, array ($n1,$n2,$n3));
            $n1 = rand(1,100);
            $n2 = rand(1,100);
            $n3 = rand(1,100);
            $matriz[] = array($n1,$n2,$n3);
            $cont++;
            if(($n1%2 != 0) && ($n2%2 == 0) && ($n3%2 != 0)){
                break;
            }
        }
        //print_r($matriz);
        //echo "<br>";
        /*foreach($matriz as $value){
            print_r($value);
            echo "<br>";
        }*/
        $iter = $cont;
        foreach($matriz as $fila){
            echo '> ';
            foreach($fila as $dato){
                if($iter - 1 > 0){
                    echo $dato.', ';
                }
                else{
                    echo '<b>'.$dato.', '.'</b>';
                }
            }
            echo '<br>';
            $iter--;
        }
        $num = $cont*3;
        echo "$num números obtenidos en $cont iteraciones";
    }

    function primerNumEnteroWhile(){
        srand(time());
        if(isset($_GET['numero']))
        {
            $num = $_GET['numero'];
            $alea = rand(1,1000);
            while($alea%$num != 0){
                //echo $alea.'<br>';
                $alea = rand(1,1000);
            }
            echo '<h3>R= El número '.$alea.' SÍ es múltiplo de '.$num.'</h3>';
        }
    }

    function primerNumEnteroDoWhile(){
        srand(time());
        if(isset($_GET['numero']))
        {
            $num = $_GET['numero'];
            do{
                $alea = rand(1,1000);
            }while($alea%$num != 0);
            echo '<h3>R= El número '.$alea.' SÍ es múltiplo de '.$num.'</h3>';
        }
    }

    function arregloASCII(){
        for($i = 97; $i <= 122; $i++){
            $ascii[$i] = chr($i);
        }
        echo '<table border = "1" cellspacing = "1" bgcolor = "91f972">
        <caption>Código ASCII</caption>';
        echo '<thead>
                <tr>
                    <th align = "center" bgcolor = "7286f9">Número</th>
                    <th align = "center" bgcolor = "7286f9">Letra</th>
                </tr>
                </thead>';
        echo '<tbody>';
        foreach ($ascii as $key => $value) {
            echo '<tr>';
            echo '<td align = "center">'.$key.'</td>';
            echo '<td align = "center">'.$value.'</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    }
?>