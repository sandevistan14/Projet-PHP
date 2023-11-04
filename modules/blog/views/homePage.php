<?php

namespace modules\blog\views;

require_once '/home/yuta/www/_assets/includes/autoloader.php';
include_once '/home/yuta/www/modules/blog/models/User.php';
include_once '/home/yuta/www/modules/blog/models/Administrator.php';
include_once '/home/yuta/www/modules/blog/models/PostRepository.php';
include_once '/home/yuta/www/modules/blog/models/CategoryRepository.php';
include_once '/home/yuta/www/modules/blog/models/UserRepository.php';
require_once __DIR__ .  '/../../../_assets/composer/vendor/autoload.php';

session_start();

if(!isset($_SESSION["currentUser"])){
    header("Location: connectionPage.php");
    exit();
}
if(!($_SESSION['currentUser']->isActive())){
    header("Location: verificationPage.php");
    exit();
}

class Homepage
{
    public function show(): void {
        ob_start();

        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../../_assets/utils/templates');
        $twig = new \Twig\Environment($loader, ['cache' => false,]);
        
        $posts = \PostRepository::getPosts();
        $cats = \CategoryRepository::getCat();
        $userClient = $_SESSION["currentUser"];
        echo $twig->render('Homepage.html', ['posts' => $posts, 'categories' => $cats, 'user' => $userClient]);


        $content = ob_get_clean();
        (new layout('Yuta', $content))->show();
    }
}
(new Homepage())->show();
