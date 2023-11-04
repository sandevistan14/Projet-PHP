<?php

namespace modules\blog\views;

require '/home/yuta/www/_assets/includes/autoloader.php';
include_once '/home/yuta/www/modules/blog/models/User.php';
include_once '/home/yuta/www/modules/blog/models/Administrator.php';
include_once '/home/yuta/www/modules/blog/models/PostRepository.php';
include_once '/home/yuta/www/modules/blog/models/UserRepository.php';
include_once '/home/yuta/www/modules/blog/models/CategoryRepository.php';
require_once __DIR__ .  '/../../../_assets/composer/vendor/autoload.php';
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>

<?php


session_start();
if(!isset($_SESSION["currentUser"])){
    header("Location: connectionPage.php");
    exit();
}
if(!($_SESSION['currentUser']->isActive())){
    header("Location: verificationPage.php");
    exit();
}

class postFocus
{
    public function show(): void {
    ob_start(); 

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../../_assets/utils/templates');
$twig = new \Twig\Environment($loader, ['cache' => false,]);

if (isset($_GET['id_Post'])) {
    $postId = $_GET['id_Post'];
}

$post = \PostRepository::getPostById($postId);

echo $twig->render('PostFocus.html', ['post' => $post]);







        $content = ob_get_clean();
        (new layout('Yuta', $content))->show();
    }
}

(new postFocus())->show();
