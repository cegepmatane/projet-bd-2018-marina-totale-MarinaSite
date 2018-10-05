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

        $requeteAjouterService->bindValue(':contientessence', $service->getContientessence());
        $requeteAjouterService->bindValue(':contientelectricite', $service->getContientelectricite());
        $requeteAjouterService->bindValue(':contientvidange', $service->getContientvidange());

        $requeteAjouterService->execute();

        return $basededonnees->lastInsertId();
    }

    public function modifierService(Service $service, $id)
    {
        $MODIFIER_SERVICE = "UPDATE service SET contientessence = :contientessence, contientelectricite = :contientelectricite, contientvidange = :contientvidange WHERE id = :idservice";

        global $basededonnees;

        $requeteModifierService = $basededonnees->prepare($MODIFIER_SERVICE);

        $requeteModifierService->bindValue(':contientessence', (bool)$service->getContientessence());
        $requeteModifierService->bindValue(':contientelectricite', (bool)$service->getContientelectricite());
        $requeteModifierService->bindValue(':contientvidange', (bool)$service->getContientvidange());
        $requeteModifierService->bindValue(':idservice', $id);

        $requeteModifierService->execute();
    }

    public function trouverService($id)
    {
        global $basededonnees;
        $TROUVER_SERVICE = 'SELECT * FROM service WHERE id = :id';
        $requeteTrouverService = $basededonnees->prepare($TROUVER_SERVICE);
        $requeteTrouverService->bindValue(':id', $id);
        $requeteTrouverService->execute();

        return $requeteTrouverService->fetch(PDO::FETCH_OBJ);
    }

    public function supprimerService($idservice)
    {
        global $basededonnees;
        $SUPPRIMER_SERVICE = 'DELETE FROM service WHERE id = :idservice';
        $requeteSupprimerReservation = $basededonnees->prepare($SUPPRIMER_SERVICE);
        $requeteSupprimerReservation->bindValue(':idservice', $idservice);
        $requeteSupprimerReservation->execute();
    }

}