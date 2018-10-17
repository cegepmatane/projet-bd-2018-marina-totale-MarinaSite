<?php
include 'headerAdmin.php';

include '../accesseur/EmplacementDAO.php';
$emplacementDAO = new EmplacementDAO();
$donneesEmplacement = $emplacementDAO->listerEmplacement();

?>

<h1>Récapitulatif des emplacements</h1>

<div class="table-responsive">
    <table class="table table-striped table-hover"  border="2" style="text-align: center;">
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
                        <a class="btn btn-outline-secondary" href="vueModifierEmplacement.php?id=<?=$emplacement->id; ?>">Modifier</a>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Êtes vous sur de vouloir supprimer?
                                    </div>
                                    <div class="modal-footer">
                                        <a href="../fonctions/supprimerEmplacement.php?id=<?= $emplacement->id; ?>"
                                           class="btn btn-danger">Supprimer
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-outline-danger" data-toggle="modal"
                           data-target="#exampleModal">Supprimer</a>
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

    <a class="btn btn-primary btn-lg" style="text-align: center;" href="vueAjouterEmplacement.php">Ajouter un emplacement</a>
    <a class="btn btn-outline-secondary btn-lg" style="text-align: center;" href="partieGerant.php">Retour</a>
</div>

<?php include "footer.php"; ?>