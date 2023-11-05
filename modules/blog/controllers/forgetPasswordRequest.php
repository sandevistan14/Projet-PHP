<?php
    require '/home/yuta/www/_assets/includes/autoloader.php';

    if (\modules\blog\models\Authentification::forgotPasswordRequest($_POST['mail'])){
        header('Location : https://yuta.alwaysdata.net/');
        exit();
        echo 'siu';
    }