<?php include 'headerAdmin.php';
include '../accesseur/ClientDAO.php';
include '../accesseur/ReservationDAO.php';
include '../fonctions/verifAdmin.php';

$clientDAO = new ClientDAO();
$reservationDAO = new ReservationDAO();
$donneesReservationEnCours = $reservationDAO->listerReservationEnCours();
$donneesReservationArchivees = $reservationDAO->listerReservationArchivees();
?>

<div class="partieGerant">

    <h1> Gestion de la marina</h1>
    Bonjour, <?php echo  $clientDAO->trouverClientId($_SESSION['id'])->nom.' '.$clientDAO->trouverClientId($_SESSION['id'])->prenom?>

    <br><br>
    <div class="wb-tabs">
        <div class="tabpanels">
            <details id="details-panel1" open="open">
                <summary>Réservations en cours</summary>


                <div class="row">
                    <table class="table table-hover" border="2">
                        <br>
                        <caption>Récapitulatif des clients ayant des réservations en cours</caption>
                            <?php if(isset($donneesReservationEnCours[0])): ?>
                            <thead>
                            <tr><th>Nom</th><th>Prénom</th><th>Date début</th><th>Date fin</th><th>Actions</th></tr>
                            </thead>
                            <tbody>
                            <?php foreach ($donneesReservationEnCours as $reservation) :?>
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
                                        <a class="btn btn-primary" href="vueModifierReservation.php?id=<?=$reservation->id; ?>">Modifier</a>
                                        <a class="btn btn-primary" href="../fonctions/supprimerReservation.php?id=<?=$reservation->id; ?>">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        <?php else: ?>
                            <tr>
                                <td>Pas de clients dans la base de données</td>
                            </tr>
                        <?php endif; ?>
                    </table>
                    <br><br>

                    <a class="btn btn-primary" href="vueAjouterReservationGerant.php">Ajouter une réservation</a>
                    <br><br>
                    <a class="btn btn-primary" href="vueEmplacement.php">Gérer les emplacements</a>
                </div>


            </details>

            <details id="details-panel2">
                <summary>Réservations archivées</summary>

                    <div class="row">
                        <table class="table table-hover" border="2">
                            <br>
                            <caption>Récapitulatif des clients ayant des réservations archivées</caption>
                            <?php if(isset($donneesReservationArchivees[0])): ?>
                                <thead>
                                <tr><th>Nom</th><th>Prénom</th><th>Date debut</th><th>Date fin</th><th>Action</th></tr>
                                </thead>
                                <tbody>
                                <?php foreach ($donneesReservationArchivees as $reservation) :?>
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
                                            <a class="btn btn-primary" href="../fonctions/supprimerReservation.php?id=<?=$reservation->id; ?>">Supprimer</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            <?php else: ?>
                                <tr>
                                    <td>Pas de clients dans la base de données</td>
                                </tr>
                            <?php endif; ?>
                        </table>

                    </div>
            </details>


        </div>
    </div>





</div>





<?php include "footer.php"; ?>


