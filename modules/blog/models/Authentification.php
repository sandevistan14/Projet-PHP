<?php

namespace modules\blog\models;

require '../../../_assets/includes/autoloader.php';

use _assets\includes\Database;
use PDOException;

class Authentification
{
    /**
     * @param $ident
     * @param $pwd
     * @return false|Administrator|User
     */
    public static function connect($ident, $pwd){
        $query =  'SELECT * FROM YUTA_USER where USERNAME = ? or MAIL_ADDRESS = ?';
        $request =  Database::getInstance()->prepare($query);
        $request->execute([$ident,$ident]);
        if ($request->rowCount() != 0) {
            $user_data = $request->fetch();
            if (password_verify($pwd, $user_data['PASSWORD'])) {
                $query = 'UPDATE YUTA_USER SET LAST_LOGIN = current_timestamp WHERE ID_USER = ?';
                $request = Database::getInstance()->prepare($query);
                $request->execute([$user_data['ID_USER']]);
                if ($user_data['ADMIN_STATUS'])
                    return new Administrator($user_data);
                else
                    return new User($user_data);
            }
        }
        return false;
    }

    /**
     * @param $username
     * @param $mail
     * @param $pwd
     * @return false|User
     */
    public static function register($username, $mail, $pwd){
        $query = 'INSERT INTO YUTA_USER (ADMIN_STATUS, MAIL_ADDRESS, USERNAME, PASSWORD, FIRST_LOGIN, LAST_LOGIN, ACTIVE, VERIFICATION_CODE,VERIF_CODE_SEND_DATE) VALUES
    (0,?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,0,?,CURRENT_TIMESTAMP)';
        $request = Database::getInstance()->prepare($query);
        try {
            $verif_code = rand(10000,99999);
            $request->execute([$mail,$username,password_hash($pwd,PASSWORD_BCRYPT),$verif_code]);
            $result = Database::getInstance()->query('SELECT * FROM YUTA_USER WHERE ID_USER=LAST_INSERT_ID()');
            $user_data = $result->fetch();
            return new User($user_data);
        }
        catch(PDOException $Exception ) {
            return false;
        }
    }

    /**
     * @param $user
     * @param $code
     * @return bool
     */
    public static function verifUser($user, $code){
        $query = 'SELECT VERIFICATION_CODE FROM YUTA_USER WHERE ID_USER = ? AND VERIFICATION_CODE = ?';
        $request = Database::getInstance()->prepare($query);
        $request->execute([$user->getId(),$code]);
        if ($request->rowCount() != 0) {
            $update_query = 'UPDATE YUTA_USER SET ACTIVE = 1 WHERE ID_USER = ?';
            $request = Database::getInstance()->prepare($update_query);
            $request->execute([$user->getId()]);
            $_SESSION['currentUser']->setActive(true);
            return true;
        }
        else{
            return false;
        }
    }

    public static function resendNewCode($user){
        $oldVerifCode = $user->getVerificationCode();
        $newVerifCode = rand(10000,99999);
        $user->setVerificationCode($newVerifCode);
        if($user->sendVerificationCode()){
            $query = 'UPDATE YUTA_USER SET VERIFICATION_CODE = ?,VERIF_CODE_SEND_DATE=CURRENT_TIMESTAMP WHERE ID_USER=?';
            $request = Database::getInstance()->prepare($query);
            $request->execute([$newVerifCode,$user->getId()]);
            return true;
        }
        else
            $user->setVerificationCode($oldVerifCode);
        return false;
    }
}