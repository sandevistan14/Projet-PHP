<?php
    require '/home/yuta/www/_assets/utils/class/Database.php';

    $username = $_POST['ident'];
    $query =  'SELECT * FROM YUTA_USER where USERNAME = ? or MAIL_ADDRESS = ?';
    $request = Database::getInstance()->prepare($query);
    $request->execute([$username,$username]);
    if ($request->rowCount() != 0) {
        $user_data = $request->fetch();
        if (password_verify($_POST['password'], $user_data['PASSWORD'])) {
            session_start();
            $_SESSION['username'] = $user_data['USERNAME'];
        }
    }
    else {
//        header('Location: http://www.google.com/');
    }
