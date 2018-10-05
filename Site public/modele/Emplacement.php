<?php

class Emplacement{
    
    var $longueur;
    var $largeur;
    var $estdisponible;

    /**
     * Emplacement constructor.
     * @param $idemplacement
     * @param $idclient
     * @param $idreservation
     * @param $longueur
     * @param $largeur
     * @param $estdisponible
     */
    public function __construct($idemplacement, $idclient, $idreservation, $longueur, $largeur, $estdisponible)
    {
        $this->idemplacement = $idemplacement;
        $this->idclient = $idclient;
        $this->idreservation = $idreservation;
        $this->longueur = $longueur;
        $this->largeur = $largeur;
        $this->estdisponible = $estdisponible;
    }

    /**
     * @return mixed
     */
    public function getIdemplacement()
    {
        return $this->idemplacement;
    }

    /**
     * @param mixed $idemplacement
     */
    public function setIdemplacement($idemplacement)
    {
        $this->idemplacement = $idemplacement;
    }

    /**
     * @return mixed
     */
    public function getIdclient()
    {
        return $this->idclient;
    }

    /**
     * @param mixed $idclient
     */
    public function setIdclient($idclient)
    {
        $this->idclient = $idclient;
    }

    /**
     * @return mixed
     */
    public function getIdreservation()
    {
        return $this->idreservation;
    }

    /**
     * @param mixed $idreservation
     */
    public function setIdreservation($idreservation)
    {
        $this->idreservation = $idreservation;
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
    public function getEstdisponible()
    {
        return $this->estdisponible;
    }

    /**
     * @param mixed $estdisponible
     */
    public function setEstdisponible($estdisponible)
    {
        $this->estdisponible = $estdisponible;
    }


}