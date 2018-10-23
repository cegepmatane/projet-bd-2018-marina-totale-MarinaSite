<?php

include 'headerAdmin.php';
include '../accesseur/ReservationDAO.php';
include '../accesseur/EmplacementDAO.php';
include '../accesseur/BateauDAO.php';

include '../modele/Reservation.php';

$id;
$reservationDAO = new ReservationDAO();
$bateauDAO = new BateauDAO();

$dateDebut = null;
$dateFin = null;
$id_bateau = null;
$electricite = null;
$vidange = null;
$essence = null;
$id_client = null;

$dejaPost = 0;
if (!empty($_POST)) {
    $dejaPost = 1;
}

$erreurs = array();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $reservationAModifier = $reservationDAO->trouverReservation($id);
    $id_client = $reservationAModifier->id_client;
    $id_bateau = $reservationAModifier->id_bateau;

    $donneesBateaux = $bateauDAO->listerBateau($id_client);
}

if ((isset($_POST['dateDebut']))) {
    $dateDebut = $_POST['dateDebut'];
}
if ((isset($_POST['dateFin']))) {
    $dateFin = $_POST['dateFin'];
}
if (isset($_POST['select_bateau'])) {
    if ($_POST['select_bateau'] != 0) {
        $id_bateau = $_POST['select_bateau'];
    }
}
if ((isset($_POST['electricite']))) {
    $electricite = 1;
} else {
    $electricite = 0;
}
if ((isset($_POST['vidange']))) {
    $vidange = 1;
} else {
    $vidange = 0;
}
if ((isset($_POST['essence']))) {
    $essence = 1;
} else {
    $essence = 0;
}



//gestion erreurs


if (!isset($id_bateau)) {
    $erreurs['select_bateau'] = "<div class=\"alert alert-danger\">Veuillez selectionnez un bateau</div>";
}

if (isset($dateDebut) && !checkDateAAAAMMDD($dateDebut)) {
    $erreurs['format_date_debut'] = '<div class="alert alert-danger">Veuillez rentrer une date d\'arrivé valide au format YYY-MM-DD</div>';
}
if (isset($dateFin) && !checkDateAAAAMMDD($dateFin)) {
    $erreurs['format_date_fin'] = '<div class="alert alert-danger">Veuillez rentrer une date de départ valide au format YYY-MM-DD</div>';
}

if (isset($dateFin) && isset($dateDebut) && isset($id_bateau)
    && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $dateDebut)
    && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $dateFin)) {

    if (!dateCompareAujourdhui($dateDebut)) {
        $erreurs['dateCompareAujourdhui'] = "<div class=\"alert alert-danger\">La date ne peu pas etre avant la date d'aujourdhui</div>";
    }

    if (!dateCompare($dateDebut, $dateFin)) {
        $erreurs['date_compare'] = "<div class=\"alert alert-danger\">La date d'arrivé doit être posterieur de la date de départ</div>";
    }
}


if ((isset($dateDebut)) && (isset($dateFin)) && (isset($id_bateau))
    && checkDateAAAAMMDD($dateDebut) && checkDateAAAAMMDD($dateFin)
    && dateCompare($dateDebut, $dateFin)
    && dateCompareAujourdhui($dateDebut) && dateCompareAujourdhui($dateFin)
    && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $dateDebut)
    && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $dateFin)) {


    if (empty($erreurs)) {

        $id_emplacement = emplacementValide($dateDebut, $dateFin, $id_bateau, $reservationAModifier->id);

        if ($id_emplacement == -1) {
            $erreurs['bateau_taille'] = "<div class=\"alert alert-danger\">Votre bateau est trop grand pour les emplacements disponibles a cette date.</div>";
        }
        if ($id_emplacement == 0) {
            $erreurs['emplacement_indisponible'] = "<div class=\"alert alert-danger\">Aucun emplacement ne corespond a vos critères</div>";
        }

        if (empty($erreurs)) {
            $reservation = new Reservation($dateDebut, $dateFin, $id_client, $id_bateau, $electricite, $essence, $vidange, $id_emplacement);
            $reservationDAO = new ReservationDAO();
            $reservationDAO->modifierReservation($reservation, $id);

            var_dump($reservation);

            //enovie mail info modif

            //header('Location: partieGerant.php');
            exit();
        }
    }
} else {
    $erreurs['oui'] = 'oui';
}

function dateCompareAujourdhui($date)
{
    return time() - (60 * 60 * 24) < strtotime($date);
}

function checkDateAAAAMMDD($date)
{
    list($y, $m, $d) = array_pad(explode('-', $date, 3), 3, 0);
    return ctype_digit("$y$m$d") && checkdate($m, $d, $y);
}

function dateCompare($dateDebut, $dateFin)
{
    $dateTimeDebut = new DateTime($dateDebut);
    $dateTimeFin = new DateTime($dateFin);

    return $dateTimeDebut < $dateTimeFin;
}

function emplacementValide($dateDebut, $dateFin, $idbateau, $idreservation)
{
    $emplacementDAO = new EmplacementDAO();
    $donnees = $emplacementDAO->idEmplacementSelonDateSelonReservation($dateDebut, $dateFin, $idreservation);

    foreach ($donnees as $emplacement) {
        // LISTE DES EMPLACEMENT DISPO SELON DATE
        if ($emplacementDAO->checkTailleEmplacementSelonBateau($idbateau, $emplacement)) {
            return $emplacement->id;
        } else {
            return -1;
        }
    }
    return 0;
}

?>

    <h1>Modifier la réservation :</h1>
    <div class="modifierreservation">
        <fieldset>

            <form action="vueModifierReservation.php?id=<?php echo $id ?>" method="post">

                <div class="form-group">
                    <label>Date d'arrivée:
                        <input class="form-control" type="date" name="dateDebut"
                               value="<?php if (isset($_POST['dateDebut'])) {
                                   echo $_POST['dateDebut'];
                               } else {
                                   echo $reservationAModifier->datedebut;
                               } ?>"/>
                    </label>
                </div>

                <?php if (isset($erreurs['format_date_debut'])) {
                    echo $erreurs['format_date_debut'];
                } ?>

                <div class="form-group">
                    <label>Date de départ:
                        <input class="form-control" type="date" name="dateFin"
                               value="<?php if (isset($_POST['dateFin'])) {
                                   echo $_POST['dateFin'];
                               } else {
                                   echo $reservationAModifier->datefin;
                               } ?>"/>
                    </label>
                </div>

                <?php if (isset($erreurs['format_date_fin'])) {
                    echo $erreurs['format_date_fin'];
                } ?>
                <?php if (isset($erreurs['dateCompareAujourdhui'])) {
                    echo $erreurs['dateCompareAujourdhui'];
                } ?>
                <?php if (isset($erreurs['date_compare'])) {
                    echo $erreurs['date_compare'];
                } ?>

                <div class="form-group">
                    <label>Bateau : </label>
                    <select name="select_bateau" required>
                        <?php if (isset($donneesBateaux[0])): ?>
                            <?php foreach ($donneesBateaux as $bateau) : ?>
                                <option <?php
                                echo ($reservationAModifier->id_bateau == $bateau->id) ? ' selected="selected"' : ''; ?>
                                        value="<?php echo $bateau->id ?>"><?php echo $bateau->nom . ' (' . $bateau->type_bateau . ')' ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">Pas de bateaux...</option>
                        <?php endif; ?>
                    </select>
                </div>

                <?php if (isset($erreurs['bateau_indisponible'])) {
                    echo $erreurs['bateau_indisponible'];
                } ?>

                <?php if (isset($erreurs['select_bateau'])) {
                    echo $erreurs['select_bateau'];
                } ?>

                <?php if (isset($erreurs['bateau_taille'])) {
                    echo $erreurs['bateau_taille'];
                } ?>

                <label><u>Services</u></label><br>
                <div class="form-group">
                    <label>Electricité:
                        <input type="checkbox"
                               name="electricite" <?php
                        if ($dejaPost == 1) {
                            if (isset($_POST['electricite'])) {
                                echo ' checked';
                            }
                        } else {
                            if ($reservationAModifier->electricite == 1) {
                                echo ' checked';
                            }
                        } ?>/>
                    </label>
                </div>

                <div class="form-group">
                    <label>Vidange:
                        <input type="checkbox"
                               name="vidange" <?php
                        if ($dejaPost == 1) {
                            if (isset($_POST['vidange'])) {
                                echo ' checked';
                            }
                        } else {
                            if ($reservationAModifier->vidange == 1) {
                                echo ' checked';
                            }
                        } ?>/>
                    </label>
                </div>

                <div class="form-group">
                    <label>Essence:
                        <input type="checkbox"
                               name="essence" <?php
                        if ($dejaPost == 1) {
                            if (isset($_POST['essence'])) {
                                echo ' checked';
                            }
                        } else {
                            if ($reservationAModifier->essence == 1) {
                                echo ' checked';
                            }
                        } ?>/>
                    </label>
                </div>

                <?php if (isset($erreurs['emplacement_indisponible'])) {
                    echo '<br>' . $erreurs['emplacement_indisponible'];
                } ?>

                <input class="btn btn-primary" type="submit" name="modifierReservation"
                       value="Modifier la réservation"/>

            </form>

        </fieldset>
    </div>

<?php include 'footer.php';