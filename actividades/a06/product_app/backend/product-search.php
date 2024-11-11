<?php
    use Backend\Myapi\Products as Products;
    require_once __DIR__.'/myapi/Products.php';
    $ProductOb = new Products('marketzone');
    $ProductOb->search($_GET['search']);
    echo $ProductOb->getData();
?>