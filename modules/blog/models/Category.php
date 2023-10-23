<?php

namespace modules\blog\models;
class Category
{
    private int $IdCat;
    private string $Libelle;

    public function __construct(string $nom){
        $this->Libelle = $nom;
    }
}