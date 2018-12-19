<?php
include 'header.php';

include '../accesseur/ReservationDAO.php';
include '../accesseur/ClientDAO.php';
include '../accesseur/BateauDAO.php';
include '../accesseur/EmplacementDAO.php';

$reservationDAO = new ReservationDAO();
$bateauDAO = new BateauDAO();
$clientDAO = new ClientDAO();
$emplacementDAO = new EmplacementDAO();

$idreservation = $_GET['idreservation'];

$donneesReservation = $reservationDAO->listerReservationSelonIdReservation($idreservation);

?>

<div class="p-lg-5 p-md-3">
    <h1><?php echo _("Détails de la réservation :")?></h1>

    <div class="table-responsive">
        <table border="2" class="table table-striped table-hover">
            <?php if (isset($donneesReservation[0])): ?>
                <thead>
                <tr>
                    <th><?php echo _("Prénom")?></th>
                    <th><?php echo _("Nom")?></th>
                    <th><?php echo _("Date de début de réservation")?></th>
                    <th><?php echo _("Date de fin de réservation")?></th>
                    <th><?php echo _("Bateau")?></th>
                    <th><?php echo _("Emplacement")?></th>
                    <th><?php echo _("Electricité")?></th>
                    <th><?php echo _("Essence")?></th>
                    <th><?php echo _("Vidange")?></th>

                </tr>
                </thead>
                <tbody>
                <?php foreach ($donneesReservation as $reservation) : ?>
                    <tr>
                        <td>
                            <?php echo $clientDAO->trouverClientId($reservation->id_client)->nom; ?>
                        </td>
                        <td>
                            <?php echo $clientDAO->trouverClientId($reservation->id_client)->prenom; ?>
                        </td>
                        <td>
                            <?php echo $reservation->datedebut; ?>
                        </td>
                        <td>
                            <?php echo $reservation->datefin; ?>
                        </td>
                        <td>
                            <?php echo $bateauDAO->trouverBateau($reservation->id_bateau)->nom ?>
                        </td>
                        <td>
                            <?php echo $emplacementDAO->trouverEmplacement($reservation->id_emplacement)->label ?>
                        </td>
                        <td>
                            <?php if ($reservation->electricite) {
                                echo 'X';
                            } else echo 'O'; ?>
                        </td>
                        <td>
                            <?php if ($reservation->essence) {
                                echo 'X';
                            } else echo 'O'; ?>
                        </td>
                        <td>
                            <?php if ($reservation->vidange) {
                                echo 'X';
                            } else echo 'O'; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            <?php else: ?>
                <tr>
                    <td><?php echo _("Pas de réservation")?></td>
                </tr>
            <?php endif; ?>
        </table>
    </div>


    <a class="btn btn-secondary btn-lg"
       href="vueReservationClient.php?id=<?php echo $reservation->id_client ?>"><?php echo _("Retour") ?>
    </a>

    <a class="btn btn-primary btn-lg"
       href="vueFacture.php?id=<?php echo $reservation->id ?>"><?php echo _("Facture") ?>
    </a>