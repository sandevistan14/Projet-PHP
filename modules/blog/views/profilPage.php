<?php

namespace modules\blog\views;

require '/home/yuta/www/_assets/includes/autoloader.php';
require_once __DIR__ .  '/../../../_assets/composer/vendor/autoload.php';
include_once '/home/yuta/www/modules/blog/models/UserRepository.php';
include_once '/home/yuta/www/modules/blog/models/PostRepository.php';
?>
<script src="https://yuta.alwaysdata.net/_assets/scripts/ButtonLoadMore.js"></script>
<?php
session_start();
class ProfilPage
{
    public function show(): void {
        ob_start();


        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../../_assets/utils/templates');
        $twig = new \Twig\Environment($loader, ['cache' => false,]);

        $idUserProfil = $_GET['id_user_profil'];
        $UserProfil = \UserRepository::getUserById($idUserProfil);
        $posts = \PostRepository::getListPostOfUser($UserProfil); //Modif pour que soit user
        $currentUser = $_SESSION["currentUser"];
        $comments = array();
        echo $twig->render('profilPage.html', ['posts' => $posts, 'comments'=> $comments, 'currentUser' => $currentUser, 'UserProfil' => $UserProfil]);



        $content = ob_get_clean();
        (new layout('Yuta', $content))->show();
    }
}
(new ProfilPage())->show();
