<?php

namespace _assets\includes;

require '/home/yuta/www/_assets/includes/autoloader.php';
include_once '/home/yuta/www/modules/blog/models/User.php';
include_once '/home/yuta/www/modules/blog/models/Administrator.php';
include_once '/home/yuta/www/modules/blog/models/PostRepository.php';
include_once '/home/yuta/www/modules/blog/models/UserRepository.php';
include_once '/home/yuta/www/modules/blog/models/CategoryRepository.php';

session_start();

$IdPost = $_GET['ID_POST'];
$post = \PostRepository::getPostById($IdPost);
if ($post->IsLike($_SESSION['currentUser']->getId())){
    $_SESSION['currentUser']->UnlikePost($post->getIdPost());
} else {
    $_SESSION['currentUser']->LikePost($post->getIdPost());
}
header('Location: https://yuta.alwaysdata.net/');
exit();