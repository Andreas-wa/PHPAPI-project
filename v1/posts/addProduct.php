<?php
    include("../../objects/product.php");

    $users_handler = new product($database_handler);

    print_r($_POST);
//    echo $users_handler->addUser($_POST['user'], $_POST['password']);
   

?>