<?php

class Service
{
    var $idservice;
    var $contientessence;
    var $contientelectricite;
    var $contientvidange;

    /**
     * Service constructor.
     * @param $contientessence
     * @param $contientelectricite
     * @param $contientvidange
     */
    public function __construct($contientessence, $contientelectricite, $contientvidange)
    {
        $this->contientessence = (bool)$contientessence;
        $this->contientelectricite = (bool)$contientelectricite;
        $this->contientvidange = (bool)$contientvidange;
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
        return (int)$this->contientessence;
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
        return (int)$this->contientelectricite;
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
        return (int)$this->contientvidange;
    }

    /**
     * @param mixed $contientvidange
     */
    public function setContientvidange($contientvidange)
    {
        $this->contientvidange = $contientvidange;
    }
}