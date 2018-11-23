<?php
include 'header.php';

include '../accesseur/BateauDAO.php';
$bateauDAO = new BateauDAO();
$donneesBateaux = $bateauDAO->listerBateau($_SESSION['id']);

include '../accesseur/ClientDAO.php';
$clientDAO = new ClientDAO();
$donneesClient = $clientDAO->trouverClientId($_SESSION['id']);

include '../accesseur/ReservationDAO.php';
$reservationDAO = new ReservationDAO();

function possedeBateau()
{
    $bateauDAO = new BateauDAO();
    return $bateauDAO->possedeBateau($_SESSION['id']);
}

$donneesBateauxDejaReserver = array();
foreach ($donneesBateaux as $bateau) {
    $donneesBateauxDejaReserver[$bateau->id] = $reservationDAO->bateauDejaDansReservation($bateau->id);
}

if (isset($_SERVER['REQUEST_URI'])){
    $_SESSION['redirection'] = $_SERVER['REQUEST_URI'];
}

?>


    <div class="p-lg-5 p-md-3">
        <h2><?php echo _("Bienvenue sur votre compte !") ?></h2>

        <div class="span12 text-center w3-padding-16">
            <?php if (possedeBateau()): ?>
                <a class="btn btn-primary btn-lg"
                   href="vueReservationClient.php?id=<?php echo $_SESSION['id'] ?>"><?php echo _("Consulter mes réservations") ?>
                </a>
                <a class="btn btn-primary btn-lg"
                   href="vueAjouterReservationClient.php?id=<?php echo $_SESSION['id'] ?>"><?php echo _("Reserver") ?></a>
            <?php else: ?>
                <span><i><?php echo _("Veuillez ajouter un bateau pour effectuer une nouvelle reservation...") ?></i></span>
                <br>
                <a href="vueAjouterBateau.php?id=<?php echo $_SESSION['id'] ?>"><?php echo _("Cliquer ici pour ajouter un
                    bateau...") ?></a>
            <?php endif; ?>
        </div>

        <h3><?php echo _("Mes informations: ") ?></h3>

        <div class="border w3-padding-24 p-5">
            <p class="p-l-md"><?php echo _("Prénom: ") ?><?php echo $donneesClient->nom ?></p>
            <p class="p-l-md"><?php echo _("Nom: ") ?><?php echo $donneesClient->prenom ?></p>
            <p class="p-l-md"><?php echo _("Mail: ") ?><?php echo $donneesClient->mail ?></p>
            <p class="p-l-md"><?php echo _("Numéro: ") ?><?php echo $donneesClient->numero ?></p>

        </div>
        <br>
        <div class="span12 text-center w3-padding-16">
            <a class="btn btn-primary btn-lg"
               href="vueModifierClient.php?id=<?php echo $_SESSION['id'] ?>"><?php echo _("Modifier mes informations") ?></a>
        </div>

        <h3><?php echo _("Gestion de mes bateaux :") ?></h3>

        <div class="table-responsive w3-padding-16">
            <table border="2" class="table table-striped table-hover" style="text-align: center;">
                <?php if (isset($donneesBateaux[0])): ?>

                    <thead>
                    <tr>
                        <th><?php echo _("Nom du bateau") ?></th>
                        <th><?php echo _("Type") ?></th>
                        <th><?php echo _("Longueur") ?></th>
                        <th><?php echo _("Largeur") ?></th>
                        <th><?php echo _("Action") ?></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($donneesBateaux as $bateau) : ?>
                        <tr>
                            <td>
                                <?php echo $bateau->nom; ?>
                            </td>
                            <td>
                                <?php echo $bateau->type_bateau; ?>
                            </td>
                            <td>
                                <?php echo $bateau->longueur; ?>
                            </td>
                            <td>
                                <?php echo $bateau->largeur; ?>
                            </td>
                            <td>
                                <div class="modal fade" id="modificationModal<?= $bateau->id; ?>" tabindex="-1"
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
                                                <?php echo _("Impossible de modifier le bateau:\n Votre bateau est possèe une reservation active."); ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal"
                                                        aria-label="Close">
                                                    Annuler
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($donneesBateauxDejaReserver[$bateau->id]) : ?>
                                    <a class="btn btn-outline-secondary" data-toggle="modal"
                                       data-target="#modificationModal<?= $bateau->id; ?>"><?php echo _("Modifier") ?></a>
                                <?php else : ?>
                                    <a class="btn btn-outline-secondary"
                                       href="vueModifierBateau.php?id=<?= $bateau->id; ?>"><?php echo _("Modifier") ?></a>
                                <?php endif; ?>
                                <!-- Modal -->
                                <div class="modal fade" id="suppressionModal<?= $bateau->id; ?>" tabindex="-1"
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
                                                if ($donneesBateauxDejaReserver[$bateau->id]) {
                                                    echo _("Impossible de supprimer le bateau:\n Votre bateau est possede une reservation active.");
                                                } else {
                                                    echo _("Êtes vous sur de vouloir supprimer?");
                                                } ?>
                                            </div>
                                            <div class="modal-footer">
                                                <?php if ($donneesBateauxDejaReserver[$bateau->id]) : ?>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <?php echo _("Annuler")?>
                                                    </button>
                                                <?php else : ?>
                                                    <a href="../fonctions/supprimerBateau.php?id=<?= $bateau->id; ?>"
                                                       class="btn btn-danger"><?php echo _("Supprimer") ?></a>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="btn btn-outline-danger" data-toggle="modal"
                                   data-target="#suppressionModal<?= $bateau->id; ?>"><?php echo _("Supprimer") ?></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                <?php else: ?>
                    <tr>
                        <td><?php echo _("Pas de bateau") ?></td>
                    </tr>
                <?php endif; ?>
            </table>
            <div class="span12 text-center">
                <a class="btn btn-primary btn-lg" href="vueAjouterBateau.php"><?php echo _("Ajouter un bateau") ?></a>
            </div>
        </div>
    </div>


<?php include "footer.php"; ?>