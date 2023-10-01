<?php

namespace Obj;

use Obj\Utilisateur;

class Administrateur extends Utilisateur
{
    private int $Id;
    private string $LastConnection;
    private string $FirstConnection;

    public function __construct($UsName)
    {
        parent::__construct($UsName);
        if (is_null(Utilisateur::$LastId)){
            Utilisateur::$LastId = 0;
        }
        $this->Id = Utilisateur::$LastId + 1;
        Utilisateur::$LastId +=1;
        date_default_timezone_set('Europe/Paris');
        $this->FirstConnection = date("d/m/Y H:i:s");
        $this->LastConnection = $this->FirstConnection;
    }

    public function DeletePost($Billet): void {}
}