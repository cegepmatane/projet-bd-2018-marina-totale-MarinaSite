<?php

include 'header.php';

include '../accesseur/ReservationDAO.php';
$reservationDAO = new ReservationDAO();
$donneesReservation = $reservationDAO->listerReservation($_SESSION['id']);

?>
<h2>Recapitulatifs de me réservations :</h2>

<div class="row">
    <table border="2">
        <?php if(isset($donneesReservation[0])): ?>
            <thead>
            <tr><th>Date de début de réservation</th><th>Date de fin de réservation</th><th>ID bateau</th><th>ID emplacement</th><th>ID Service</th><th>Action...</th></tr>
            </thead>
            <tbody>
            <?php foreach ($donneesReservation as $reservation) :?>
                <tr>
                    <td>
                        <?php echo $reservation->datedebut; ?>
                    </td>
                    <td>
                        <?php echo $reservation->datefin; ?>
                    </td>
                    <td>
                        <?php echo $reservation->id_bateau ?>
                    </td>
                    <td>
                        <?php echo $reservation->id_emplacement ?>
                    </td>
                    <td>
                        <?php echo $reservation->id_service; ?>
                    </td>
                    <td>
                        <!--TODO //\\//\\//\\-->
                        <a href="vueModifierBateau.php?id=<?=$reservation->id; ?>">modifier</a>
                        <a href="../fonctions/supprimerBateau.php?id=<?=$reservation->id; ?>">supprimer</a>
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

    <a href="vueAjouterReservation.php?id=<?php echo $_SESSION['id']?>">Effectuer une demande de réservation</a>
</div>