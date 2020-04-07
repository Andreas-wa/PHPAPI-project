<?php

include('../../objects/products.php');
include('../../objects/users.php');
include("../../objects/orders.php");

$product_handler = new Products($database_handler);
$user_handler = new Users($database_handler);
$order_handler = new Orders($database_handler);

if(!empty($_POST['token'])) {

        $token = $_POST['token'];

        if($user_handler->validateToken($token) === false) {
            $return_object = new stdClass;
            $return_object->error = "Token is invalid";
            $return_object->errorCode = 1338;
            echo json_encode($return_object);
            die();
        }

        // foreach($order_handler->checkOut($_POST['token']) as $order){

    // echo "<center>";
    // echo "<span><h1>" . " " . $order['product']. "</h1></br></span><br/>";
    // echo "<span>  Description: </span>" . " " . $order['price']. "<br/>";
    // echo "<span><h3>  Description: </span>" . " " . $order['size']. " " . "</h3><br/>";
    // // echo "<a href='getProduct.php?id={$product['id']}'>Köp</a>";
    // echo "<a href='../order/cart.php?id={$order['id']}'>Köp</a>";
    // echo "<hr>";
    // echo "</center>";

// }
        // echo $order_handler->checkOut($_POST);

} else {
    $return_object = new stdClass;
    $return_object->error = "No token found!";
    $return_object->errorCode = 1337;

    echo json_encode($return_object);
}

echo "<pre>";
print_r($order_handler->checkOut($_POST['token']));
echo "<pre>";

?>