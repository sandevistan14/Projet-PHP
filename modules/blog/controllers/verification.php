<?php

require '/home/yuta/www/_assets/includes/autoloader.php';

use modules\blog\models\Authentification;

class Verification
{
    public function execute()
    {
        session_start();
        if (isset($_GET['resend'])) {
            $resend = Authentification::resendNewCode($_SESSION['currentUser']);
            if ($resend) {
                header('Location: https://yuta.alwaysdata.net/?verification_resend=1');
                exit();
            } else {
                header('Location: https://yuta.alwaysdata.net/?verification_resend=0');
                exit();
            }
        } else {
            $code_received = $_POST['1'] . $_POST['2'] . $_POST['3'] . $_POST['4'] . $_POST['5'];
            $verification = Authentification::verifUser($_SESSION['currentUser'], $code_received);
            if ($verification) {
                header('Location: https://yuta.alwaysdata.net/');
                exit();
            } else {
                header('Location: ../views/verificationPage.php?verification_error=1');
                exit();
            }
        }
    }
}
(new Verification())->execute();
