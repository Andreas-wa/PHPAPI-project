<?php
    include("../../objects/products.php");

    $pro_handler = new products($database_handler);

    print_r($_POST);
    // echo $users_handler->userLogin($_POST['getUser'], $_POST['getPassword']);
   

?>