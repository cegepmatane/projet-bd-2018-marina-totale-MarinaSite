<?php

class Emplacement{

    var $id;
    var $longueur;
    var $largeur;
    var $label;

    /**
     * Emplacement constructor.
     * @param $id
     * @param $longueur
     * @param $largeur
     * @param $label
     */
    public function __construct($longueur, $largeur, $label)
    {
        $this->longueur = $longueur;
        $this->largeur = $largeur;
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLongueur()
    {
        return $this->longueur;
    }

    /**
     * @param mixed $longueur
     */
    public function setLongueur($longueur)
    {
        $this->longueur = $longueur;
    }

    /**
     * @return mixed
     */
    public function getLargeur()
    {
        return $this->largeur;
    }

    /**
     * @param mixed $largeur
     */
    public function setLargeur($largeur)
    {
        $this->largeur = $largeur;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }




}