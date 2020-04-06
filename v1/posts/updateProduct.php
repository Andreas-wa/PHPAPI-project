<?php
include('../../objects/products.php');
include('../../objects/users.php');

$product_handler = new Products($database_handler);
$user_handler = new Users($database_handler);

if(!empty($_POST['token'])) {

    if(!empty($_POST['id'])) { 

        $token = $_POST['token'];

        // ge admin behörighet att ändra
        $userAdmin = $user_handler->userAdmin($token);

        echo "Produkten som har blivit uppdaterad: ";

        if($userAdmin === false){

        echo "inte behörighet";
        die();

        }

        if($user_handler->validateToken($token) === false) {
            $return_object = new stdClass;
            $return_object->error = "Token is invalid";
            $return_object->errorCode = 1338;
            echo json_encode($return_object);
            die();
        }

        echo $product_handler->updateProduct($_POST);

    } else {
        $return_object = new stdClass;
        $return_object->error = "Invalid id!";
        $return_object->errorCode = 1336;

        echo json_encode($return_object);
    }

} else {
    $return_object = new stdClass;
    $return_object->error = "No token found!";
    $return_object->errorCode = 1337;

    echo json_encode($return_object);
}
