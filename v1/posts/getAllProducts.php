<?php
include('../../objects/products.php');
include('../../objects/users.php');

$product_handler = new Products($database_handler);


foreach($product_handler->fetchAllProduct() as $product){

    echo "<center>";
   
   echo "<span><h1>" . " " . $product['product']. "</h1></br></span><br/>";
   echo "<span>  Description: </span>" . " " . $product['price']. "<br/>";
   echo "<span><h3>  Description: </span>" . " " . $product['size']. " " . "</h3><br/>";
//    echo "<span><h5> producted:    </span>" . " " . $product['date_update']. "</h5><br/>";
   
   
   echo "<hr>";
   echo "<a href='getProduct.php?id={$product['id']}'>{$product['product']}</a>";
//    echo "</br>";
//    echo "<a href='../carts/addProduct.php?id={$product['id']}'>Add to cart</a>";
//    echo "<br/>";
//    echo "<a href='../carts/getAll.php'> To the checkout </a>";
   echo "<hr>";
    echo "</center>";


}


?>