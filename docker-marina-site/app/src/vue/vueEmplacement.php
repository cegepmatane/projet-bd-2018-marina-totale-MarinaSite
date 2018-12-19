<?php
include 'headerAdmin.php';

include '../accesseur/ReservationDAO.php';
$reservationDAO = new ReservationDAO();

include '../accesseur/EmplacementDAO.php';
$emplacementDAO = new EmplacementDAO();
$donneesEmplacement = $emplacementDAO->listerEmplacement();

$donneesEmplacementDejaReserver = array();
foreach ($donneesEmplacement as $emplacement) {
    $donneesEmplacementDejaReserver[$emplacement->id] = $reservationDAO->emplacementDejaDansReservation($emplacement->id);
}
?>

<h1><?php echo _("Récapitulatif des emplacements")?></h1>

<div class="table-responsive">
    <table class="table table-striped table-hover"  border="2" style="text-align: center;">
        <?php if(isset($donneesEmplacement[0])): ?>
            <thead>
            <tr><th><?php echo _("Label")?></th><th><?php echo _("Longueur")?></th><th><?php echo _("Largeur")?></th><th><?php echo _("Actions")?></th></tr>
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
                        <div class="modal fade" id="modificationModal<?= $emplacement->id; ?>" tabindex="-1"
                             role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"
                                            id="exampleModalLabel"><?php echo _("Modifier") ?></h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo _("Impossible de modifier l'emplacement:\n Votre emplacement dájà dans une reservation active."); ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                                data-dismiss="modal"
                                                aria-label="Close">
                                            <?php echo _("Annuler"); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if ($donneesEmplacementDejaReserver[$emplacement->id]) : ?>
                            <a class="btn btn-outline-secondary" data-toggle="modal"
                               data-target="#modificationModal<?= $emplacement->id; ?>"><?php echo _("Modifier") ?></a>
                        <?php else : ?>
                            <a class="btn btn-outline-secondary"
                               href="vueModifierEmplacement.php?id=<?= $emplacement->id; ?>"><?php echo _("Modifier") ?></a>
                        <?php endif; ?>
                        <!-- Modal -->
                        <div class="modal fade" id="suppressionModal<?= $emplacement->id; ?>" tabindex="-1"
                             role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"
                                            id="exampleModalLabel"><?php echo _("Suppression") ?></h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        if ($donneesEmplacementDejaReserver[$emplacement->id]) {
                                            echo _("Impossible de supprimer le bateau:\n Votre bateau est possede une reservation active.");
                                        } else {
                                            echo _("Êtes vous sur de vouloir supprimer?");
                                        } ?>
                                    </div>
                                    <div class="modal-footer">
                                        <?php if ($donneesEmplacementDejaReserver[$emplacement->id]) : ?>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"
                                                    aria-label="Close">
                                                <?php echo _("Annuler")?>
                                            </button>
                                        <?php else : ?>
                                            <a href="../fonctions/supprimerEmplacement.php?id=<?= $emplacement->id; ?>"
                                               class="btn btn-danger"><?php echo _("Supprimer") ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-outline-danger" data-toggle="modal"
                           data-target="#suppressionModal<?= $emplacement->id; ?>"><?php echo _("Supprimer") ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        <?php else: ?>
            <tr>
                <td><?php echo _("Pas d'emplacements")?></td>
            </tr>
        <?php endif; ?>
    </table>

    <a class="btn btn-primary btn-lg" style="text-align: center;" href="vueAjouterEmplacement.php"><?php echo _("Ajouter un emplacementl")?></a>
    <a class="btn btn-outline-secondary btn-lg" style="text-align: center;" href="partieGerant.php"><?php echo _("Retour")?></a>
</div>

<?php include "footer.php"; ?>