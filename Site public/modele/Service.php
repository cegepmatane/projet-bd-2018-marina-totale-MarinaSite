<?php

class Service{
    var $idservice;
    var $contientessence;
    var $contientelectricite;
    var $contientvidange;
    var $idreservation;
    var $idemplacement;

    /**
     * Service constructor.
     * @param $idservice
     * @param $contientessence
     * @param $contientelectricite
     * @param $contientvidange
     * @param $idreservation
     * @param $idemplacement
     */
    public function __construct($idservice, $contientessence, $contientelectricite, $contientvidange, $idreservation, $idemplacement)
    {
        $this->idservice = $idservice;
        $this->contientessence = $contientessence;
        $this->contientelectricite = $contientelectricite;
        $this->contientvidange = $contientvidange;
        $this->idreservation = $idreservation;
        $this->idemplacement = $idemplacement;
    }

    /**
     * @return mixed
     */
    public function getIdservice()
    {
        return $this->idservice;
    }

    /**
     * @param mixed $idservice
     */
    public function setIdservice($idservice)
    {
        $this->idservice = $idservice;
    }

    /**
     * @return mixed
     */
    public function getContientessence()
    {
        return $this->contientessence;
    }

    /**
     * @param mixed $contientessence
     */
    public function setContientessence($contientessence)
    {
        $this->contientessence = $contientessence;
    }

    /**
     * @return mixed
     */
    public function getContientelectricite()
    {
        return $this->contientelectricite;
    }

    /**
     * @param mixed $contientelectricite
     */
    public function setContientelectricite($contientelectricite)
    {
        $this->contientelectricite = $contientelectricite;
    }

    /**
     * @return mixed
     */
    public function getContientvidange()
    {
        return $this->contientvidange;
    }

    /**
     * @param mixed $contientvidange
     */
    public function setContientvidange($contientvidange)
    {
        $this->contientvidange = $contientvidange;
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

    
}