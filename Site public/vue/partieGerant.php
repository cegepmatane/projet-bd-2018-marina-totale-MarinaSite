<?php include 'header.php';
include '../accesseur/ClientDAO.php';
include '../accesseur/ReservationDAO.php';
include '../fonctions/verifAdmin.php';

$clientDAO = new ClientDAO();
$reservationDAO = new ReservationDAO();
$donneesReservationEnCours = $reservationDAO->listerReservationEnCours();
?>

<div class="partieGerant">

    <h1> Gestion de la marina</h1>
    Bonjour, <?php echo  $_SESSION['pseudo']?>

    <div class="wb-tabs">
        <div class="tabpanels">
            <details id="details-panel1" open="open">
                <summary>Réservations en cours</summary>


                <div class="row">
                    <table border="2">
                        <caption>Récapitulatifs des clients ayant des réservations en cours</caption>
                            <?php if(isset($donneesReservationEnCours[0])): ?>
                            <thead>
                            <tr><th>idclient</th><th>Nom</th><th>Prénom</th><th>Date début</th><th>Date fin</th><th>Action...</th></tr>
                            </thead>
                            <tbody>
                            <?php foreach ($donneesReservationEnCours as $reservation) :?>
                                <tr><td>
                                        <?php echo $reservation->id; ?>
                                    </td>
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
                                        <a href="modifierReservation.php?id=<?=$reservation->id; ?>">Modifier</a>
                                        <a href="supprimerReservation.php?id=<?=$reservation->id; ?>">Supprimer</a>
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

                    <a href="ajouterReservation.php">Ajouter une réservation</a>
                </div>


            </details>

            <details id="details-panel2">
                <summary>Réservations archivées</summary>

                    <div class="row">
                        <table border="2">
                            <caption>Récapitulatif des clients ayant des réservations archivées</caption>
                            <?php if(isset($donneesSansReservationActuelle[0])): ?>
                                <thead>
                                <tr><th>idclient</th><th>Nom</th><th>Prénom</th><th>Action...</th></tr>
                                </thead>
                                <tbody>
                                <?php foreach ($donneesSansReservationActuelle as $reservation) :?>
                                    <tr><td>
                                            <?php echo $reservation->id; ?>
                                        </td>
                                        <td>
                                            <?php echo $reservation->nom; ?>
                                        </td>
                                        <td>
                                            <?php echo $reservation->prenom; ?>
                                        </td>
                                        <td>
                                            <a href="modifierReservation.php?id=<?=$reservation->id; ?>">Modifier</a>
                                            <a href="supprimerReservation.php?id=<?=$reservation->id; ?>">Supprimer</a>
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


