<?php

include("../../config/database_handler.php");

// gör en klass för user
class Users {

    // user har variabeln $dadatabase_handler som endast kan finns i klassen users
    private $database_handler;
    private $username;
    private $validty_token_time = 15;

    // function för att  
    // __construct(som gör startar ett objekt)
    public function __construct($database_handler_IN){
        // ta locala värdet "database_handler" och ge den värdet ett värde
        $this->database_handler = $database_handler_IN;
    }

    // ny function för att skriva ut databasen
    // en ny function gör, denna function ska skriva ut databasen
    public function printDatabase(){
        // anropar den privata/locala variablen 
        echo $this->database_handler;
    }

    // ny function för att lägga till användare
    //  ge functionen parametrar som 
    public function addUser($user_IN, $password_IN){
        // retunera en ny klass
        $return_object = new stdClass();

        // kolla om användaren redan finns
        if($this->isUserTaken($user_IN) === false ){
            
            // om användare inte finns, skicka till databasen
            //  hämta functionen addToDatabase
            $return = $this->addToDatabase($user_IN, $password_IN);
            if($return !== false){

                // 
                $return_object->state = "Success";
                $return_object->user = $return;
                
            }   else{
                // annars kommer den att ge ett error meddelande
                $return_object->state = "ERROR!";
                $return_object->message = "gick inte att lagga till anvandare i databasen!";
            }
            
            // om det finns skriv ut error
        }   else{
            $return_object->state = "ERROR!";
            $return_object->message = "anvandar namn ar redan tagen!";
        }

        // retunera return_object
        return json_encode($return_object);
    }


    // ny function för lägga till i databasen 
    private function addToDatabase($user_param, $password_param){

        // query för att lägga till data 
        $query = "INSERT INTO users (user, password) VALUES(:user, :password)";
        //  förbered databasen
        $statementHandler = $this->database_handler->prepare($query);

        // om den är sann gå vidare till nästa steg
        if ($statementHandler !== false) {
            
            // variabel för md5 lösenord
            $secPassword = md5($password_param);

            // koppla ihop queryn med det som skrivs in i inputsen
            $statementHandler->bindParam(':user', $user_param);
            $statementHandler->bindParam(':password', $secPassword);

            // kör frågan
            $statementHandler->execute();

            // retunera värdena
            return $statementHandler->fetch();

        }   else{
            // om det inte finns retunera felmeddelande
            echo "addtodatabae error!";
           return false;
        }
    }


    // ny function för att kolla användare
    private function isUserTaken($user_param){

        // hämta alla users databasen 
        $query = "SELECT count(id) FROM users WHERE user = :user";
        // gör koppling till databasen
        $statementHandler = $this->database_handler->prepare($query);

        // kolla statmenthandler 
        // om det finns gå vidare 
        if($statementHandler !== false){
            
            // byt ut värdet från queryn och skriv ut värdet $user_param från functionen
            $statementHandler->bindParam(":user", $user_param);
            // kör statmenthandler
            $statementHandler->execute();
            
            // hämta från första värdet
            $allUsernames = $statementHandler->fetch()[0];

            // kolla användar namnet 
            if($allUsernames > 0){
                // om den finns
                return true;
            }   else{
                // om den inte finns
                print_r ("isUserTaken error");
                return false;
            }

            // error meddelande om statementhandler inte finns
        }   else{
            echo "statementhandlern funkar inte";
            // döda functionen
            die;
        }
    }


    // function för login
    public function userLogin($user_parameter, $password_parameter){
        
        $return_object = new stdClass();

        // query
        $query = "SELECT id, user, password FROM users WHERE user=:user_IN AND password=:password_IN";
        // förbered
        $statementHandler = $this->database_handler->prepare($query);

        // om det finns
        if ($statementHandler !== false) {

            // encrypta lösenorden
            $password = md5($password_parameter);

            // bind ihop queryn och parametrarna
            $statementHandler->bindParam(':user_IN', $user_parameter);
            $statementHandler->bindParam(':password_IN', $password);
            
            // executea statmenthandlern
            $statementHandler->execute();

            // checka lösenordet
            $return = $statementHandler->fetch();

            // om return körs gå vidare
            if(!empty($return)){
            
                // ger variabeln username ett värde 
                $this->username = $return['user'];

                // hämta token från function getToken
                $return_object->token = $this->getToken($return['id'], $return['user']);
                // retunera json med parameter 
                return json_encode($return_object);


                // echo "gör token";
            }   else{
                echo "login fel";
            }

            // error medelande om det inte funkar
        }   else{
            echo "statmentHandlernn funkar inte";
            die;
        }
    }

    // function för att hämta token 
    // ge ut en token till varje enskild användare
    private function getToken($userID, $user){

        // hämta token för användare
        $token = $this->checkToken($userID);

        return $token;


    }

    // function för att checka token 
    private function checkToken($userID_IN){

        // query
        $query = "SELECT token, date_update FROM tokens WHERE user_id=:userID";

        // prepare
        $statementHandler = $this->database_handler->prepare($query);
        
        // kolla om den funkar
        if($statementHandler !== false){
            // bind parametrar och queryn
            $statementHandler->bindParam(":userID", $userID_IN);
            
            // execute
            $statementHandler->execute();

            // retunera statmenthandlern
            $return = $statementHandler->fetch();

            // kolla om den finns
            if(!empty($return['token'])){

                // kolla tiden
                $token_timeStamp = $return['date_update'];
                $diff = time() - $token_timeStamp;
            
                // om tiden överskrider skiv detta
                if(($diff / 60) > $this->validty_token_time){

                    // query för delete
                    $query = "DELETE FROM tokens WHERE user_id=:userID";

                    // förbered databasen
                    $statementHandler = $this->database_handler->prepare($query);

                    // bind ihop parametrar och sql 
                    $statementHandler->bindParam(':userID', $userID_IN);

                    // kör
                    $statementHandler->execute();

                    // retunera/ hämta den gjorda token
                    return $this->createToken($userID_IN);

                    // annars skriv detta
                }   else{
                    return $return['token'];
                }
                
                die;

                // om den inte finns
            }   else{

                // gör en token
                return $this->createToken($userID_IN);
            }

            echo "yay";
        }   else{
            echo "shit";
        }
    }

    // function för att göra token 
    private function createToken($user_id_param){

        // gör token unik
        $uniqToken = md5($this->username.uniqid('', true).time());

        // query
        $query = "INSERT INTO tokens (user_id, token, date_update) VALUES (:userid, :token, :current_time)";
        // prepare
        $statementHandler = $this->database_handler->prepare($query);
        
        // kolla statmentHandler 
        if($statementHandler !== false){
            
            // bind parametrar och query
            $currentTime = time();
            $statementHandler->bindParam(":userid", $user_id_param);
            $statementHandler->bindParam(":token", $uniqToken);
            $statementHandler->bindParam(":current_time", $currentTime, PDO::PARAM_INT);

            // kör statmenthandler
            $statementHandler->execute();

            // retunera variabeln för de unika token
            return $uniqToken;

            // annars
        }   else {
            return "nooooo!!, token ville inte";
        }
        // echo $uniqToken;
    }


    // function för att validera token    
    public function validateToken($token){

        // query
        $query = "SELECT user_id, date_update FROM tokens WHERE token=:token";
        // förbered databasem
        $statementHandler = $this->database_handler->prepare($query);

        // if stass
        if($statementHandler !== false ){

            // bind ihop parametrar och sql
            $statementHandler->bindParam(":token", $token);
            // kör statmenthandler
            $statementHandler->execute();

            // variabel för att hämta data
            $token_data = $statementHandler->fetch();

            // if sats som säger att om det finns data och som kollar tid

            // om den inte är tom (det finns data i satsen)
            if(!empty($token_data['date_update'])) {
                
                // variabel tiden när tokenen gjordes 
                $diff = time() - $token_data['date_update'];

                // kolla tiden 
                if( ($diff / 60) < $this->validty_token_time ) {

                    // sql
                    $query = "UPDATE tokens SET date_update=:update_date WHERE token=:token";
                    // förbered databasen
                    $statementHandler = $this->database_handler->prepare($query);
                    
                    // variabel för tiden
                    $updateDate = time();
                    // bind ihop parametrar och sql med en PDO
                    $statementHandler->bindParam(":update_date", $updateDate, PDO::PARAM_INT);
                    $statementHandler->bindParam(":token", $token);

                    // kör
                    $statementHandler->execute();

                    // retunera if satsen
                    return true;

                    // annars
                } else {
                    echo "Session closed due to inactivity<br />";
                    return false;
                }
                // annars
            } else {
                echo "Could not find token, please login first<br />";
                return false;
            }
            // annars
        } else {
            echo "Couldnt create statementhandler<br />";
            return false;
        }

        // retunera allt
        return true;

    }


    // function för att kolla användarens id
    private function getUserId($token){

        $query = "SELECT user_id FROM tokens WHERE token=:token"; 
        $statementHandler = $this->database_handler->prepare($query);

        if($statementHandler !== false){

            $statementHandler->bindParam(":token",$token);
            
            $statementHandler->execute();

            $return = $statementHandler->fetch()[0];

            // print_r($return);

            if(!empty($return)){
                return $return;
            }   else{
                return -1;
            }

        }   else {
            echo "kunde inte hämta id för användaren";
            return -1;
        }
    }


    // function för att hömta användarens data/info
    private function getUserData($userID){

        $query = "SELECT id, user, role FROM users WHERE id=:userID_IN";
        $statementHandler = $this->database_handler->prepare($query);

        if($statementHandler !== false){
            
            // något fel här 
            $statementHandler->bindParam(":userID_IN", $userID);
            $statementHandler->execute();

            $return = $statementHandler->fetch();

            
            
            // kolla om det finns en admin
            if(!empty($return)){
                return $return;
            }   else{
                return false;
            }

        }   else{
            echo "kunde inte hämta användarens data/ inforamation";
        }
    }



    // function för att kolla om användaren är admin
    public function userAdmin($token){

        // hämta functionerna "getUserId" och "getUserData"
        $user_id = $this->getUserId($token);
        $user_data = $this->getUserData($user_id);
        
        // något fel här
        if($user_data['role'] == 1){
            return true;
        }   else{
            return false;
        }
    }
}

?>