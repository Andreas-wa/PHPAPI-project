<?php
include('../../objects/products.php');
include('../../objects/users.php');

$product_handler = new Products($database_handler);

// skriver ut alla produkter
foreach($product_handler->fetchAllProduct() as $product){

    echo "<center>";
    echo "Ta nummret för att lägga till i varukorg/ta bort/redigera produkten";
    echo "<span><h1>" . " " . $product['id']. "</h1></br></span><br/>";
    echo "<span><h1>" . " " . $product['product']. "</h1></br></span><br/>";
    echo "<span>  Description: </span>" . " " . $product['price']. "<br/>";
    echo "<span><h3>  Description: </span>" . " " . $product['size']. " " . "</h3><br/>";
    echo "<hr>";
    echo "</center>";

}


?>