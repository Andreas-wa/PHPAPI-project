<?php
    include("../../objects/users.php");
    include("../../objects/products.php");


    $users_handler = new users($database_handler);

    print_r($_POST);
    
    // skicka vidare till databasen
    echo $users_handler->userLogin($_POST['getUser'], $_POST['getPassword']);
   


?>