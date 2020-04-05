<?php
    include("../../objects/users.php");
    include("../../objects/products.php");


    $product_handler = new products($database_handler);
    $user_handler = new users($database_handler);

    print_r($_POST);
    if(!empty($_POST['token'])) {

        if(!empty($_POST['id'])) { 
    
            $token = $_POST['token'];

            // ge admin behörighet att ta bort produkter
            $userAdmin = $user_handler->userAdmin($token);

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
    
            echo $product_handler->deleteProduct($_POST);
    
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
       

?>