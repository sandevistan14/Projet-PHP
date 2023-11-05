<?php


namespace modules\blog\views;

require_once '/home/yuta/www/_assets/includes/autoloader.php';
include_once '/home/yuta/www/modules/blog/models/User.php';
include_once '/home/yuta/www/modules/blog/models/Administrator.php';
include_once '/home/yuta/www/modules/blog/models/PostRepository.php';
include_once '/home/yuta/www/modules/blog/models/CategoryRepository.php';
include_once '/home/yuta/www/modules/blog/models/UserRepository.php';
require_once __DIR__ . '/../../../_assets/composer/vendor/autoload.php';

session_start();

class SearchCat
{
    public function show(): void {
        ob_start();

        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../../_assets/utils/templates');
        $twig = new \Twig\Environment($loader, ['cache' => false,]);
        $CatId = $_POST['CategorieSearch'];
        $cats = \CategoryRepository::getCat();
        if ($CatId == 0){
            echo $twig->render('SearchCat.html', ['categories' => $cats, 'CategoryIDUsed' => $CatId]);
        }
        else{
            $Category = \CategoryRepository::getCatById($CatId);
            $postsOfCat = \PostRepository::getPostsByCategory($Category->getIdCat());
            echo $twig->render('SearchCat.html', ['posts' => $postsOfCat, 'categories' => $cats, 'CategoryUsed' => $Category ,'CategoryIDUsed' => $CatId,
                'currentUser'=> $_SESSION['currentUser']]);
        }



        $content = ob_get_clean();
        (new layout('Yuta', $content))->show();
    }
}
(new SearchCat())->show();