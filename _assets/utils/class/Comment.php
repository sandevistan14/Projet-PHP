<?php

namespace Obj;

class Comment
{
    private int $IdComment;
    private Utilisateur $Autor;
    private $BilletDeRef;
    private $Date;
    private string $Text;

    public function __construct(int $Idcomment, Utilisateur $autor, $Billetderef, string $text){
        $this->IdComment = $Idcomment;
        $this->Autor = $autor;
        $this->BilletDeRef = $Billetderef;
        $this->Text = $text;
        date_default_timezone_set('Europe/Paris');
        $this->Date = date("d/m/Y H:i:s");
    }
}