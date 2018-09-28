<?php
include_once "baseDeDonnee.php";

Class ClientDAO{

    public function listerClientAyantReservationEnCours(){
        $LISTER_CLIENT = "SELECT * FROM client";
        global $basededonnees;
        $requeteListerClient = $basededonnees->prepare($LISTER_CLIENT);
        $requeteListerClient->execute();

        return $requeteListerClient->fetchAll(PDO::FETCH_OBJ);
    }

    public function listerClientSansReservationActuelle(){
        $LISTER_CLIENT = "SELECT * FROM client";
        global $basededonnees;
        $requeteListerClient = $basededonnees->prepare($LISTER_CLIENT);
        $requeteListerClient->execute();

        return $requeteListerClient->fetchAll(PDO::FETCH_OBJ);
    }

    public function ajouterClient(Client $client)
    {
        $AJOUTER_CLIENT = "INSERT INTO client(nom, prenom) VALUES (:nom, :prenom)";

        global $basededonnees;

        $requeteAjouterClient = $basededonnees->prepare($AJOUTER_CLIENT);

        $requeteAjouterClient->bindValue(':nom', $client->getNom());
        $requeteAjouterClient->bindValue(':prenom', $client->getPrenom());

        $requeteAjouterClient->execute();
    }

    public function modifierClient(Client $client)
    {
        $MODIFIER_CLIENT = "UPDATE client SET nom = :nom, prenom = :prenom WHERE idclient = :idclient";

        global $basededonnees;

        $requeteModifierClient = $basededonnees->prepare($MODIFIER_CLIENT);

        $requeteModifierClient->bindValue(':nom', $client->getNom());
        $requeteModifierClient->bindValue(':prenom', $client->getPrenom());
        $requeteModifierClient->bindValue(':idclient', $client->getIdclient());

        $requeteModifierClient->execute();
    }

    public function trouverClient($idclient)
    {
        global $basededonnees;
        $TROUVER_CLIENT = 'SELECT * FROM client WHERE idclient = :idclient';
        $requeteTrouverClient = $basededonnees->prepare($TROUVER_CLIENT);
        $requeteTrouverClient->bindValue(':idclient', $idclient);
        $requeteTrouverClient->execute();

        return $requeteTrouverClient->fetch(PDO::FETCH_OBJ);
    }

    public function supprimerClient($idclient)
    {
        global $basededonnees;
        $SUPPRIMER_CLIENT = 'DELETE FROM client WHERE idclient = :idclient';
        $requeteSupprimerClient = $basededonnees->prepare($SUPPRIMER_CLIENT);
        $requeteSupprimerClient->bindValue(':idclient', $idclient);
        $requeteSupprimerClient->execute();
    }

}