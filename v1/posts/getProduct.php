<?php
    include("../../objects/products.php");

    $product_handler = new products($database_handler);

    echo "<pre>";
    print_r($product_handler->fetchAllProduct());
    echo "</pre>";
   

?>