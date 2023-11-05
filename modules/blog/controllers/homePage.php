<?php
namespace modules\blog\controllers;

require '/home/yuta/www/modules/blog/views/homePage.php';
require_once '/home/yuta/www/_assets/includes/autoloader.php';
include_once '/home/yuta/www/modules/blog/models/User.php';
include_once '/home/yuta/www/modules/blog/models/Administrator.php';
include_once '/home/yuta/www/modules/blog/models/PostRepository.php';
include_once '/home/yuta/www/modules/blog/models/CategoryRepository.php';
include_once '/home/yuta/www/modules/blog/models/UserRepository.php';

class Homepage
{
    public function execute($user): void
    {
        $posts = \PostRepository::getPosts();
        $cats = \CategoryRepository::getCat();
        (new \modules\blog\views\Homepage($user,$posts,$cats))->show();
    }
}