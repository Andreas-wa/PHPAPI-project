<?php

    include("../../objects/orders.php");
    include("../../objects/products.php");
    include("../../objects/users.php");

    $order_handler = new orders($database_handler);

    echo $order_handler->addOrders($_POST['token'], $_POST['product_id']);

    print_r($_POST);

?>

