<?php
    include("../../objects/products.php");

    $product_object = new products($database_handler);

    print_r($_POST);

    $product_IN = (isset($_GET['product']) ? $_GET['product'] : '');
    $price_IN = (isset($_GET['price']) ? $_GET['price'] : '');
    $size_IN = (isset($_GET['size']) ? $_GET['size'] : '');

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
    
    }   else{
        echo "nnnoooo!";
    }


?>