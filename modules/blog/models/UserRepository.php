<?php


require '/home/yuta/www/_assets/includes/autoloader.php';

use _assets\includes\Database;
use modules\blog\models\User;

class UserRepository
{
    private const USER_BY_ID_QUERY = "SELECT * FROM YUTA_USER WHERE ID_USER = ?";
    private const USER_BY_MAIL_QUERY = "SELECT * FROM YUTA_USER WHERE MAIL_ADDRESS = ?";

    private const USER_BY_IDENT_QUERY = "SELECT * FROM YUTA_USER WHERE USERNAME = ? OR MAIL_ADDRESS = ?";

    private const USER_BY_SEARCH_QUERY = "SELECT * FROM `YUTA_USER` WHERE USERNAME LIKE ?";

    public static function getUserById(int $ID_USER){
        $tableResUser = Database::getInstance()->prepare(self::USER_BY_ID_QUERY);
        $tableResUser->execute([$ID_USER]);
        if($tableResUser->rowCount() === 1) {
            $resUser = $tableResUser->fetch();
            return new User($resUser);
        } else
            return false;
    }

    public static function getUserByMail(string $mail){
        $tableResUser = Database::getInstance()->prepare(self::USER_BY_MAIL_QUERY);
        $tableResUser->execute([$mail]);
        if($tableResUser->rowCount() === 1) {
            $resUser = $tableResUser->fetch();
            return new User($resUser);
        } else
            return false;
    }

    public static function getUserByIdent(string $ident){
        $tableResUser = Database::getInstance()->prepare(self::USER_BY_IDENT_QUERY);
        $tableResUser->execute([$ident,$ident]);
        if($tableResUser->rowCount() === 1) {
            $resUser = $tableResUser->fetch();
            return new User($resUser);
        } else
            return false;
    }

    public static function getUserBySearch(string $stringSearch){
        $StringForSql = '%' . $stringSearch . '%';
        $listUser = [];
        $tableResUser = Database::getInstance()->prepare(self::USER_BY_SEARCH_QUERY);
        $tableResUser->execute([$StringForSql]);
        $res = $tableResUser->fetchAll();
        foreach ($res as $User){
            array_push($listUser,new User($User));
        }
        return $listUser;
    }
}