<?php include 'header.php'; ?>

<div class="partieGerant">

    <h1> Gestion de la marina</h1>
    Bonjour, <?php echo  $_SESSION['pseudo']?>

    <div class="wb-tabs">
        <div class="tabpanels">
            <details id="details-panel1" open="open">
                <summary>Réservations en cours</summary>
                <div class="tableau_gerant">
                    <table>
                        <tr>
                            <th>Code</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date arrivée</th>
                            <th>Date départ</th>
                            <th>Actions</th>
                        </tr>
                        <tr>
                            <td>A1</td>
                            <td>Moriarty</td>
                            <td>Alex</td>
                            <td>01-09-2018</td>
                            <td>10-09-2018</td>
                            <td> <a href="modificationReservation.php">Modifier</a> <a href="supprimerReservation.php">Supprimer</a> </td>
                        </tr>
                        <tr>
                            <td>A1</td>
                            <td>Moriarty</td>
                            <td>Alex</td>
                            <td>01-09-2018</td>
                            <td>10-09-2018</td>
                            <td> <a href="modificationReservation.php">Modifier</a> <a href="supprimerReservation.php">Supprimer</a> </td>
                        </tr>
                        <tr>
                            <td>A1</td>
                            <td>Moriarty</td>
                            <td>Alex</td>
                            <td>01-09-2018</td>
                            <td>10-09-2018</td>
                            <td> <a href="modificationReservation.php">Modifier</a> <a href="supprimerReservation.php">Supprimer</a> </td>
                        <tr>
                            <td>A1</td>
                            <td>Moriarty</td>
                            <td>Alex</td>
                            <td>01-09-2018</td>
                            <td>10-09-2018</td>
                            <td> <a href="modificationReservation.php">Modifier</a> <a href="supprimerReservation.php">Supprimer</a> </td>
                        </tr>
                    </table>

                </div>
            </details>
            <details id="details-panel2" >
                <summary>Réservations archivées</summary>
                <div class="tableau_gerant">
                    <table>
                        <tr>
                            <th>Code</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date arrivée</th>
                            <th>Date départ</th>
                            <th>Actions</th>
                        </tr>
                        <tr>
                            <td>A1</td>
                            <td>Moriarty</td>
                            <td>Alex</td>
                            <td>01-09-2018</td>
                            <td>10-09-2018</td>
                            <td> <a href="modificationReservation.php">Modifier</a> <a href="supprimerReservation.php">Supprimer</a> </td>
                        </tr>
                        <tr>
                            <td>A1</td>
                            <td>Moriarty</td>
                            <td>Alex</td>
                            <td>01-09-2018</td>
                            <td>10-09-2018</td>
                            <td> <a href="modificationReservation.php">Modifier</a> <a href="supprimerReservation.php">Supprimer</a> </td>
                        </tr>
                        <tr>
                            <td>A1</td>
                            <td>Moriarty</td>
                            <td>Alex</td>
                            <td>01-09-2018</td>
                            <td>10-09-2018</td>
                            <td> <a href="modificationReservation.php">Modifier</a> <a href="supprimerReservation.php">Supprimer</a> </td>
                        <tr>
                            <td>A1</td>
                            <td>Moriarty</td>
                            <td>Alex</td>
                            <td>01-09-2018</td>
                            <td>10-09-2018</td>
                            <td> <a href="modificationReservation.php">Modifier</a> <a href="supprimerReservation.php">Supprimer</a> </td>
                        </tr>
                    </table>

                </div>
            </details>

        </div>
    </div>





</div>





<?php include "footer.php"; ?>


