<?php

namespace modules\blog\views;

use modules\blog\models\User;

require_once '/home/yuta/www/_assets/includes/autoloader.php';
include_once '/home/yuta/www/modules/blog/models/User.php';
include_once '/home/yuta/www/modules/blog/models/Administrator.php';
include_once '/home/yuta/www/modules/blog/models/PostRepository.php';
include_once '/home/yuta/www/modules/blog/models/CategoryRepository.php';
include_once '/home/yuta/www/modules/blog/models/UserRepository.php';
require_once __DIR__ .  '/../../../_assets/composer/vendor/autoload.php';

class Homepage
{
    private $user;
    private $posts;
    private $cats;

    /**
     * @param $user
     * @param $posts
     * @param $cats
     */
    public function __construct($user, $posts, $cats)
    {
        $this->user = $user;
        $this->posts = $posts;
        $this->cats = $cats;
    }


    public function show(): void {
        ob_start();

        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../../_assets/utils/templates');
        $twig = new \Twig\Environment($loader, ['cache' => false,]);

        echo $twig->render('Homepage.html', ['posts' => $this->posts, 'categories' => $this->cats,'currentUser' => $this->user]);


        $content = ob_get_clean();
        (new layout('Yuta', $content))->show();
    }
}
//(new Homepage())->show();
