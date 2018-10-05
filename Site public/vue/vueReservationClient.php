<?php
include 'header.php';

include '../accesseur/ReservationDAO.php';
include '../accesseur/ClientDAO.php';
include '../accesseur/BateauDAO.php';
include '../accesseur/ServiceDAO.php';
include '../accesseur/EmplacementDAO.php';

$reservationDAO = new ReservationDAO();
$bateauDAO = new BateauDAO();
$clientDAO = new ClientDAO();
$serviceDAO = new ServiceDAO();
$emplacementDAO = new EmplacementDAO();

$donneesReservation = $reservationDAO->listerReservationId($_SESSION['id']);
// FAIRE VUE SANS IDs
?>

<h1>Recapitulatifs de mes réservations :</h1>

<div class="row">
    <table border="2">
        <?php if(isset($donneesReservation[0])): ?>
            <thead>
            <tr><th>Nom</th><th>Prenom</th><th>Date de début de réservation</th><th>Date de fin de réservation</th><th>Bateau</th><th>Emplacement</th><th>Electricité</th><th>Essence</th><th>Vidange</th></tr>
            </thead>
            <tbody>
            <?php foreach ($donneesReservation as $reservation) :?>
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
                        <?php echo $bateauDAO->trouverBateau($reservation->id_bateau)->nom?>
                    </td>
                    <td>
                        <?php echo $emplacementDAO->trouverEmplacement($reservation->id_emplacement)->label ?>
                    </td>
                    <td>
                        <?php if($serviceDAO->trouverService($reservation->id_service)->contientelectricite){echo 'X';}else echo 'O'; ?>
                    </td>
                    <td>
                        <?php if($serviceDAO->trouverService($reservation->id_service)->contientessence){echo 'X';}else echo 'O'; ?>
                    </td>
                    <td>
                        <?php if($serviceDAO->trouverService($reservation->id_service)->contientvidange){echo 'X';}else echo 'O'; ?>
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

<?php include 'footer.php';?>