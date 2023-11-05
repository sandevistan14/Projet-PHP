<?php
namespace _assets\includes;


require '/home/yuta/www/_assets/includes/autoloader.php';
include_once '/home/yuta/www/modules/blog/models/PostRepository.php';
include_once '/home/yuta/www/modules/blog/models/CategoryRepository.php';
include_once '/home/yuta/www/modules/blog/models/UserRepository.php';

session_start();

if ($_SESSION['currentUser']->isAdmin()){
    $PostToDelete = \PostRepository::getPostById($_GET['ID_POST']);
    $_SESSION['currentUser']->DeletePost($PostToDelete);
    //renvoie sur l'index
}
header('Location: https://yuta.alwaysdata.net/');
exit();