<?php

namespace _assets\includes;

require '/home/yuta/www/_assets/includes/autoloader.php';

use modules\blog\models\Authentification;

session_start();
    $registration = Authentification::register($_POST['username'],$_POST['email'],$_POST['password']);
    if ($registration){
        $_SESSION['currentUser'] = $registration;
        $_SESSION['currentUser']->sendVerificationCode();
        header('Location: https://yuta.alwaysdata.net/');
    }
    else {
        header('Location: https://yuta.alwaysdata.net/?inscription_error=1');
    }