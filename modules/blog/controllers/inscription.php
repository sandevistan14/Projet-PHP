<?php

namespace _assets\includes;

use modules\blog\models\User;
use PDOException;

require '/home/yuta/www/_assets/includes/autoloader.php';

session_start();
    $query = 'INSERT INTO YUTA_USER (ADMIN_STATUS, MAIL_ADDRESS, USERNAME, PASSWORD, FIRST_LOGIN, LAST_LOGIN, ACTIVE, VERIFICATION_CODE,VERIF_CODE_SEND_DATE) VALUES
    (0,?,?,?,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,0,?,CURRENT_TIMESTAMP)';
    $request = Database::getInstance()->prepare($query);
    try {
        $verif_code = rand(10000,99999);
        $request->execute([$_POST['email'],$_POST['username'],password_hash($_POST['password'],PASSWORD_BCRYPT),$verif_code]);
        $result = Database::getInstance()->query('SELECT * FROM YUTA_USER WHERE ID_USER=LAST_INSERT_ID()');
        $user_data = $result->fetch();
        $_SESSION['currentUser'] = new User($user_data);
        $_SESSION['currentUser']->sendVerificationCode();
        header('Location: ../views/verificationPage.php');
        exit();
    }
    catch(PDOException $Exception ) {
        $_SESSION['inscriptionError'] = true;
        header('Location: ../views/inscriptionPage.php');
    }