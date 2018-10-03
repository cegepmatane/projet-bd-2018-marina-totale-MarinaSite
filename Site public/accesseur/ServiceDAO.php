<?php
include_once "baseDeDonnee.php";

Class ServiceDAO{

    public function listerService(){
        $LISTER_SERVICE = "SELECT * FROM service";
        global $basededonnees;
        $requeteListerService = $basededonnees->prepare($LISTER_SERVICE);
        $requeteListerService->execute();

        return $requeteListerService->fetchAll(PDO::FETCH_OBJ);
    }

    public function ajouterService(Service $service)
    {
        $AJOUTER_SERVICE = "INSERT INTO service(contientessence, contientelectricite, contientvidange) VALUES (:contientessence, :contientelectricite, :contientvidange)";

        global $basededonnees;

        $requeteAjouterService = $basededonnees->prepare($AJOUTER_SERVICE);

        if ($service->getContientessence() === true) echo '<br>essence true';
        else echo '<br>essence false';

        $requeteAjouterService->bindValue(':contientessence', $service->getContientessence());
        $requeteAjouterService->bindValue(':contientelectricite', $service->getContientelectricite());
        $requeteAjouterService->bindValue(':contientvidange', $service->getContientvidange());

        /*$requeteAjouterService->bindValue(':contientessence', true);
        $requeteAjouterService->bindValue(':contientelectricite', false);
        $requeteAjouterService->bindValue(':contientvidange', true);*/

        $requeteAjouterService->execute();

        return $basededonnees->lastInsertId();
    }

    public function modifierService(Service $service)
    {
        $MODIFIER_SERVICE = "UPDATE service SET contientessence = :contientessence, contientelectricite = :contientelectricite, contientvidange = :contientvidange WHERE idservice = :idservice";

        global $basededonnees;

        $requeteModifierService = $basededonnees->prepare($MODIFIER_SERVICE);

        $requeteModifierService->bindValue(':contientessence', $service->getContientessence());
        $requeteModifierService->bindValue(':contientelectricite', $service->getContientelectricite());
        $requeteModifierService->bindValue(':contientvidange', $service->getContientvidange());
        $requeteModifierService->bindValue(':idservice', $service->getIdservice());

        $requeteModifierService->execute();
    }

    public function trouverService($idservice)
    {
        global $basededonnees;
        $TROUVER_SERVICE = 'SELECT * FROM service WHERE idservice = :idservice';
        $requeteTrouverService = $basededonnees->prepare($TROUVER_SERVICE);
        $requeteTrouverService->bindValue(':idservice', $idservice);
        $requeteTrouverService->execute();

        return $requeteTrouverService->fetch(PDO::FETCH_OBJ);
    }

    public function supprimerService($idservice)
    {
        global $basededonnees;
        $SUPPRIMER_SERVICE = 'DELETE FROM service WHERE idservice = :idservice';
        $requeteSupprimerReservation = $basededonnees->prepare($SUPPRIMER_SERVICE);
        $requeteSupprimerReservation->bindValue(':idservice', $idservice);
        $requeteSupprimerReservation->execute();
    }

}