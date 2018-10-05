<?php
include 'header.php';

include '../accesseur/ReservationDAO.php';

include '../accesseur/ClientDAO.php';
include '../accesseur/BateauDAO.php';
include '../accesseur/ServiceDAO.php';
include '../accesseur/EmplacementDAO.php';

$reservationDAO = new ReservationDAO();
$bateauDAO = new BateauDAO();
$client = new ClientDAO();
$serviceDAO = new ServiceDAO();
$emplacementDAO = new EmplacementDAO();

$donneesReservation = $reservationDAO->listerReservation($_SESSION['id']);
// FAIRE VUE SANS IDs
?>
<h2>Recapitulatifs de me réservations :</h2>

<div class="row">
    <table border="2">
        <?php if(isset($donneesReservation[0])): ?>
            <thead>
            <tr><th>Nom</th><th>Prenom</th><th>Date de début de réservation</th><th>Date de fin de réservation</th><th>Bateau</th><th>Emplacement</th><th>Services</th></tr>
            </thead>
            <tbody>
            <?php foreach ($donneesReservation as $reservation) :?>
                <tr>
                    <td>
                        <?php echo $clientDAI; ?>
                    </td>
                    <td>
                        <?php echo $reservation->datedebut; ?>
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
                        <?php echo $reservation->id_emplacement ?>
                    </td>
                    <td>
                        <?php echo $reservation->id_service; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        <?php else: ?>
            <tr>
                <td>Pas de réservation</td>
            </tr>
        <?php endif; ?>
    </table>

    <a href="vueAjouterReservationClient.php?id=<?php echo $_SESSION['id']?>">Effectuer une demande de réservation</a>
</div>