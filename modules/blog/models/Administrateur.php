<?php

namespace modules\blog\models;

require '/home/yuta/www/_assets/includes/autoloader.php';

class Administrateur extends User
{
    private int $Id;
    private string $LastConnection;
    private string $FirstConnection;

    public function __construct($UsName)
    {
        parent::__construct($UsName);
        if (is_null(User::$LastId)){
            User::$LastId = 0;
        }
        $this->Id = User::$LastId + 1;
        User::$LastId +=1;
        date_default_timezone_set('Europe/Paris');
        $this->FirstConnection = date("d/m/Y H:i:s");
        $this->LastConnection = $this->FirstConnection;
    }

    public function DeletePost($Billet): void {}
}