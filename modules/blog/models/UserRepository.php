<?php


require '/home/yuta/www/_assets/includes/autoloader.php';

use _assets\includes\Database;
use modules\blog\models\User;

class UserRepository
{
    private const USER_BY_ID_QUERY = "SELECT * FROM YUTA_USER WHERE ID_USER = ?";

    public static function getUserById(int $ID_USER){
        $tableResUser = Database::getInstance()->prepare(self::USER_BY_ID_QUERY);
        $tableResUser->execute([$ID_USER]);
        $resUser = $tableResUser->fetch();
        return new User($resUser);
    }
}