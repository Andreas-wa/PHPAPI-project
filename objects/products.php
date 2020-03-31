<?php

include("../../config/database_handler.php");

// klass för products
class Products{

    // privata variabler som endast kan användas inuti klassen
    private $database_handler;
    private $product;


    // construct
    public function __construct($database_handler_IN){
        // koppling till databasen 
        $this->database_handler = $database_handler_IN;
    
    }
    

    // ge product ett id
    public function setProductId($product_id_IN){

         $this->product_id = $product_id_IN;

    }


    // function för att hämta alla products som har gjorts
    public function fetchAllProduct(){

        // sql kod för att välja data
        $query = "SELECT id, product, price, size FROM products";

        // förbered databasen 
        $statmentHandler = $this->database_handler->prepare($query);  

        // om det är sant(om det inte är falskt)
        if($statmentHandler !== false){
            // bind parameter och sql kod
            $statmentHandler->bindparam(":product_id", $this->product_id);
            $statmentHandler->execute();

        }   else{

            echo "could not create database statment";
            die;

        }
    }    


    // lägg till products    
    public function addProduct($product_param, $price_param, $size_param){

        // sql kod för att lägga till data
        $query = "INSERT INTO products(product, price, size) VALUES(:product, :price, :size)";
        // förbered
        $statmentHandler = $this->database_handler->prepare($query);

        // om det inte är tomt
        if($statmentHandler !== false){

            // bind ihop parametrar och sql
            $statmentHandler->bindparam(':product', $product_param);
            $statmentHandler->bindparam(':price', $price_param);
            $statmentHandler->bindparam(':size', $size_param);
            
            // kör
            $success = $statmentHandler->execute();

            // om den körs
            if($success === true){
                echo "OK!";
                //annars
            } else {
                echo "Error while trying to insert product to database!";
            }
            // annars
        } else {
            echo "Could not create database statement!";
            die();
        }
    }


    // function för att tabort products
    public function deleteProduct(){

        // query
        $query = "DELETE FROM products WHERE productID = :product_id";
        // förbered
        $statmentHandler = $this->database_handler->prepare($query);

        // om den körs 

        // gör den säker (bindihop)

        // kör

        //annars


    }

}

?>