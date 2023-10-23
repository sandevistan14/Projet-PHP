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
                $user_data['FIRST_LOGIN'],date('Y-m-d H:i:s'),$user_data['ACTIVE'],$user_data['VERIFICATION_CODE']);
            $query = 'UPDATE YUTA_USER SET LAST_LOGIN = ? WHERE ID_USER = ?';
            $request = Database::getInstance()->prepare($query);
            $request->execute([$_SESSION['currentUser']->getLastLogin()->format('Y-m-d H:i:s'),
                               $_SESSION['currentUser']->getId()]);
            if ($_SESSION['currentUser']->isActive()) {
                header('Location: ../views/homePage.php');
                exit();
            }
            else {
                $_SESSION['connection_error'] = true;
                echo 'utilisateur non vérifié haha';
            }
        }
    }
    else {
        $_SESSION['connection_error'] = true;
        header('Location: ../views/connectionPage.php');
        exit();
    }
