<?php
    use Backend\Myapi\Products as Products;
    require_once __DIR__.'/myapi/Products.php';
    $Objeto = new Products('marketzone');
    $Objeto->singleByName($_GET['element']);
    echo $Objeto->getData();
?>