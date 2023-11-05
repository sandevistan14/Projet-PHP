<?php

namespace modules\blog\controllers;

require '/home/yuta/www/modules/blog/views/profilPage.php';
require '/home/yuta/www/_assets/includes/autoloader.php';
include_once '/home/yuta/www/modules/blog/models/UserRepository.php';
include_once '/home/yuta/www/modules/blog/models/PostRepository.php';

class ProfilPage
{
    public function execute($currentUser,$idUserProfil): void
    {
        $UserProfil = \UserRepository::getUserById($idUserProfil);
        $posts = \PostRepository::getListPostOfUser($UserProfil);
        $comments = \PostRepository::getListCommentOfUser($UserProfil);
        (new \modules\blog\views\ProfilPage($currentUser,$posts,$comments,$UserProfil))->show();
    }
}