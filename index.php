<?php
require '/home/yuta/www/_assets/includes/autoloader.php';
require_once 'modules/blog/controllers/homePage.php';
require_once 'modules/blog/controllers/connectionPage.php';
require_once 'modules/blog/controllers/inscriptionPage.php';
require_once 'modules/blog/controllers/verificationPage.php';
require_once 'modules/blog/controllers/profilPage.php';
require_once 'modules/blog/controllers/postFocus.php';

session_start();
if (isset($_SESSION['currentUser'])){
    if($_SESSION['currentUser']->isActive())
        if(isset($_GET['id_user_profil'])){
            (new \modules\blog\controllers\ProfilPage())->execute($_SESSION['currentUser'],$_GET['id_user_profil']);
        }
        elseif(isset($_GET['id_Post'])){
            (new \modules\blog\controllers\postFocus())->execute($_GET['id_Post'],$_SESSION['currentUser']);
        }
        else {
            (new \modules\blog\controllers\Homepage())->execute($_SESSION['currentUser']);
        }
    else{
        if(isset($_GET['verification_error'])) {
            (new \modules\blog\controllers\VerificationPage())->execute($_SESSION['currentUser'],true);
        } else {
            (new \modules\blog\controllers\VerificationPage())->execute($_SESSION['currentUser'],false);
        }
    }
} else {
    if(isset($_GET['needs_inscription'])){
        if(isset($_GET['inscription_error'])) {
            (new \modules\blog\controllers\InscriptionPage())->execute(true);
        }else{
            (new \modules\blog\controllers\InscriptionPage())->execute(false);
        }
    }
    else {
        if (isset($_GET['connection_error'])) {
            (new \modules\blog\controllers\ConnectionPage())->execute(true);
        } else {
            (new \modules\blog\controllers\ConnectionPage())->execute(false);
        }
    }
}




