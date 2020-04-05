<?php
    include("../../objects/products.php");
    include("../../objects/users.php");


    $product_object = new Products($database_handler);
    $user_handler = new Users($database_handler);

    // print_r($_POST);

    $token = $_POST['token'];

    // kolla om token är aktiv/ validerad
    // om tokens inte stämmer skriv ut error
    if($user_handler->validateToken($token) === false){
        echo "invalid token";
        die();
    }

    $userAdmin = $user_handler->userAdmin($token);

    if($userAdmin === false){

        echo "inte behörighet";
        die();

    }

    // hämta de som skrivs
    // hamta product
    $product_IN = (isset($_POST['product']) ? $_POST['product'] : '');
    // hämtar price
    $price_IN = (isset($_POST['price']) ? $_POST['price'] : '');
    // hämtar size
    $size_IN = (isset($_POST['size']) ? $_POST['size'] : '');

    // om det inte är tomt 
    if(!empty($product_IN)){
        if(!empty($price_IN)){
            if(!empty($size_IN)){

                $product_object->addProduct($product_IN, $price_IN, $size_IN);

            }   else{
                echo "noo";
            }

        }   else{
            echo "noooo!";
        }
    
    }   
    // else{
        // echo "nnnoooo!";
    // }


?>