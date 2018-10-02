<?php
include "baseDeDonnee.php";

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

        print_r($basededonnees);

        $requeteTrouverClient = $basededonnees->prepare($TROUVER_CLIENT);
        $requeteTrouverClient->bindValue(':mail', $mail);
        $requeteTrouverClient->execute();
        $res = $requeteTrouverClient->fetch(PDO::FETCH_OBJ);

        if($res !== false) {
            echo 'true';
            return true;
        }
        echo 'false';
        return false;
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

    public function supprimerClient($idclient)
    {
        global $basededonnees;
        $SUPPRIMER_CLIENT = 'DELETE FROM client WHERE idclient = :idclient';
        $requeteSupprimerClient = $basededonnees->prepare($SUPPRIMER_CLIENT);
        $requeteSupprimerClient->bindValue(':idclient', $idclient);
        $requeteSupprimerClient->execute();
    }

}