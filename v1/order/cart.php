<?php

    include("../../objects/orders.php");
    include("../../objects/products.php");
    include("../../objects/users.php");

    $order_handler = new orders($database_handler);

    echo $order_handler->addOrders($_POST['token'], $_POST['id']);

    print_r($_POST);

    // echo "<center>";
    // echo "<span><h1>" . " " . $product['product']. "</h1></br></span><br/>";
    // echo "<span>  Description: </span>" . " " . $product['price']. "<br/>";
    // echo "<span><h3>  Description: </span>" . " " . $product['size']. " " . "</h3><br/>";
    // echo "<hr>";
    // echo "</center>";

?>

