<?php
    use Backend\Myapi\Products as Products;
    require_once __DIR__.'/myapi/Products.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    // SE TRANSFORMA EL STRING DEL JSON A OBJETO
    $jsonOBJ = json_decode($producto);

    $ProductOb = new Products('marketzone');
    $ProductOb->add($jsonOBJ);
    echo $ProductOb->getData();
?>