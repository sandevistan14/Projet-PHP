<?php

namespace Obj;

class Category
{
    private int $IdCat;
    private string $Libelle;

    public function __construct(string $nom){
        $this->Libelle = $nom;
    }
}