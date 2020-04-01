<?php
    include("../../objects/products.php");


    $product_object = new Products($database_handler);

    // print_r($_POST);

    // hämta de som skrivs
    // hamta product
    $product_IN = (isset($_GET['product']) ? $_GET['product'] : '');
    // hämtar price
    $price_IN = (isset($_GET['price']) ? $_GET['price'] : '');
    // hämtar size
    $size_IN = (isset($_GET['size']) ? $_GET['size'] : '');

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