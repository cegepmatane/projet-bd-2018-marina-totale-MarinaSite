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

$donneesReservation = $reservationDAO->listerReservationId($_SESSION['id']);

?>
    <div class="p-lg-5 p-md-3">
        <h1>Recapitulatifs de mes réservations :</h1>

        <div class="table-responsive">
            <table border="2" class="table table-striped table-hover">
                <?php if (isset($donneesReservation[0])): ?>
                    <thead>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Date de début de réservation</th>
                        <th>Date de fin de réservation</th>
                        <th>Bateau</th>
                        <th>Emplacement</th>
                        <th>Electricité</th>
                        <th>Essence</th>
                        <th>Vidange</th>
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
                        <td>Pas de réservation</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
        <div class="span12">
            <a class="btn btn-outline-secondary btn-lg" style="text-align: center;" href="partieClient.php">Retour</a>

        </div>
    </div>
<?php include 'footer.php'; ?>