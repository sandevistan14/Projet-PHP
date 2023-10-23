<?php

namespace _assets\includes;

use PDOException;

require '/home/yuta/www/_assets/includes/autoloader.php';

session_start();
    $query = 'INSERT INTO YUTA_USER (ADMIN_STATUS, MAIL_ADDRESS, USERNAME, PASSWORD, PROFILE_PICTURE, FIRST_LOGIN, LAST_LOGIN, ACTIVE, VERIFICATION_CODE) VALUES
    (0,?,?,?,NULL,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,0,?)';
    $request = Database::getInstance()->prepare($query);
    try {
        $verif_code = rand(10000,99999);
        $request->execute([$_POST['email'],$_POST['username'],password_hash($_POST['password'],PASSWORD_BCRYPT),$verif_code]);
    }
    catch(PDOException $Exception ) {
        echo "ayaaaa";
        }
