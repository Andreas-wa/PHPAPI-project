<?php
    include("../../objects/products.php");

    $product_handler = new Products($database_handler);

    $product_id = ( !empty($_GET['id'] ) ? $_GET['id'] : -1 );

    $product_handler->setProductId($product_id);
    $product = $product_handler->fetchSingleProduct();

    // echo "<pre>";
    // print_r($product_handler->fetchSingleProduct());
    // echo "</pre>";

    echo "<center>";
    echo "<span><h1>" . " " . $product['product']. "</h1></br></span><br/>";
    echo "<span>  Description: </span>" . " " . $product['price']. "<br/>";
    echo "<span><h3>  Description: </span>" . " " . $product['size']. " " . "</h3><br/>";   
   
    echo "<hr>";
    echo "<a href='getProduct.php?id={$product['id']}'>{$product['product']}</a>";
    echo "<hr>";
    echo "</center>";

?>