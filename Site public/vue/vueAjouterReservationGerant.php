<?php
include 'headerAdmin.php';

include '../accesseur/EmplacementDAO.php';
include '../accesseur/ReservationDAO.php';

include '../modele/Reservation.php';


$dateDebut = null;
$dateFin = null;
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

//TODO gestion erreurs


if ((isset($dateDebut)) && (isset($dateFin)) && checkDateAAAAMMDD($dateDebut) && checkDateAAAAMMDD($dateFin) && dateCompare($dateDebut, $dateFin)) {


    if (empty($erreurs)) {
        $id_emplacement = emplacementValide($dateDebut, $dateFin);

       if ($id_emplacement != 0) {
           // id_bateau à 0 : le gerant peut reserver sans bateau, donc id spécial
            $reservation = new Reservation($dateDebut, $dateFin, $_SESSION['id'], null, $electricite,$essence,$vidange, $id_emplacement);
            $reservationDAO = new ReservationDAO();
            $reservationDAO->ajouterReservation($reservation);

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
    <h1>Ajouter une réservation :</h1>
    <div class="ajouterreservation">
        <fieldset>
            <legend>Effectuer une nouvelle réservation</legend>

            <form action="vueAjouterReservationGerant.php" method="post">
                <label>Date d'arrivée:
                    <input type="date" name="dateDebut" value="<?php if (isset($_POST['dateDebut'])) echo $_POST['dateDebut'] ?>"/>
                </label>
                </br>
                <label>Date de départ:
                    <input type="date" name="dateFin"
                           value="<?php if (isset($_POST['dateFin'])) echo $_POST['dateFin'] ?>"/>
                </label>

                </br>

                </br>
                <label><u>Services</u></label><br>

                <label>Electricité:
                    <input type="checkbox" name="electricite" <?php if ($electricite) echo ' checked' ?>/>
                </label>
                </br>
                <label>Vidange:
                    <input type="checkbox" name="vidange" <?php if ($vidange) echo ' checked' ?>/>
                </label>
                </br>
                <label>Essence:
                    <input type="checkbox" name="essence" <?php if ($essence) echo ' checked' ?>/>
                </label>
                </br>

                <input type="submit" name="ajouterReservation" value="Effectuer une demande de réservation"/>

            </form>

        </fieldset>
    </div>

<?php include 'footer.php';