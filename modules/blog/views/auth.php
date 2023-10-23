<?php

namespace utils\class;

require '../../../_assets/includes/autoloader.php';

session_start();
    $username = $_POST['ident'];
    $query =  'SELECT * FROM YUTA_USER where USERNAME = ? or MAIL_ADDRESS = ?';
    $request = Database::getInstance()->prepare($query);
    $request->execute([$username,$username]);
    if ($request->rowCount() != 0) {
        $user_data = $request->fetch();
        if (password_verify($_POST['password'], $user_data['PASSWORD'])) {
            $_SESSION['currentUser'] = new User($user_data['ID_USER'],$user_data['ADMIN_STATUS'],
                $user_data['MAIL_ADDRESS'],$user_data['USERNAME'],$user_data['PASSWORD'],$user_data['PROFILE_PICTURE'],
                $user_data['FIRST_LOGIN'],$user_data['LAST_LOGIN']);
            header('Location: homePage.php');
        }
    }
    else {
        header('Location: connectionPage.php');
        exit();
    }
