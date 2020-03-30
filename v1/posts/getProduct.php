<?php
    include("../../objects/product.php");

    $users_handler = new product($database_handler);

    print_r($_POST);
    // echo $users_handler->userLogin($_POST['getUser'], $_POST['getPassword']);
   

?>