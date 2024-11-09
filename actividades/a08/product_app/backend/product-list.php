<?php
    use Backend\Myapi\Products as Products;
    require_once __DIR__.'/myapi/Products.php';
    $ProductOb = new Products('marketzone');
    $ProductOb->list();
    echo $ProductOb->getData();
?>