<?php
include 'header.php';

include '../accesseur/EmplacementDAO.php';
$emplacementDAO = new EmplacementDAO();
$donneesEmplacement = $emplacementDAO->listerEmplacement();

?>

<h1>Récapitulatif des emplacements</h1>

<div class="row">
    <table class="table table-hover"  border="2">
        <?php if(isset($donneesEmplacement[0])): ?>
            <thead>
            <tr><th>Label</th><th>Longueur</th><th>Largeur</th><th>Actions</th></tr>
            </thead>
            <tbody>
            <?php foreach ($donneesEmplacement as $emplacement) :?>
                <tr>
                    <td>
                        <?php echo $emplacement->label; ?>
                    </td>
                    <td>
                        <?php echo $emplacement->longueur; ?>
                    </td>
                    <td>
                        <?php echo $emplacement->largeur; ?>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="vueModifierEmplacement.php?id=<?=$emplacement->id; ?>">Modifier</a>
                        <a class="btn btn-primary" href="../fonctions/supprimerEmplacement.php?id=<?=$emplacement->id; ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        <?php else: ?>
            <tr>
                <td>Pas d'emplacements</td>
            </tr>
        <?php endif; ?>
    </table>

    <a class="btn btn-primary" href="vueAjouterEmplacement.php">Ajouter un emplacement</a>
</div>

<?php include "footer.php"; ?>