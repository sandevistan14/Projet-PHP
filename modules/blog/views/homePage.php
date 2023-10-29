<?php

namespace modules\blog\views;

require '/home/yuta/www/_assets/includes/autoloader.php';
include '/home/yuta/www/modules/blog/models/User.php';
include '/home/yuta/www/modules/blog/models/Administrator.php';
include '/home/yuta/www/modules/blog/models/PostRepository.php';
require_once __DIR__ .  '/../../../_assets/composer/vendor/autoload.php';
?>
    <script src="https://yuta.alwaysdata.net/_assets/scripts/ButtonLoadMore.js"></script>
<?php
session_start();
if(!isset($_SESSION["currentUser"])){
    header("Location: connectionPage.php");
    exit();
}

class Homepage
{
    public function show(): void {
        ob_start();

        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../../_assets/utils/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
        ]);
        $posts = \PostRepository::getPost();
        echo $twig->render('Homepage.html', ['posts' => $posts]);


        $content = ob_get_clean();
        (new layout('Yuta', $content))->show();
        
    }
}
(new Homepage())->show();
