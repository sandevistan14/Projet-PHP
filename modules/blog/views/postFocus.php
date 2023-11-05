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
class postFocus
{
    private $post;
    private $comments;

    private $currentUser;

    /**
     * @param $post
     * @param $comments
     */
    public function __construct($post, $comments, $currentUser)
    {
        $this->post = $post;
        $this->comments = $comments;
        $this->currentUser = $currentUser;
    }


    public function show(): void {
    ob_start(); 

    $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../../_assets/utils/templates');
    $twig = new \Twig\Environment($loader, ['cache' => false,]);

    echo $twig->render('PostFocus.html', ['post' => $this->post, 'postcomments' => $this->comments, 'currentUser'=> $this->currentUser]);

    $content = ob_get_clean();
    (new layout('Yuta', $content))->show();
    }
}
