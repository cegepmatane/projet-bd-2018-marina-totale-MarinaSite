<?php
class Bateau{

    var $id_bateau;
    var $nom;
    var $type_bateau;
    var $id_client;
    var $longueur;
    var $largeur;

    /**
     * Bateau constructor.
     * @param $nom
     * @param $type_bateau
     * @param $longeur
     * @param $largeur
     */
    public function __construct($nom, $type_bateau, $longeur, $largeur)
    {
        $this->nom = $nom;
        $this->type_bateau = $type_bateau;
        $this->longueur = $longeur;
        $this->largeur = $largeur;
    }

    /**
     * @return mixed
     */
    public function getIdbateau()
    {
        return $this->id_bateau;
    }

    /**
     * @param mixed $idbateau
     */
    public function setIdbateau($idbateau)
    {
        $this->id_bateau = $idbateau;
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
    public function getTypeBateau()
    {
        return $this->type_bateau;
    }

    /**
     * @param mixed $type_bateau
     */
    public function setTypeBateau($type_bateau)
    {
        $this->type_bateau = $type_bateau;
    }



    /**
     * @return mixed
     */
    public function getIdClient()
    {
        return $this->id_client;
    }

    /**
     * @param mixed $id_client
     */
    public function setIdClient($id_client)
    {
        $this->id_client = $id_client;
    }
}