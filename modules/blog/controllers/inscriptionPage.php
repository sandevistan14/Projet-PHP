<?php

namespace modules\blog\controllers;

require '/home/yuta/www/modules/blog/views/inscriptionPage.php';

class InscriptionPage
{
    public function execute($inscription_error): void
    {
        (new \modules\blog\views\InscriptionPage($inscription_error))->show();
    }
}