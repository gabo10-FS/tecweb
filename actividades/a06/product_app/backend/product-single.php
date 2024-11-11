<?php
    use Backend\Myapi\Products as Products;
    require_once __DIR__.'/myapi/Products.php';
    $Objeto = new Products('marketzone');
    $Objeto->single($_POST['id']);
    echo $Objeto->getData();
?>