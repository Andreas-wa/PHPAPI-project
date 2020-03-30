<?php

include("../../config/database_handler.php");

// klass för products
class products{

    // privata variabler som endast kan användas inuti klassen
    private $database_handler;
    private $product;

    // construct
    public function __construct($database_handler_IN){
        // koppling till databasen 
        $this->database_handler = $database_handler_IN;
    
    }

    public function printProduct(){

        echo $this->database_handler;

    }

    public function addProductToDatabase($product_param, $price_param, $size_param){

        $query = "INSERT INTO products (product, price, size) VALUES (:product, :price, :size)";
        $statmentHandler = $this->database_handler->prepare($query);

        if($statmentHandler !== false){

             $statmentHandler->bindparam(':product', $product_param);
             $statmentHandler->bindparam(':price', $price_param);
             $statmentHandler->bindparam(':size', $size_param);

             $statmentHandler->execute();

             return $statmentHandler->fetch();

        }   else{
            
            return false;

        }
    }
}

// $ppp = new products("hejsan!");

// $ppp->printProduct();


?>