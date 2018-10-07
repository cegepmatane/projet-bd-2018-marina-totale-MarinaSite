<?php

include 'header.php';
include '../accesseur/ReservationDAO.php';
include '../accesseur/EmplacementDAO.php';

include '../modele/Reservation.php';
$id;
$reservationDAO = new ReservationDAO();


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
}

if ((isset($dateDebut)) && (isset($dateFin)) && checkDateAAAAMMDD($dateDebut) && checkDateAAAAMMDD($dateFin) && dateCompare($dateDebut, $dateFin)) {


    if (empty($erreurs)) {

        $id_emplacement = emplacementValide($dateDebut, $dateFin);

        if ($id_emplacement != 0) {
            // id_bateau à 0 : le gerant peut reserver sans bateau, donc id spécial
            $reservation = new Reservation($dateDebut, $dateFin, $id_client, null, $electricite,$essence,$vidange, $id_emplacement);
            $reservationDAO = new ReservationDAO();
            $reservationDAO->modifierReservation($reservation, $id);
            header('Location: partieGerant.php');
            exit();
        }
    }
}else{
    $erreurs['oui']='oui';
}



function checkDateAAAAMMDD($date){
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
                    <input type="date" name="dateDebut" value="<?php echo $reservationAModifier->datedebut; ?>"/>
                </label>
                </br>
                <label>Date de départ:
                    <input type="date" name="dateFin"
                           value="<?php echo $reservationAModifier->datefin; ?>"/>
                </label>

                </br>

                </br>
                <label><u>Services</u></label><br>

                <label>Electricité:
                    <input type="checkbox" name="electricite" <?php if ($reservationAModifier->electricite == 1) echo ' checked' ?>/>
                </label>
                </br>
                <label>Vidange:
                    <input type="checkbox" name="vidange" <?php if ($reservationAModifier->vidange == 1) echo ' checked' ?>/>
                </label>
                </br>
                <label>Essence:
                    <input type="checkbox" name="essence" <?php if ($reservationAModifier->essence == 1) echo ' checked' ?>/>
                </label>
                </br>

                <input type="submit" name="modifierReservation" value="Modifier la réservation"/>

            </form>

        </fieldset>
    </div>

<?php include 'footer.php';