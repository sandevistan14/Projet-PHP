<?php

namespace Obj;

class Post
{
    private int $IdPost;
    private Utilisateur $Autor;
    private $Date;
    private string $Title;
    private string $Text;

    public function __construct(int $ID, Utilisateur $autor, string $title, string $text){
        $this->IdPost = $ID;
        $this->Autor = $autor;
        $this->Text = $text;
        $this->Title = $title;
        date_default_timezone_set('Europe/Paris');
        $this->Date = date("d/m/Y H:i:s");
    }
}