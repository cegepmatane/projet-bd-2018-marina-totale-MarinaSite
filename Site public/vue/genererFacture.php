<?php
include 'header.php';
include '../accesseur/FactureDAO.php';

$factureDAO = new FactureDAO();
$donneesFacture = $factureDAO->lireFacture(1);
$date_debut = new DateTime($donneesFacture->date_debut);
$date_fin = new DateTime($donneesFacture->date_fin);
$duree = date_diff($date_debut, $date_fin)->days;
$prix_emplacement = $donneesFacture->prix_emplacement_par_pied_carre *
    $donneesFacture->longueur *
    $donneesFacture->largeur *
    $duree;
$prix_electricite = $donneesFacture->prix_electricite_par_pied_carre *
    $donneesFacture->longueur *
    $donneesFacture->largeur*
    $duree;
$prix_reservation = $prix_emplacement + $prix_electricite;
?>

    <h1>Votre facture</h1>

    <div class="table-responsive">
        <table class="table table-striped table-hover"  border="2" style="text-align: center;">
            <?php if(isset($donneesFacture)): ?>
                <thead>
                    <tr>
                        <th>Désignation</th>
                        <th>P.U./pi²/nuit</th>
                        <th>P.U. H.T.</th>
                        <th>Total H.T.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Emplacement de port</td>
                        <td></td>
                        <td></td>
                        <td><?php echo $prix_reservation; ?>$</td>
                    </tr>
                    <tr>
                        <td>- Emplacement : <?php echo $donneesFacture->id_emplacement; ?></td>
                        <td><?php echo $donneesFacture->prix_emplacement_par_pied_carre; ?>$</td>
                        <td><?php echo $prix_emplacement; ?>$</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>- Bateau : <?php echo $donneesFacture->nom; ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>- Date de début : <?php echo $date_debut->format("d/m/Y"); ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>- Date de fin : <?php echo $date_fin->format("d/m/Y"); ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>- Avec électricité</td>
                        <td><?php echo $donneesFacture->prix_electricite_par_pied_carre; ?>$</td>
                        <td><?php echo $prix_electricite; ?>$</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>- Avec eau</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>- Avec vidange</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            <?php else: ?>
                <tr>
                    <td>Aucune facture portant cet identifiant n'a été trouvée !</td>
                </tr>
            <?php endif; ?>
        </table>

        <a class="btn btn-outline-secondary btn-lg" style="text-align: center;" href="partieClient.php">Retour</a>
    </div>

<?php include "footer.php"; ?>