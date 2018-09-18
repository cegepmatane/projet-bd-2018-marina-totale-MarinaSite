<?php
class Client{
    var $idclient;
    var $nom;
    var $prenom;
    var $idbateau;

    /**
     * Client constructor.
     * @param $idclient
     * @param $nom
     * @param $prenom
     * @param $idbateau
     */
    public function __construct($idclient, $nom, $prenom, $idbateau)
    {
        $this->idclient = $idclient;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->idbateau = $idbateau;
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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getIdbateau()
    {
        return $this->idbateau;
    }

    /**
     * @param mixed $idbateau
     */
    public function setIdbateau($idbateau)
    {
        $this->idbateau = $idbateau;
    }


}