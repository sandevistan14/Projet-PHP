<?php

namespace modules\blog\models;

use _assets\includes\Database;

require '/home/yuta/www/_assets/includes/autoloader.php';

class Administrator extends User
{

    /**
     * @param $user_data
     */
    public function __construct($user_data)
    {
        parent::__construct($user_data);

    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return true;
    }

    public function createCategory($name,$description){
        $query = 'INSERT INTO CATEGORY (CATEGORY_NAME, CATEGORY_DESCRIPTION) VALUES (?, ?)';
        $request = Database::getInstance()->prepare($query);
        try {
            $request->execute([$name, $description]);
            return true;
        }
        catch (\PDOException $exception){
            return false;
        }
    }
    public function ModifyCategoryName(int $IdCat,string $NewNameCat){
        $query = 'UPDATE CATEGORY SET CATEGORY_NAME = ? WHERE ID_CATEGORY = ?';
        $request = Database::getInstance()->prepare($query);
        $request->execute([$NewNameCat, $IdCat]);
    }

    public function ModifyCategoryDescription(int $IdCat,string $NewDescCat){
        $query = 'UPDATE CATEGORY SET CATEGORY_DESCRIPTION = ? WHERE ID_CATEGORY = ?';
        $request = Database::getInstance()->prepare($query);
        $request->execute([$NewDescCat, $IdCat]);
    }

    /**
     * @param $Post
     * @return void
     */
    public function DeletePost($Post): void {
        $IdPost = $Post->getIdPost();
        $query = 'DELETE FROM POSTS_CATEGORY WHERE ID_POST=?';
        $request = Database::getInstance()->prepare($query);
        $request->execute([$IdPost]);
        $query = 'DELETE FROM LIKE_TABLE WHERE LIKED_POST=?';
        $request = Database::getInstance()->prepare($query);
        $request->execute([$IdPost]);
        $query = 'UPDATE POST SET PARENT_ID = NULL WHERE PARENT_ID = ?';
        $request = Database::getInstance()->prepare($query);
        $request->execute([$IdPost]);
        $query = 'DELETE FROM POST WHERE ID_POST=?';
        $request = Database::getInstance()->prepare($query);
        $request->execute([$IdPost]);
    }
    /**
     * @param $User
     * @return void
     */
    public function DeleteUser($User): void {
        $IdUser = $User->getId();
        $query = 'DELETE FROM POSTS_CATEGORY WHERE ID_POST IN (SELECT ID_POST FROM POST WHERE ID_AUTHOR = ?)';
        $request = Database::getInstance()->prepare($query);
        $request->execute([$IdUser]);
        $query = 'UPDATE POST SET PARENT_ID = NULL WHERE PARENT_ID IN (SELECT ID_POST FROM POST WHERE ID_AUTHOR = ?)';
        $request = Database::getInstance()->prepare($query);
        $request->execute([$IdUser]);
        $query = 'DELETE FROM LIKE_TABLE WHERE USER_ID=?';
        $request = Database::getInstance()->prepare($query);
        $request->execute([$IdUser]);
        $query = 'DELETE FROM POST WHERE ID_AUTHOR=?';
        $request = Database::getInstance()->prepare($query);
        $request->execute([$IdUser]);
        $query = 'DELETE FROM YUTA_USER WHERE ID_USER=?';
        $request = Database::getInstance()->prepare($query);
        $request->execute([$IdUser]);
    }
}