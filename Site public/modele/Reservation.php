<?php
/**
 * Created by PhpStorm.
 * User: 1832527
 * Date: 18/09/2018
 * Time: 16:10
 */

class Reservation{

    var $idreservation;
    var $datedebut;
    var $datefin;
    var $idclient;
    var $idbateau;
    var $idservice;
    var $idemplacement;

    /**
     * Reservation constructor.
     */
    public function __construct($datedebut, $datefin, $idclient,$idbateau,$idservice,$idemplacement)
    {
        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
        $this->idclient = $idclient;
        $this->idbateau = $idbateau;
        $this->idservice = $idservice;
        $this->idemplacement = $idemplacement;
    }

    /**
     * @return mixed
     */
    public function getIdbateau()
    {
        return $this->idbateau;
    }

    /**
     * @return mixed
     */
    public function getIdservice()
    {
        return $this->idservice;
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
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * @param mixed $datedebut
     */
    public function setDatedebut($datedebut)
    {
        $this->datedebut = $datedebut;
    }

    /**
     * @return mixed
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * @param mixed $datefin
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;
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
    public function getIdemplacement()
    {
        return $this->idemplacement;
    }




}