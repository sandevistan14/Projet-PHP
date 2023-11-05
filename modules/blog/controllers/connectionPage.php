<?php
namespace modules\blog\controllers;

require '/home/yuta/www/modules/blog/views/connectionPage.php';

class ConnectionPage
{
    public function execute($connection_error): void
    {
        (new \modules\blog\views\ConnectionPage($connection_error))->show();
    }
}