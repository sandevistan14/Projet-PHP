<?php

require '/home/yuta/www/_assets/includes/autoloader.php';
include '/home/yuta/www/modules/blog/models/CategoryRepository.php';

use modules\blog\models\Post;

class PostRepository
{
    private const ALLPOSTS_QUERY =
        'SELECT POST.*,count(LIKED_POST) LIKE_NUMBER,count(COMMENTS.PARENT_ID) COMMENT_NUMBER
         FROM POST
         LEFT JOIN LIKE_TABLE ON POST.ID_POST = LIKE_TABLE.LIKED_POST
         LEFT JOIN POST COMMENTS ON POST.ID_POST = COMMENTS.PARENT_ID
         WHERE POST.PARENT_ID IS NULL
         GROUP BY POST.ID_POST,POST.SEND_DATE
         ORDER BY POST.SEND_DATE DESC';

    private const POSTBYID_QUERY =
        'SELECT POST.*,count(LIKED_POST) LIKE_NUMBER,count(COMMENTS.PARENT_ID) COMMENT_NUMBER
         FROM POST
         LEFT JOIN LIKE_TABLE ON POST.ID_POST = LIKE_TABLE.LIKED_POST
         LEFT JOIN POST COMMENTS ON POST.ID_POST = COMMENTS.PARENT_ID
         WHERE POST.ID_POST = ?
         GROUP BY POST.ID_POST,POST.SEND_DATE
         ORDER BY POST.SEND_DATE DESC';

    private const COMMENTSBYID_QUERY =
        'SELECT POST.*,count(LIKED_POST) LIKE_NUMBER,count(COMMENTS.PARENT_ID) COMMENT_NUMBER
         FROM POST
         LEFT JOIN LIKE_TABLE ON POST.ID_POST = LIKE_TABLE.LIKED_POST
         LEFT JOIN POST COMMENTS ON POST.ID_POST = COMMENTS.PARENT_ID
         WHERE POST.PARENT_ID = ?
         GROUP BY POST.ID_POST,POST.SEND_DATE
         ORDER BY POST.SEND_DATE DESC';

    private const POSTBYUSER_QUERY =
        'SELECT POST.*,count(LIKED_POST) LIKE_NUMBER,count(COMMENTS.PARENT_ID) COMMENT_NUMBER
         FROM POST
         LEFT JOIN LIKE_TABLE ON POST.ID_POST = LIKE_TABLE.LIKED_POST
         LEFT JOIN POST COMMENTS ON POST.ID_POST = COMMENTS.PARENT_ID 
         WHERE POST.ID_AUTHOR = ?
         GROUP BY POST.ID_POST,POST.SEND_DATE
         ORDER BY POST.SEND_DATE DESC';

    /**
     * @return array
     */
    public static function getPosts(){
        $listPost = [];
        $tableResPost = _assets\includes\Database::getInstance()->query(self::ALLPOSTS_QUERY);
        $res = $tableResPost->fetchAll();
        foreach ($res as $post){
            $categories = CategoryRepository::getCatOfPost($post['ID_POST']);
            array_push($listPost, new Post($post,$categories));
        }
        return $listPost;
    }

    public static function getCommentsById(int $ID_POST){
        $listComments = [];
        $tableResPost = _assets\includes\Database::getInstance()->query(self::COMMENTSBYID_QUERY);
        $categories = [];
        $comments = $tableResPost->fetchAll();
        foreach ($comments as $comment){
            array_push($listComments, new Post($comment,$categories));
        }
        return $listComments;
    }

    /**
     * @param int $ID_POST
     * @return \modules\blog\models\Post|null
     */
    public static function getPostById(int $ID_POST){
        $tableResPost = _assets\includes\Database::getInstance()->prepare(self::POSTBYID_QUERY);
        $tableResPost->execute([$ID_POST]);
        $post = $tableResPost->fetch();
        $categories = CategoryRepository::getCatOfPost($ID_POST);
        return new Post($post,$categories);
    }

    public static function getListPostOfUser(modules\blog\models\User $user){
        $listPost = [];
        $tableResPost = _assets\includes\Database::getInstance()->prepare(self::POSTBYUSER_QUERY);
        $tableResPost->execute([$user->getId()]);
        $res = $tableResPost->fetchAll();
        foreach ($res as $post) {
            $categories = CategoryRepository::getCatOfPost($post['ID_POST']);
            array_push($listPost,new Post($post,$categories));
        }
        return $listPost;
    }

}