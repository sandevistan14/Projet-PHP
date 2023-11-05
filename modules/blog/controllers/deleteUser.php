<?php
namespace _assets\includes;


require '/home/yuta/www/_assets/includes/autoloader.php';
include_once '/home/yuta/www/modules/blog/models/PostRepository.php';
include_once '/home/yuta/www/modules/blog/models/CategoryRepository.php';
include_once '/home/yuta/www/modules/blog/models/UserRepository.php';

session_start();

if ($_SESSION['currentUser']->isAdmin()){
    $userToDelete  = \UserRepository::getUserById($_GET['ID_USER']);
        $_SESSION['currentUser']->DeleteUser($userToDelete);
    }


header('Location: https://yuta.alwaysdata.net/');
exit();

