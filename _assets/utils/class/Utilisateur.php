<?php

namespace Obj;

class Utilisateur
{
    public static int $LastId;
    private int $Id;
    private string $UserName;
    private string $FirstConnection;
    private string $LastConnection;

    function __construct($UsName){
        if (is_null(Utilisateur::$LastId)){
            Utilisateur::$LastId = 0;
        }
        $this->UserName = $UsName;
        $this->Id = Utilisateur::$LastId + 1;
        Utilisateur::$LastId +=1;
        date_default_timezone_set('Europe/Paris');
        $this->FirstConnection = date("d/m/Y H:i:s");
        $this->LastConnection = $this->FirstConnection;
    }

    public function CreatePost(string $title, string $msg): void{}

    public function CreateComment($msg, $billet) : void{}
}