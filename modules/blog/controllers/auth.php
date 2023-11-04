<?php


require '../../../_assets/includes/autoloader.php';

use modules\blog\models\Authentification;

session_start();
    $connection = Authentification::connect($_POST['ident'],$_POST['password']);
    if ($connection){
        $_SESSION['currentUser'] = $connection;
        if ($_SESSION['currentUser']->isActive()) {
            header('Location: ../views/homePage.php');
            exit();
        }
        else {
            header('Location: ../views/verificationPage.php?connection_error=1');
            exit();
        }
    }
    else{
        header('Location: ../views/connectionPage.php?connection_error=1');
        exit();
    }