<?php
include('../../objects/products.php');
include('../../objects/users.php');

$post_handler = new Products($database_handler);
$user_handler = new Users($database_handler);

if(!empty($_POST['token'])) {

    if(!empty($_POST['id'])) { 

        $token = $_POST['token'];

        if($user_handler->validateToken($token) === false) {
            $retObject = new stdClass;
            $retObject->error = "Token is invalid";
            $retObject->errorCode = 1338;
            echo json_encode($retObject);
            die();
        }

        $post_handler->updatePost($_POST);


    } else {
        $retObject = new stdClass;
        $retObject->error = "Invalid id!";
        $retObject->errorCode = 1336;

        echo json_encode($retObject);
    }

} else {
    $retObject = new stdClass;
    $retObject->error = "No token found!";
    $retObject->errorCode = 1337;

    echo json_encode($retObject);
}
