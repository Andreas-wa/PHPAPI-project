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
    
    public function setProductId($post_id_IN){

         $this->post_id = $post_id_IN;

    }


    public function fetchAllProduct(){

        // sql kod för att välja data
        $query = "SELECT id, product, price, size FROM products";
        // förbered databasen 
        $statmentHandler = $this->database_handler->prepare($query);  

        // om det är sant(om det inte är falskt)
        if($statmentHandler !== false){
            // bind parameter och sql kod 
            $statmentHandler->bindparam(":post_id", $this->post_id);
            $statmentHandler->execute();

        }   else{

            echo "could not create database statment";
            die;

        }
    }    

    // lägg till products    
    public function addProduct($product_param, $price_param, $size_param){

        $query = "INSERT INTO products (product, price, size) VALUES(:product, :price, :size)";
        $statmentHandler = $this->database_handler->prepare($query);

        if($statmentHandler !== false) {

            $statmentHandler->bindparam(':product', $product_param);
            $statmentHandler->bindparam(':price', $price_param);
            $statmentHandler->bindparam(':size', $size_param);
            
            $success = $statmentHandler->execute();

            if($success === true) {
                echo "OK!";
            } else {
                echo "Error while trying to insert post to database!";
            }

        } else {
            echo "Could not create database statement!";
            die();
        }
    }
}

?>