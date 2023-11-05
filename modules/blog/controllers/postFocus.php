<?php

namespace modules\blog\controllers;

require '/home/yuta/www/modules/blog/views/postFocus.php';
require '/home/yuta/www/_assets/includes/autoloader.php';
include_once '/home/yuta/www/modules/blog/models/User.php';
include_once '/home/yuta/www/modules/blog/models/Administrator.php';
include_once '/home/yuta/www/modules/blog/models/PostRepository.php';
include_once '/home/yuta/www/modules/blog/models/UserRepository.php';
include_once '/home/yuta/www/modules/blog/models/CategoryRepository.php';

class postFocus
{
    public function execute($postId,$user):void
    {
        $posts = \PostRepository::getPostById($postId);
        $comments = \PostRepository::getCommentsById($postId);
        (new \modules\blog\views\postFocus($posts,$comments,$user))->show();
    }
}