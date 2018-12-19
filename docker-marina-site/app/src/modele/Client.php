<?php
class Client{
    var $idclient;
    var $nom;
    var $prenom;
    var $boolGerant;
    var $motDePasse;
    var $mail;
    var $numero;


    /**
     * Client constructor.
     * @param $idclient
     * @param $nom
     * @param $prenom
     * @param $idbateau
     * @param $bool_gerant
     */
    public function __construct( $nom, $prenom, $motDePasse, $mail, $numero,$boolGerant)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->boolGerant = $boolGerant;
        $this->motDePasse = $motDePasse;
        $this->mail = $mail;
        $this->numero = $numero;
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

    /**
     * @return mixed
     */
    public function getBoolGerant()
    {
        return $this->boolGerant;
    }

    /**
     * @param mixed $boolGerant
     */
    public function setBoolGerant($boolGerant)
    {
        $this->boolGerant = $boolGerant;
    }

    /**
     * @return mixed
     */
    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    /**
     * @param mixed $motDePasse
     */
    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }


}