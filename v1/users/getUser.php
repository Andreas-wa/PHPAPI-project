<?php
    include("../../objects/users.php");

    $users_handler = new users($database_handler);

    print_r($_POST);
    echo $users_handler->userLogin($_POST['getUser'], $_POST['getPassword']);
   

?>