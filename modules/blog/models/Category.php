<?php

namespace modules\blog\models;
class Category
{
    /**
     * @var int
     */
    private int $IdCat;
    /**
     * @var string
     */
    private string $Libelle;
    /**
     * @var string
     */
    private string $Description;

    /**
     * @param int $IdCat
     * @param string $nom
     * @param string $desc
     */
    public function __construct(int $IdCat, string $nom, string $desc){
        $this->IdCat = $IdCat;
        $this->Libelle = $nom;
        $this->Description = $desc;
    }

    /**
     * @return int
     */
    public function getIdCat(): int
    {
        return $this->IdCat;
    }

    /**
     * @param int $IdCat
     * @return void
     */
    public function setIdCat(int $IdCat): void
    {
        $this->IdCat = $IdCat;
    }

    /**
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->Libelle;
    }

    /**
     * @param string $Libelle
     * @return void
     */
    public function setLibelle(string $Libelle): void
    {
        $this->Libelle = $Libelle;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->Description;
    }

    /**
     * @param string $Description
     * @return void
     */
    public function setDescription(string $Description): void
    {
        $this->Description = $Description;
    }
}