<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Ejercicio 5</title>
</head>
<body style="background-color: darkgray">
    <?php
        $autos = [  'AGS2021' =>['Auto' => ['marca' => 'HONDA',
                                            'modelo' => 2020,
                                            'tipo' => 'camioneta'],
                                'Propietario' =>['nombre' => 'Angel Gabriel Aguilar',
                                                'ciudad' => 'Puebla, Puebla',
                                                'direccion' => 'M. Hidalgo #5703']],
                    'LSZ1982' =>['Auto' => ['marca' => 'TOYOTA',
                                            'modelo' => 2023,
                                            'tipo' => 'sedan'],
                                'Propietario' =>['nombre' => 'Laura Saldivar',
                                                'ciudad' => 'Quebrantadero, Morelos',
                                                'direccion' => 'Poniente #193']],
                    'AAS3249' =>['Auto' => ['marca' => 'NISSAN',
                                            'modelo' => 2022,
                                            'tipo' => 'hachback'],
                                'Propietario' =>['nombre' => 'Adriana Saldivar',
                                                'ciudad' => 'CDMX',
                                                'direccion' => 'Espinos #3234']],
                    'AFD9304' =>['Auto' => ['marca' => 'CHEVROLET',
                                            'modelo' => 2009,
                                            'tipo' => 'camioneta'],
                                'Propietario' =>['nombre' => 'Antonio Flores',
                                                'ciudad' => 'León, Guanajuato',
                                                'direccion' => 'Orquídea #63']],
                    'AJG3131' =>['Auto' => ['marca' => 'MERCEDES',
                                            'modelo' => 2019,
                                            'tipo' => 'sedan'],
                                'Propietario' =>['nombre' => 'Javier Dorantes',
                                                'ciudad' => 'Guadalajara, Jalisco',
                                                'direccion' => 'Otoño #15']],
                    'JGL9147' =>['Auto' => ['marca' => 'HB',
                                            'modelo' => 2011,
                                            'tipo' => 'hachback'],
                                'Propietario' =>['nombre' => 'Javier Garcia',
                                                'ciudad' => 'Monterrey, Nuevo León',
                                                'direccion' => 'Atardecer #1']],
                    'IAL5403' =>['Auto' => ['marca' => 'HONDA',
                                            'modelo' => 2018,
                                            'tipo' => 'camioneta'],
                                'Propietario' =>['nombre' => 'Ismael Salgado',
                                                'ciudad' => 'Teziutlán, Puebla',
                                                'direccion' => 'Porfirio Díaz #64']],
                    'DPG2046' =>['Auto' => ['marca' => 'VOLKSWAGEN',
                                            'modelo' => 2017,
                                            'tipo' => 'sedan'],
                                'Propietario' =>['nombre' => 'Diego Cardoso',
                                                'ciudad' => 'Cholula, Puebla',
                                                'direccion' => 'El Sol #2545']],
                    'JRT4529' =>['Auto' => ['marca' => 'MERCEDES',
                                            'modelo' => 2024,
                                            'tipo' => 'hachback'],
                                'Propietario' =>['nombre' => 'Juan Ríos',
                                                'ciudad' => 'Puebla, Puebla',
                                                'direccion' => 'Valsequillo #4733']],
                    'JCT1394' =>['Auto' => ['marca' => 'CHEVROLET',
                                            'modelo' => 2000,
                                            'tipo' => 'camioneta'],
                                'Propietario' =>['nombre' => 'Juan Torres',
                                                'ciudad' => 'Tehuacán, Puebla',
                                                'direccion' => 'Serdán #34']],
                    'ARH2489' =>['Auto' => ['marca' => 'VOLKSWAGEN',
                                            'modelo' => 2020,
                                            'tipo' => 'sedan'],
                                'Propietario' =>['nombre' => 'Alexis Hernández',
                                                'ciudad' => 'Chilpancingo, Guerrero',
                                                'direccion' => 'Iturbide #344']],
                    'LAR2895' =>['Auto' => ['marca' => 'MAZDA',
                                            'modelo' => 2017,
                                            'tipo' => 'hachback'],
                                'Propietario' =>['nombre' => 'Luis Rodríguez',
                                                'ciudad' => 'Quebrantadero, Quebrantadero',
                                                'direccion' => '2 Sur #3210']],
                    'SDC3510' =>['Auto' => ['marca' => 'MAZDA',
                                            'modelo' => 2024,
                                            'tipo' => 'camioneta'],
                                'Propietario' =>['nombre' => 'Sergio Corona',
                                                'ciudad' => 'Hermosillo, Sonora',
                                                'direccion' => 'Estercoleros #3284']],
                    'RAT4803' =>['Auto' => ['marca' => 'VOLKSWAGEN',
                                            'modelo' => 2018,
                                            'tipo' => 'sedan'],
                                'Propietario' =>['nombre' => 'Omar Pérez',
                                                'ciudad' => 'Oaxaca, Oaxaca',
                                                'direccion' => 'Benito Juárez #4212']],
                    'RPM7342' =>['Auto' => ['marca' => 'TOYOTA',
                                            'modelo' => 2021,
                                            'tipo' => 'hachback'],
                                'Propietario' =>['nombre' => 'Rubén Maldo',
                                                'ciudad' => 'Atlixco, Puebla',
                                                'direccion' => 'Las Flores #7348']],];
        //print_r($autos);
        if(isset($_POST['info'])){
            echo '<center><h2>Registro de autos</h2>';
        echo '<table border = "1" cellspacing = "1" bgcolor = "f9ce72">';
        echo '<thead>
                <tr align = "center" bgcolor = "e16f5d">
                    <th rowspan="2">Placa</th>
                    <th colspan="3">Auto</th>
                    <th colspan="3">Propietario</th>
                </tr>
                <tr align = "center" bgcolor = "e16f5d">
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>Ciudad</th>
                    <th>Dirección</th>
                </tr>
                </thead>';
        echo '<tbody>';
        if($_POST['info'] == 'todos'){
            foreach($autos as $clave => $datos){
                echo '<tr align = "center">';
                echo '<td>'.$clave.'</td>';
                echo '<td>'.$datos['Auto']['marca'].'</td>';
                echo '<td>'.$datos['Auto']['modelo'].'</td>';
                echo '<td>'.$datos['Auto']['tipo'].'</td>';
                echo '<td>'.$datos['Propietario']['nombre'].'</td>';
                echo '<td>'.$datos['Propietario']['ciudad'].'</td>';
                echo '<td>'.$datos['Propietario']['direccion'].'</td>';
                echo '</tr>';
            }
        }else{
            if(isset($_POST['matricula'])){
                $mat = $_POST['matricula'];
                if(array_key_exists($mat,$autos)){
                    $datos = $autos[$mat];
                    echo '<tr align = "center">';
                    echo '<td>'.$mat.'</td>';
                    echo '<td>'.$datos['Auto']['marca'].'</td>';
                    echo '<td>'.$datos['Auto']['modelo'].'</td>';
                    echo '<td>'.$datos['Auto']['tipo'].'</td>';
                    echo '<td>'.$datos['Propietario']['nombre'].'</td>';
                    echo '<td>'.$datos['Propietario']['ciudad'].'</td>';
                    echo '<td>'.$datos['Propietario']['direccion'].'</td>';
                    echo '</tr>';
                }else{
                    echo '<h2>La matrícula ingresada no está registrada</h2>';
                }
            }
        }
        echo '</tbody></table></center>';
        }
    ?>
</body>
</html>