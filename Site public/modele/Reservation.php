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
    var $electricite;
    var $essence;
    var $vidange;
    var $idemplacement;

    /**
     * Reservation constructor.
     * @param $datedebut
     * @param $datefin
     * @param $idclient
     * @param $idbateau
     * @param $electricite
     * @param $essence
     * @param $vidange
     * @param $idemplacement
     */
    public function __construct($datedebut, $datefin, $idclient, $idbateau, $electricite, $essence, $vidange, $idemplacement)
    {
        $this->datedebut = $datedebut;
        $this->datefin = $datefin;
        $this->idclient = $idclient;
        $this->idbateau = $idbateau;
        $this->electricite = $electricite;
        $this->essence = $essence;
        $this->vidange = $vidange;
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
    public function getIdreservation()
    {
        return $this->idreservation;
    }

    /**
     * @return mixed
     */
    public function getDatedebut()
    {
        return $this->datedebut;
    }

    /**
     * @return mixed
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * @return mixed
     */
    public function getIdclient()
    {
        return $this->idclient;
    }

    /**
     * @return mixed
     */
    public function getIdemplacement()
    {
        return $this->idemplacement;
    }

    /**
     * @return mixed
     */
    public function getElectricite()
    {
        return $this->electricite;
    }

    /**
     * @return mixed
     */
    public function getEssence()
    {
        return $this->essence;
    }

    /**
     * @return mixed
     */
    public function getVidange()
    {
        return $this->vidange;
    }




}