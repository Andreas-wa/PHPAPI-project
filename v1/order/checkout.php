<?php

include('../../objects/users.php');
include("../../objects/orders.php");

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

        // skickar allt till databasen
        echo $order_handler->checkoutToDatabase($_POST['token']);

        // skriver ut allt som användaren har lagg till i carten
        echo "<pre>";
        print_r($order_handler->checkOut($_POST['token']));
        echo "</pre>";

} else {
    $return_object = new stdClass;
    $return_object->error = "No token found!";
    $return_object->errorCode = 1337;

    echo json_encode($return_object);
}


?>