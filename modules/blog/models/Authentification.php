<?php

namespace modules\blog\models;

require '../../../_assets/includes/autoloader.php';
include_once '/home/yuta/www/modules/blog/models/UserRepository.php';

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
            else {
                $query = 'SELECT * FROM TEMP_PWD_USERS WHERE ID_USER = ? AND EXPIRATION_DATE > CURRENT_TIMESTAMP';
                $request = Database::getInstance()->prepare($query);
                $request->execute([$user_data['ID_USER']]);
                if ($request->rowcount() != 0){
                    $tmp_data = $request->fetch();
                    if(password_verify($pwd,$tmp_data['CODE'])) {
                        $query = 'UPDATE YUTA_USER SET PASSWORD = ? WHERE ID_USER = ?';
                        $request = Database::getInstance()->prepare($query);
                        $request->execute([$tmp_data['CODE'], $user_data['ID_USER']]);
                        if ($user_data['ADMIN_STATUS'])
                            return new Administrator($user_data);
                        else
                            return new User($user_data);
                    }
                }
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
    public static function verifUser(User $user, $code){
        $query = 'SELECT VERIFICATION_CODE FROM YUTA_USER WHERE ID_USER = ? AND VERIFICATION_CODE = ?';
        $request = Database::getInstance()->prepare($query);
        $request->execute([$user->getId(),$code]);
        if ($request->rowCount() != 0) {
            $update_query = 'UPDATE YUTA_USER SET ACTIVE = 1 WHERE ID_USER = ?';
            $request = Database::getInstance()->prepare($update_query);
            $request->execute([$user->getId()]);
            $user->setActive(true);
            return true;
        }
        else{
            return false;
        }
    }

    public static function resendNewCode(User $user){
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

    public static function forgotPasswordRequest(string $mail){
        if($user = \UserRepository::getUserByMail($mail)){
            $tmp_pwd = bin2hex(random_bytes(5));
            $query = 'INSERT INTO TEMP_PWD_USERS (ID_USER,CODE,EXPIRATION_DATE) VALUES (?,?, ADDTIME(CURRENT_TIMESTAMP,\'0 1:0:0\'))';
            $request = Database::getInstance()->prepare($query);
            try {
                $request->execute([$user->getId(),password_hash($tmp_pwd,PASSWORD_BCRYPT)]);
            } catch(PDOException $exception) {
                $query = 'UPDATE TEMP_PWD_USERS SET CODE = ?,EXPIRATION_DATE = ADDTIME(CURRENT_TIMESTAMP,\'0 1:0:0\') WHERE ID_USER = ?';
                $request = Database::getInstance()->prepare($query);
                $request->execute([password_hash($tmp_pwd,PASSWORD_BCRYPT), $user->getId()]);
            }
            $user->sendForgetPasswordCode($tmp_pwd);
            return true;
        }
        else
            return false;
    }
}