<?php
include 'header.php';

include '../accesseur/EmplacementDAO.php';
$emplacementDAO = new EmplacementDAO();
$donneesEmplacement = $emplacementDAO->listerEmplacement();

?>


<div class="row">
    <table border="2">
        <caption>Récapitulatif des emplacements</caption>
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
                        <a href="vueModifierEmplacement.php?id=<?=$emplacement->id; ?>">Modifier</a>
                        <a href="../fonctions/supprimerEmplacement.php?id=<?=$emplacement->id; ?>">Supprimer</a>
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

    <a href="vueAjouterEmplacement.php">Ajouter un emplacement</a>
</div>

<?php include "footer.php"; ?>