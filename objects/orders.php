<?php

include("../../config/database_handler.php");


class Orders {

    private $database_handler;
    private $order; 

    // construct
    public function __construct($database_handler_IN){
        // koppling till databasen 
        $this->database_handler = $database_handler_IN;
    }

    // lägger till en produkt till 
    public function addOrders($token_param, $product_id_param){

        // sql kod för att lägga till data
        $query = "INSERT INTO orders(token, product_id) VALUES(:token, :product_id)";

        // förbered
        $statmentHandler = $this->database_handler->prepare($query);

        // om det inte är tomt
        if($statmentHandler !== false){

            // bind ihop parametrar och sql
            $statmentHandler->bindparam(':token', $token_param);
            $statmentHandler->bindparam(':product_id', $product_id_param);
            
            // kör
            $success = $statmentHandler->execute();

            // om den körs
            if($success === true){
                echo "OK!";
                //annars
            } else {
                echo "Error gick inte att skicka in data i databasen!";
            }
            // annars
        } else {
            echo "kunde inte göra en 'database statement!'";
            die();
        }
    }


    // delete order
    public function deleteOrder($delete_param){

        // query (funkar)
        $query = "DELETE FROM orders WHERE id = :ordersID";
        // förbered
        $statmentHandler = $this->database_handler->prepare($query);

        // om den körs 
        if($statmentHandler !== false){

            // bind
            $statmentHandler->bindparam(':ordersID', $delete_param['id']);
            
            // kör
            $deleted = $statmentHandler->execute();

            if($deleted == true){
                echo "Deleted";
            }   else{
                echo "DeleteOrders funkar inte";
            }
        }
    }


    // function för att checka ut 
    public function checkOut($token_param){

    // sql kod för att välja data
    $query = "SELECT * FROM orders WHERE token=:token";

    // förbered databasen 
    $statmentHandler = $this->database_handler->prepare($query);  

    // om det är sant(om det inte är falskt)
    if($statmentHandler !== false){
        // bind parameter och sql kod
        $statmentHandler->bindparam(":token", $token_param);
        $statmentHandler->execute();

        return $statmentHandler->fetchAll();

    }   else{
        // skriv ut error medelande om det inte funkar
        echo "could not create database statment";
        die;
    }
}


    // function för att skicka in i databasen
    public function checkoutToDatabase($token_param){

        // query
        $query = "INSERT INTO checkout SELECT * FROM orders WHERE token=:token";
        // prepare
        $statementHandler = $this->database_handler->prepare($query);
        
        // kolla statmentHandler 
        if($statementHandler !== false){
            
            // bind parametrar och query
            $statementHandler->bindParam(":token", $token_param);
            // $statementHandler->bindParam(":product_id", $product_id_param);


            // kör statmenthandler
            $statementHandler->execute();

            // annars
        }   else {
            return "nooooo!!, gick inte att checka utt";
        }
    }
}

?>