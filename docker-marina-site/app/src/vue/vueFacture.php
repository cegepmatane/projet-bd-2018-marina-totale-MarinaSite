<?php
include 'header.php';
include '../accesseur/FactureDAO.php';

$factureDAO = new FactureDAO();

$statut = "var_nok";

if (isset($_GET['id']) && $donneesFacture = $factureDAO->lireFacture($_GET['id']))
    if (isset($donneesFacture->prix_electricite_par_pied_carre) ||
        isset($donneesFacture->prix_emplacement_par_pied_carre) ||
        isset($donneesFacture->date_debut) ||
        isset($donneesFacture->date_fin) ||
        isset($donneesFacture->electricite) ||
        isset($donneesFacture->essence) ||
        isset($donneesFacture->vidange) ||
        isset($donneesFacture->nom_bateau) ||
        isset($donneesFacture->longueur_emplacement) ||
        isset($donneesFacture->largeur_emplacement) ||
        isset($donneesFacture->id_client) ||
        isset($donneesFacture->nom_client) ||
        isset($donneesFacture->prenom_client) ||
        isset($donneesFacture->date_creation))
    {
        $date_debut = new DateTime($donneesFacture->date_debut);
        $date_fin = new DateTime($donneesFacture->date_fin);
        $duree = date_diff($date_debut, $date_fin)->days;

        $prix_emplacement = $donneesFacture->prix_emplacement_par_pied_carre *
            $donneesFacture->longueur_emplacement *
            $donneesFacture->largeur_emplacement *
            $duree;

        $prix_reservation = $prix_emplacement;

        if($donneesFacture->electricite === 1) {
            $prix_electricite = $donneesFacture->prix_electricite_par_pied_carre *
                $donneesFacture->longueur_emplacement *
                $donneesFacture->largeur_emplacement*
                $duree;
            $prix_reservation += $prix_electricite;
        }
        $statut = "var_ok";
    }
?>
<div id="corps" class="m-5">
    <h1 xmlns="http://www.w3.org/1999/html">Votre facture</h1>

    <?php if($statut === "var_ok"): ?>
    <div>
        <div class="text-right">
            <p>Marina de Matane<br>
                175 rue du Barachois<br>
                CP122<br>
                Matane (Québec)<br>
                G4W 3N1</p>
        </div>
        <div class="font-weight-bold">
            <p><?php echo $donneesFacture->nom_client ?> <?php echo $donneesFacture->prenom_client ?><br>
                Client n°<?php echo $donneesFacture->id_client ?></p>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover"  border="2" style="text-align: center;">
            <thead>
            <tr>
                <th>Date</th>
                <th>Facture n°</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo $donneesFacture->date_creation; ?></td>
                <td>FAC<?php echo $donneesFacture->id_facture; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-hover"  border="2" style="text-align: center;">
            <?php if($statut === "var_ok"): ?>
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
                        <td>
                            <p>Emplacement de port</p>
                            <ul>
                                <li>Emplacement : <?php echo $donneesFacture->id_emplacement; ?></li>
                                <li>Bateau : <?php echo $donneesFacture->nom_bateau; ?></li>
                                <li>Date de début : <?php echo $date_debut->format("d/m/Y"); ?></li>
                                <li>Date de fin : <?php echo $date_fin->format("d/m/Y"); ?></li>
                                <li>Date de fin : <?php echo $date_fin->format("d/m/Y"); ?></li>
                                <li><?php if($donneesFacture->electricite === 1) echo 'Avec électricité';
                                    else echo 'Sans électricité';?></li>
                                <li><?php if($donneesFacture->essence === 1) echo 'Avec essence';
                                    else echo 'Sans essence';?></li>
                                <li><?php if($donneesFacture->vidange === 1) echo 'Avec vidange';
                                    else echo 'Sans vidange';?></li>
                            </ul>
                        </td>
                        <td><?php echo $donneesFacture->prix_emplacement_par_pied_carre; ?>$</td>
                        <td><?php echo $prix_emplacement; ?>$</td>
                        <td><?php echo $prix_reservation; ?>$</td>
                    </tr>
                </tbody>
            <?php else: ?>
                <tr>
                    <td>Cette facture n'existe pas ou est incomplète.</td>
                </tr>
            <?php endif; ?>
        </table>

        <a class="btn btn-outline-secondary btn-lg" style="text-align: center;" href="partieClient.php">Retour</a>
    </div>
</div>

<?php include "footer.php"; ?>