<?php
    use Backend\Myapi\Products as Products;
    include_once __DIR__.'/myapi/Products.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    // SE TRANSFORMA EL STRING DEL JSON A OBJETO
    $jsonOBJ = json_decode($producto);

    $Objeto = new Products('marketzone');
    $Objeto->edit($jsonOBJ);
    echo $Objeto->getData();
?>