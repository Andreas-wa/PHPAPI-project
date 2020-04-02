<?php
include('../../objects/products.php');
include('../../objects/users.php');

$post_handler = new Products($database_handler);
$user_handler = new Users($database_handler);

if(!empty($_GET['token'])) {

    if(!empty($_GET['id'])) { 

        $token = $_GET['token'];

        if($user_handler->validateToken($token) === false) {
            $return_Object = new stdClass;
            $return_Object->error = "Token is invalid";
            $return_Object->errorCode = 1338;
            echo json_encode($return_Object);
            die();
        }

        $post_handler->updateProduct($_POST);


    } else {
        $return_Object = new stdClass;
        $return_Object->error = "Invalid id!";
        $return_Object->errorCode = 1336;

        echo json_encode($return_Object);
    }

} else {
    $return_Object = new stdClass;
    $return_Object->error = "No token found!";
    $return_Object->errorCode = 1337;

    echo json_encode($return_Object);
}
