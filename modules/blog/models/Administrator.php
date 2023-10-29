<?php

namespace modules\blog\models;

require '/home/yuta/www/_assets/includes/autoloader.php';

class Administrator extends User
{
    public function __construct($user_data)
    {
        parent::__construct($user_data);

    }

    public function DeletePost($Billet): void {}
}