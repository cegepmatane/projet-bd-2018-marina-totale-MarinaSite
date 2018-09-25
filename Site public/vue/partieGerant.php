<?php include 'header.php';
include '../fonctions/verifAdmin.php';
include '../accesseur/ClientDAO.php';
$clientDAO = new ClientDAO();
$donnees = $clientDAO->listerClient();
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
                        <caption>Recapitulatifs des clients en cours</caption>
                            <?php if(isset($donnees[0])): ?>
                            <thead>
                            <tr><th>idclient</th><th>Nom</th><th>Prénom</th><th>idbateau</th><th>Action...</th></tr>
                            </thead>
                            <tbody>
                            <?php foreach ($donnees as $client) :?>
                                <tr><td>
                                        <?php echo $client->idclient; ?>
                                    </td>
                                    <td>
                                        <?php echo $client->nom; ?>
                                    </td>
                                    <td>
                                        <?php echo $client->prenom; ?>
                                    </td>
                                    <td>
                                        <?php echo $client->idbateau; ?>
                                    </td>
                                    <td>
                                        <a href="modifierReservation.php?id=<?=$client->id; ?>">Modifier</a>
                                        <a href="supprimerReservation.php?id=<?=$client->id; ?>">Supprimer</a>
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
                            <caption>Recapitulatifs des clients en cours</caption>
                            <?php if(isset($donnees[0])): ?>
                                <thead>
                                <tr><th>idclient</th><th>Nom</th><th>Prénom</th><th>idbateau</th><th>Action...</th></tr>
                                </thead>
                                <tbody>
                                <?php foreach ($donnees as $client) :?>
                                    <tr><td>
                                            <?php echo $client->idclient; ?>
                                        </td>
                                        <td>
                                            <?php echo $client->nom; ?>
                                        </td>
                                        <td>
                                            <?php echo $client->prenom; ?>
                                        </td>
                                        <td>
                                            <?php echo $client->idbateau; ?>
                                        </td>
                                        <td>
                                            <a href="modifierReservation.php?id=<?=$client->id; ?>">Modifier</a>
                                            <a href="supprimerReservation.php?id=<?=$client->id; ?>">Supprimer</a>
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


        </div>
    </div>





</div>





<?php include "footer.php"; ?>


