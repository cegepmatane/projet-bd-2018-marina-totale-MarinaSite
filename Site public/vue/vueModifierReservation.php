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
$electricite = null;
$vidange = null;
$essence = null;
$id_client = null;

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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $reservationAModifier = $reservationDAO->trouverReservation($id);
    $id_client = $reservationAModifier->id_client;
    $donneesBateaux = $bateauDAO->listerBateau($id_client);
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

if ((isset($dateDebut)) && (isset($dateFin)) && checkDateAAAAMMDD($dateDebut) && checkDateAAAAMMDD($dateFin) && dateCompare($dateDebut, $dateFin)) {


    if (empty($erreurs)) {

        $id_emplacement = emplacementValide($dateDebut, $dateFin);

        if ($id_emplacement != 0) {
            // id_bateau à 0 : le gerant peut reserver sans bateau, donc id spécial
            $reservation = new Reservation($dateDebut, $dateFin, $id_client, null, $electricite, $essence, $vidange, $id_emplacement);
            $reservationDAO = new ReservationDAO();
            $reservationDAO->modifierReservation($reservation, $id);
            header('Location: partieGerant.php');
            exit();
        }
    }
} else {
    $erreurs['oui'] = 'oui';
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

function emplacementValide($dateDebut, $dateFin)
{
    $emplacementDAO = new EmplacementDAO();
    $donnees = $emplacementDAO->idEmplacementSelonDate($dateDebut, $dateFin);

    foreach ($donnees as $emplacement) {
        // LISTE DES EMPLACEMENT DISPO SELON DATE
        //if ($emplacementDAO->checkTailleEmplacementSelonBateau($idbateau, $emplacement)) {
        return $emplacement->id;
        //}
    }
    return 0;
}


?>


    <h1>Modifier la réservation :</h1>
    <div class="modifierreservation">
        <fieldset>
            <legend>Modifier une réservation</legend>

            <form action="vueModifierReservation.php?id=<?php echo $id ?>" method="post">
                <label>Date d'arrivée:
                    <input class="form-control" type="date" name="dateDebut"
                           value="<?php echo $reservationAModifier->datedebut; ?>"/>
                </label>
                </br>
                <label>Date de départ:
                    <input class="form-control" type="date" name="dateFin"
                           value="<?php echo $reservationAModifier->datefin; ?>"/>
                </label>

                </br>

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

                </br>
                <label><u>Services</u></label><br>

                <label>Electricité:
                    <input type="checkbox"
                           name="electricite" <?php if ($reservationAModifier->electricite == 1) echo ' checked' ?>/>
                </label>
                </br>
                <label>Vidange:
                    <input type="checkbox"
                           name="vidange" <?php if ($reservationAModifier->vidange == 1) echo ' checked' ?>/>
                </label>
                </br>
                <label>Essence:
                    <input type="checkbox"
                           name="essence" <?php if ($reservationAModifier->essence == 1) echo ' checked' ?>/>
                </label>
                </br>

                <input class="btn btn-primary" type="submit" name="modifierReservation"
                       value="Modifier la réservation"/>

            </form>

        </fieldset>
    </div>

<?php include 'footer.php';