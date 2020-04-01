<?php
include('../../objects/products.php');
include('../../objects/users.php');

$product_object = new Products($database_handler);
$user_handler = new Users($database_handler);

$token = $_POST['token'];

if($user_handler->validateToken($token) === false) {
    echo "Invalid token!";
    die;
}

echo "<pre>";
print_r($posts_object->fetchAllProducts());
echo "</pre>";



?>