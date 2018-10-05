<?php
include "baseDeDonnee.php";

Class ClientDAO{

    public function listerClientAyantReservationEnCours(){

        $LISTER_CLIENT = "SELECT * FROM client 
                          INNER JOIN reservation ON client.id = reservation.id_client
                          WHERE client.id = reservation.id_client
                          AND CURRENT_DATE >= reservation.datedebut
                          AND CURRENT_DATE <= reservation.datefin;";

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

    public function ajouterClient(Client $client){

        $AJOUTER_CLIENT = "INSERT INTO client(nom, prenom, mot_de_passe, mail, numero, bool_gerant) VALUES (:nom, :prenom, :motdepasse, :mail, :numero, FALSE)";

        global $basededonnees;

        $requeteAjouterClient = $basededonnees->prepare($AJOUTER_CLIENT);

        $requeteAjouterClient->bindValue(':nom', $client->getNom());
        $requeteAjouterClient->bindValue(':prenom', $client->getPrenom());
        $requeteAjouterClient->bindValue(':motdepasse', $client->getMotDePasse());
        $requeteAjouterClient->bindValue(':mail', $client->getMail());
        $requeteAjouterClient->bindValue(':numero', $client->getNumero());
        //$requeteAjouterClient->bindValue(':boolGerant', $client->getBoolGerant());

        $requeteAjouterClient->execute();
    }

    public function modifierClient(Client $client, $id)
    {
        $MODIFIER_CLIENT = "UPDATE client SET nom = :nom, prenom = :prenom, mail = :mail, numero = :numero, mot_de_passe = :motdepasse WHERE id = :idclient";

        global $basededonnees;

        $requeteModifierClient = $basededonnees->prepare($MODIFIER_CLIENT);

        $requeteModifierClient->bindValue(':nom', $client->getNom());
        $requeteModifierClient->bindValue(':prenom', $client->getPrenom());
        $requeteModifierClient->bindValue(':numero', $client->getNumero());
        $requeteModifierClient->bindValue(':mail', $client->getMail());
        $requeteModifierClient->bindValue(':motdepasse', $client->getMotDePasse());
        $requeteModifierClient->bindValue(':idclient', $id);

        $requeteModifierClient->execute();
    }

    public function trouverClientId($idclient)
    {
        global $basededonnees;
        $TROUVER_CLIENT = 'SELECT * FROM client WHERE id = :idclient';
        $requeteTrouverClient = $basededonnees->prepare($TROUVER_CLIENT);
        $requeteTrouverClient->bindValue(':idclient', $idclient);
        $requeteTrouverClient->execute();

        return $requeteTrouverClient->fetch(PDO::FETCH_OBJ);
    }

    public function trouverClientMail($mail)
    {
        global $basededonnees;
        $TROUVER_CLIENT = 'SELECT * FROM client WHERE mail = :mail';
        $requeteTrouverClient = $basededonnees->prepare($TROUVER_CLIENT);
        $requeteTrouverClient->bindValue(':mail', $mail);
        $requeteTrouverClient->execute();

        return $requeteTrouverClient->fetch(PDO::FETCH_OBJ);
    }
    public function clientExiste($mail){
        //test1
        /*$result = mysql_query('SELECT EXISTS (SELECT * FROM client WHERE mail="' . $mail . '" ) AS compte_existe');
        $req = mysql_fetch_array($result);
        return  $req['compte_existe'];*/

        //test2
        /*global $basededonnees;
        $sql = "select * from client where mail=?";
        $row = $this->$basededonnees->fetchAssoc($sql, array($mail));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No user matching id " . $mail);*/

        $TROUVER_CLIENT = 'SELECT * FROM client WHERE mail = :mail';

        global $basededonnees;

        $requeteTrouverClient = $basededonnees->prepare($TROUVER_CLIENT);
        $requeteTrouverClient->bindValue(':mail', $mail);
        $requeteTrouverClient->execute();
        $res = $requeteTrouverClient->fetch(PDO::FETCH_OBJ);

        if($res !== false) {
            return true;
        }
        return false;
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