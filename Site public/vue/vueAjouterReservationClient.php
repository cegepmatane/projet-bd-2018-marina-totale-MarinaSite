<?php
include 'header.php';

include '../accesseur/BateauDAO.php';
include '../accesseur/EmplacementDAO.php';
include '../accesseur/ReservationDAO.php';

include '../modele/Reservation.php';

$bateauDAO = new BateauDAO();
$donneesBateaux = $bateauDAO->listerBateau($_SESSION['id']);

$dateDebut = null;
$dateFin = null;
$id_bateau = null;
$id_reservation = null;
$electricite = null;
$vidange = null;
$essence = null;

$erreurs = array();

if ((isset($_POST['dateDebut']))) {
    $dateDebut = $_POST['dateDebut'];
}
if ((isset($_POST['dateFin']))) {
    $dateFin = $_POST['dateFin'];
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
if (isset($_POST['select_bateau']) && $_POST['select_bateau'] != 0) {
    $id_bateau = $_POST['select_bateau'];
}else{
    $erreurs['select_bateau'] = "<div class=\"alert alert-danger\">Veuillez selectionnez un bateau</div>";
}


//TODO gestion erreurs

if (isset($dateFin) && isset($dateDebut) && isset($id_bateau)) {

    if (bateauEstDejaReserverSelonDate($dateDebut, $dateFin, $id_bateau)) {
        $erreurs['bateau_indisponible'] = "<div class=\"alert alert-danger\">Votre bateau est deja réserver sur un emplacement entre ces dates là</div>";
    }

    if (!dateCompareAujourdhui($dateDebut)) {
        $erreurs['dateCompareAujourdhui'] = "<div class=\"alert alert-danger\">La date ne peu pas etre avant la date d'aujourdhui</div>";
    }

    if (!dateCompare($dateDebut, $dateFin)) {
        $erreurs['date_compare'] = "<div class=\"alert alert-danger\">La date d'arrivé doit être posterieur de la date de départ</div>";
    }


}
if (isset($_POST['select_bateau']) && $_POST['select_bateau'] == 0) {
    $erreurs['select_bateau'] = "<div class=\"alert alert-danger\">Veuillez selectionnez un bateau</div>";
}

if ((isset($dateDebut)) && (isset($dateFin)) && (isset($id_bateau))
    && checkDateAAAAMMDD($dateDebut) && checkDateAAAAMMDD($dateFin)
    && dateCompare($dateDebut, $dateFin)
    && dateCompareAujourdhui($dateDebut) && dateCompareAujourdhui($dateFin)
    && !bateauEstDejaReserverSelonDate($dateDebut, $dateFin, $id_bateau)) {


    if (empty($erreurs)) {
        $id_emplacement = emplacementValide($dateDebut, $dateFin, $id_bateau);

        if ($id_emplacement == -1){
            $erreurs['bateau_taille'] = "<div class=\"alert alert-danger\">Votre bateau est trop grand pour les emplacements disponibles a cette date.</div>";
        }
        if ($id_emplacement == 0){
            $erreurs['emplacement_indisponible'] = "<div class=\"alert alert-danger\">Aucun emplacement ne corespond a vos critères</div>";
        }

        if (empty($erreurs)) {
            $reservation = new Reservation($dateDebut, $dateFin, $_SESSION['id'], $id_bateau, $electricite, $essence, $vidange, $id_emplacement);
            $reservationDAO = new ReservationDAO();
            //var_dump($reservation);
            $reservationDAO->ajouterReservation($reservation);

            include '../fonctions/envoyerMail.php';
            ?>

            <?php

            header('Location: vueReservationClient.php?id=' . $_SESSION['id'] .'&'. 'success='.$mail_envoye.'');
            exit();
        }
    }
} else {
    $erreurs['erreur'] = 'ERREUR';
    //print_r($erreurs);
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

function emplacementValide($dateDebut, $dateFin, $idbateau)
{
    $emplacementDAO = new EmplacementDAO();
    $donnees = $emplacementDAO->idEmplacementSelonDate($dateDebut, $dateFin);

    foreach ($donnees as $emplacement) {
        // LISTE DES EMPLACEMENT DISPO SELON DATE
        if ($emplacementDAO->checkTailleEmplacementSelonBateau($idbateau, $emplacement)) {
            return $emplacement->id;
        }else{
            return -1;
        }
    }
    return 0;
}

function bateauEstDejaReserverSelonDate($dateDebut, $dateFin, $id_bateau)
{
    $reservationDAO = new ReservationDAO();
    return $reservationDAO->checkBateauSelonDate($dateDebut, $dateFin, $id_bateau);
}


?>
    <h2>Effectuer une nouvelle demande de réservation :</h2>

    <div class="ajouterreservation">
        <fieldset>

            <form action="vueAjouterReservationClient.php?id=<?php echo $_SESSION['id'] ?>" method="post">



                <div class="form-group">
                    <label>Date d'arrivé:</label>
                    <input type="date" name="dateDebut"
                           value="<?php if (isset($_POST['dateDebut'])) echo $_POST['dateDebut'] ?>"/>
                </div>

                <div class="form-group">
                    <label>Date de départ:</label>
                    <input type="date" name="dateFin"
                           value="<?php if (isset($_POST['dateFin'])) echo $_POST['dateFin'] ?>"/>
                </div>
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
                            <option <?php if (!isset($id_bateau)) {
                                echo ' selected="selected"';
                            } ?> value="0" disabled selected value>- SELECTIONNEZ BATEAU -
                            </option>
                            <?php foreach ($donneesBateaux as $bateau) : ?>
                                <option <?php echo(isset($id_bateau) && ($id_bateau == $bateau->id) ? ' selected="selected"' : ''); ?>
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

                <label><u><b>Services</b></u></label><br>

                <div class="form-group">
                    <label>Electricité :</label>
                    <input type="checkbox" name="electricite" <?php if ($electricite == 1) echo ' checked' ?>/>
                </div>
                <div class="form-group">
                    <label>Vidange :</label>
                    <input type="checkbox" name="vidange" <?php if ($vidange == 1) echo ' checked' ?>/>
                </div>
                <div class="form-group">
                    <label>Essence :</label>
                    <input type="checkbox" name="essence" <?php if ($essence == 1) echo ' checked' ?>/>
                </div>

                <input type="submit" class="btn btn-primary" name="ajouterReservation"
                       value="Effectuer une demande de réservation"/>

                <?php if (isset($erreurs['emplacement_indisponible'])) {
                    echo '<br>'.$erreurs['emplacement_indisponible'];
                } ?>

            </form>

        </fieldset>
    </div>

<?php include 'footer.php';