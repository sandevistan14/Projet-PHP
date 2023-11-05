<?php

namespace modules\blog\views;

require '/home/yuta/www/_assets/includes/autoloader.php';
require_once __DIR__ .  '/../../../_assets/composer/vendor/autoload.php';
include_once '/home/yuta/www/modules/blog/models/UserRepository.php';
include_once '/home/yuta/www/modules/blog/models/PostRepository.php';
?>
<script src="https://yuta.alwaysdata.net/_assets/scripts/ButtonLoadMore.js"></script>
<?php
class ProfilPage
{
    private $posts;
    private $comments;
    private $currentUser;
    private $userProfile;

    /**
     * @param $posts
     * @param $comments
     * @param $currentUser
     * @param $userProfile
     */
    public function __construct($currentUser, $posts, $comments, $userProfile)
    {
        $this->posts = $posts;
        $this->comments = $comments;
        $this->currentUser = $currentUser;
        $this->userProfile = $userProfile;
    }


    public function show(): void {
        ob_start();


        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../../_assets/utils/templates');
        $twig = new \Twig\Environment($loader, ['cache' => false,]);


        echo $twig->render('profilPage.html', ['posts' => $this->posts, 'comments'=> $this->comments, 'currentUser' => $this->currentUser, 'UserProfil' => $this->userProfile]);

        $content = ob_get_clean();
        (new layout('Yuta', $content))->show();
    }
}
