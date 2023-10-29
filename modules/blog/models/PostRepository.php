<?php

require '/home/yuta/www/_assets/includes/autoloader.php';
class PostRepository
{
    public static function getPost(){
        $listPost = [];
        $reqPost = 'SELECT * FROM POST ORDER BY SEND_DATE DESC';
        $tableResPost = _assets\includes\Database::getInstance()->query($reqPost);
        $res = $tableResPost->fetchAll();
        for ($i = 0; $i < count($res); $i = $i+1){
            $idPost = $res[$i]['ID_POST'];
            $titlePost = $res[$i]['TITLE'];
            $msgPost = $res[$i]['TEXT_CONTENT'];
            $sendDate = $res[$i]['SEND_DATE'];
            $editDate = $res[$i]['LAST_EDIT_DATE'];
            if ($res[$i]['ATTACHED_PICTURE'] != null){
                $imgPost = $res[$i]['ATTACHED_PICTURE'];
            }
            else {
                $imgPost = '';
            }
            $authorId = $res[$i]['ID_AUTHOR'];
            $reqUser = 'SELECT * FROM YUTA_USER WHERE ID_USER= ?';
            $tableResUser = _assets\includes\Database::getInstance()->prepare($reqUser);
            $tableResUser->execute([$authorId]);
            $resUser = $tableResUser->fetch();
            $tmpUser = new modules\blog\models\User($resUser);
            $tmpPost = new modules\blog\models\Post($idPost, $tmpUser, $titlePost, $msgPost, $imgPost, $sendDate, $editDate);
            array_push($listPost, $tmpPost);
        }
        return $listPost;
    }
}