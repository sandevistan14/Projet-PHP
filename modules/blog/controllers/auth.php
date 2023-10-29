<?php


require '../../../_assets/includes/autoloader.php';

session_start();
    var_dump($_SESSION);
    $username = $_POST['ident'];
    $query =  'SELECT * FROM YUTA_USER where USERNAME = ? or MAIL_ADDRESS = ?';
    $request =  _assets\includes\Database::getInstance()->prepare($query);
    $request->execute([$username,$username]);
    if ($request->rowCount() != 0) {
        $user_data = $request->fetch();
        if (password_verify($_POST['password'], $user_data['PASSWORD'])) {
            $query = 'UPDATE YUTA_USER SET LAST_LOGIN = current_timestamp WHERE ID_USER = ?';
            $request =  _assets\includes\Database::getInstance()->prepare($query);
            $request->execute([$user_data['ID_USER']]);
            if($user_data['ADMIN_STATUS'])
                $_SESSION['currentUser'] = new modules\blog\models\Administrator($user_data);
            else
                $_SESSION['currentUser'] = new modules\blog\models\User($user_data);
            if ($_SESSION['currentUser']->isActive()) {
                header('Location: ../views/homePage.php');
                exit();
            }
            else {
                $_SESSION['connection_error'] = true;
                header('Location: ../views/verificationPage.php');
                exit();
            }
        }
    }
    else {
        $_SESSION['connection_error'] = true;
        header('Location: ../views/connectionPage.php');
        exit();
    }
