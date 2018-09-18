<?php
/**
 * Created by PhpStorm.
 * User: 1832527
 * Date: 18/09/2018
 * Time: 16:05
 */

class Bateau{

    var $idbateau;
    var $nom;
    var $longeur;
    var $largeur;

    /**
     * Bateau constructor.
     * @param $idbateau
     * @param $nom
     * @param $longeur
     * @param $largeur
     */
    public function __construct($idbateau, $nom, $longeur, $largeur)
    {
        $this->idbateau = $idbateau;
        $this->nom = $nom;
        $this->longeur = $longeur;
        $this->largeur = $largeur;
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
    public function getLongeur()
    {
        return $this->longeur;
    }

    /**
     * @param mixed $longeur
     */
    public function setLongeur($longeur)
    {
        $this->longeur = $longeur;
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




}
