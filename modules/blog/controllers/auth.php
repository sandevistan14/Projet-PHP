<?php
require '../../../_assets/includes/autoloader.php';

use modules\blog\models\Authentification;

class Auth{
    public function execute()
    {
        session_start();
        if ($connection = Authentification::connect($_POST['ident'], $_POST['password'])) {
            $_SESSION['currentUser'] = $connection;
            if ($_SESSION['currentUser']->isActive()) {
                header('Location: https://yuta.alwaysdata.net/');
                exit();
            } else {
                header('Location: https://yuta.alwaysdata.net/?needs_verification=1');
                exit();
            }
        } else {
            header('Location: https://yuta.alwaysdata.net/?connection_error=1');
            exit();
        }
    }
}
(new Auth())->execute();
