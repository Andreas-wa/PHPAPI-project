<?php
    include("../../objects/products.php");

    $product_handler = new Products($database_handler);

    echo "<pre>";
    print_r($product_handler->fetchAllProduct());
    echo "</pre>";
   

?>