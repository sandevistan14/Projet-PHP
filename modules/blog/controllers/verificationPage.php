<?php

namespace modules\blog\controllers;

require '/home/yuta/www/modules/blog/views/verificationPage.php';

class VerificationPage
{
    public function execute($user,$verification_error): void
    {
        (new \modules\blog\views\VerificationPage($user,$verification_error))->show();
    }
}