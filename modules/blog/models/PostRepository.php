<?php

require '/home/yuta/www/_assets/includes/autoloader.php';
include '/home/yuta/www/modules/blog/models/CategoryRepository.php';

use modules\blog\models\Post;

class PostRepository
{
    private const ALLPOSTS_QUERY =
        'SELECT POST.*,count(LIKED_POST) LIKE_NUMBER, COMMENTS.COMMENT_NUMBER
         FROM POST
         LEFT JOIN LIKE_TABLE ON POST.ID_POST = LIKE_TABLE.LIKED_POST
	 	 JOIN 
         (SELECT POST.ID_POST,count(COMMENTS.PARENT_ID) COMMENT_NUMBER
         FROM POST
         LEFT JOIN POST COMMENTS ON POST.ID_POST = COMMENTS.PARENT_ID
         GROUP BY POST.ID_POST,POST.SEND_DATE
         ORDER BY POST.SEND_DATE DESC) COMMENTS 
         ON POST.ID_POST = COMMENTS.ID_POST
         WHERE POST.PARENT_ID IS NULL AND POST.TITLE IS NOT NULL
         GROUP BY POST.ID_POST,POST.SEND_DATE
         ORDER BY POST.SEND_DATE DESC;';

    private const POSTBYID_QUERY =
        'SELECT POST.*,count(LIKED_POST) LIKE_NUMBER, COMMENTS.COMMENT_NUMBER
         FROM POST
         LEFT JOIN LIKE_TABLE ON POST.ID_POST = LIKE_TABLE.LIKED_POST
	 	 JOIN 
         (SELECT POST.ID_POST,count(COMMENTS.PARENT_ID) COMMENT_NUMBER
         FROM POST
         LEFT JOIN POST COMMENTS ON POST.ID_POST = COMMENTS.PARENT_ID
         GROUP BY POST.ID_POST,POST.SEND_DATE
         ORDER BY POST.SEND_DATE DESC) COMMENTS 
         ON POST.ID_POST = COMMENTS.ID_POST
         WHERE POST.ID_POST = ?
         GROUP BY POST.ID_POST,POST.SEND_DATE
         ORDER BY POST.SEND_DATE DESC';

    private const COMMENTSBYID_QUERY =
        'SELECT POST.*,count(LIKED_POST) LIKE_NUMBER, COMMENTS.COMMENT_NUMBER
         FROM POST
         LEFT JOIN LIKE_TABLE ON POST.ID_POST = LIKE_TABLE.LIKED_POST
	 	 JOIN 
         (SELECT POST.ID_POST,count(COMMENTS.PARENT_ID) COMMENT_NUMBER
         FROM POST
         LEFT JOIN POST COMMENTS ON POST.ID_POST = COMMENTS.PARENT_ID
         GROUP BY POST.ID_POST,POST.SEND_DATE
         ORDER BY POST.SEND_DATE DESC) COMMENTS 
         ON POST.ID_POST = COMMENTS.ID_POST
         WHERE POST.PARENT_ID = ?
         GROUP BY POST.ID_POST,POST.SEND_DATE
         ORDER BY POST.SEND_DATE DESC';

    private const POSTBYUSER_QUERY =
        'SELECT POST.*,count(LIKED_POST) LIKE_NUMBER, COMMENTS.COMMENT_NUMBER
         FROM POST
         LEFT JOIN LIKE_TABLE ON POST.ID_POST = LIKE_TABLE.LIKED_POST
	 	 JOIN 
         (SELECT POST.ID_POST,count(COMMENTS.PARENT_ID) COMMENT_NUMBER
         FROM POST
         LEFT JOIN POST COMMENTS ON POST.ID_POST = COMMENTS.PARENT_ID
         GROUP BY POST.ID_POST,POST.SEND_DATE
         ORDER BY POST.SEND_DATE DESC) COMMENTS 
         ON POST.ID_POST = COMMENTS.ID_POST 
         WHERE POST.ID_AUTHOR = ? AND POST.PARENT_ID IS NULL AND POST.TITLE IS NOT NULL
         GROUP BY POST.ID_POST,POST.SEND_DATE
         ORDER BY POST.SEND_DATE DESC';

    private const COMMENTBYUSER_QUERY =
        'SELECT POST.*,count(LIKED_POST) LIKE_NUMBER, COMMENTS.COMMENT_NUMBER
         FROM POST
         LEFT JOIN LIKE_TABLE ON POST.ID_POST = LIKE_TABLE.LIKED_POST
	 	 JOIN 
         (SELECT POST.ID_POST,count(COMMENTS.PARENT_ID) COMMENT_NUMBER
         FROM POST
         LEFT JOIN POST COMMENTS ON POST.ID_POST = COMMENTS.PARENT_ID
         GROUP BY POST.ID_POST,POST.SEND_DATE
         ORDER BY POST.SEND_DATE DESC) COMMENTS 
         ON POST.ID_POST = COMMENTS.ID_POST
         WHERE POST.ID_AUTHOR = ? AND POST.PARENT_ID IS NOT NULL 
         GROUP BY POST.ID_POST,POST.SEND_DATE
         ORDER BY POST.SEND_DATE DESC';

    private const POSTBYCATEGORY_QUERY =
        'SELECT POST.*,count(LIKED_POST) LIKE_NUMBER, COMMENTS.COMMENT_NUMBER
         FROM POST
         LEFT JOIN LIKE_TABLE ON POST.ID_POST = LIKE_TABLE.LIKED_POST
	 	 JOIN 
         (SELECT POST.ID_POST,count(COMMENTS.PARENT_ID) COMMENT_NUMBER
         FROM POST
         LEFT JOIN POST COMMENTS ON POST.ID_POST = COMMENTS.PARENT_ID
         GROUP BY POST.ID_POST,POST.SEND_DATE
         ORDER BY POST.SEND_DATE DESC) COMMENTS 
         ON POST.ID_POST = COMMENTS.ID_POST  
         LEFT JOIN POSTS_CATEGORY ON POST.ID_POST = POSTS_CATEGORY.ID_POST
         WHERE POSTS_CATEGORY.ID_CATEGORY = ? AND POST.TITLE IS NOT NULL
         GROUP BY POST.ID_POST,POST.SEND_DATE
         ORDER BY POST.SEND_DATE DESC';

    private const POSTBYSEARCH_QUERY =
        'SELECT POST.*,count(LIKED_POST) LIKE_NUMBER, COMMENTS.COMMENT_NUMBER
         FROM POST
         LEFT JOIN LIKE_TABLE ON POST.ID_POST = LIKE_TABLE.LIKED_POST
	 	 JOIN 
         (SELECT POST.ID_POST,count(COMMENTS.PARENT_ID) COMMENT_NUMBER
         FROM POST
         LEFT JOIN POST COMMENTS ON POST.ID_POST = COMMENTS.PARENT_ID
         GROUP BY POST.ID_POST,POST.SEND_DATE
         ORDER BY POST.SEND_DATE DESC) COMMENTS 
         ON POST.ID_POST = COMMENTS.ID_POST
         WHERE POST.TITLE LIKE ? OR POST.TEXT_CONTENT LIKE ? AND POST.TITLE IS NOT NULL
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
        $tableResPost = _assets\includes\Database::getInstance()->prepare(self::COMMENTSBYID_QUERY);
        try {
            $tableResPost->execute([$ID_POST]);
            $categories = [];
            $comments = $tableResPost->fetchAll();
            foreach ($comments as $comment) {
                array_push($listComments, new Post($comment, $categories));
            }
            return $listComments;
        } catch (PDOException $exception){
            return false;
        }
    }

    /**
     * @param int $ID_POST
     * @return \modules\blog\models\Post|null
     */
    public static function getPostById(int $ID_POST){
        $tableResPost = _assets\includes\Database::getInstance()->prepare(self::POSTBYID_QUERY);
        try {
            $tableResPost->execute([$ID_POST]);
            $post = $tableResPost->fetch();
            $categories = CategoryRepository::getCatOfPost($ID_POST);
            return new Post($post, $categories);
        } catch (PDOException $exception){
            return false;
        }
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
    public static function getListCommentOfUser(modules\blog\models\User $user){
        $listComment = [];
        $tableResComment = _assets\includes\Database::getInstance()->prepare(self::COMMENTBYUSER_QUERY);
        $tableResComment->execute([$user->getId()]);
        $res = $tableResComment->fetchAll();
        foreach ($res as $comment) {
            $categories = [];
            array_push($listComment,new Post($comment,$categories));
        }
        return $listComment;
    }

    public static function getPostsByCategory(int $ID_CATEGORY){
        $listPost = [];
        $tableResPost = _assets\includes\Database::getInstance()->prepare(self::POSTBYCATEGORY_QUERY);
        $tableResPost->execute([$ID_CATEGORY]);
        $res = $tableResPost->fetchAll();
        foreach ($res as $post) {
            $categories = CategoryRepository::getCatOfPost($post['ID_POST']);
            array_push($listPost,new Post($post,$categories));
        }
        return $listPost;
    }
    public static function getPostsBySearch(string $stringSearch){
        $StringForSql = '%' . $stringSearch . '%';
        $listPostAndComment = [];
        $tableResPost = _assets\includes\Database::getInstance()->prepare(self::POSTBYSEARCH_QUERY);
        $tableResPost->execute([$StringForSql, $StringForSql]);
        $res = $tableResPost->fetchAll();
        foreach ($res as $post){
            if ($post['PARENT_ID'] == null){
                $catOfPost = CategoryRepository::getCatOfPost($post['ID_POST']);
                array_push($listPostAndComment,new Post($post,$catOfPost));
            }
            else {
                $catComment = [];
                array_push($listPostAndComment,new Post($post, $catComment));
            }
        }
        return $listPostAndComment;
    }
}