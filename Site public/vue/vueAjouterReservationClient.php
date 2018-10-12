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
if (isset($_POST['select_bateau']) && $_POST['select_bateau'] != 'default') {
    $id_bateau = $_POST['select_bateau'];
    echo 'id bateau '.$id_bateau;
}


//TODO gestion erreurs


if ((isset($dateDebut)) && (isset($dateFin)) && (isset($id_bateau)) && checkDateAAAAMMDD($dateDebut) && checkDateAAAAMMDD($dateFin) && dateCompare($dateDebut, $dateFin)) {


    if (empty($erreurs)) {
        $id_emplacement = emplacementValide($dateDebut, $dateFin, $id_bateau);

        if ($id_emplacement != 0) {
            $reservation = new Reservation($dateDebut, $dateFin, $_SESSION['id'], $id_bateau, $electricite,$essence,$vidange, $id_emplacement);
            $reservationDAO = new ReservationDAO();
            var_dump($reservation);
            $reservationDAO->ajouterReservation($reservation);

            header('Location: vueReservationClient.php?id=' . $_SESSION['id'] . '');
            exit();
        }
    }
}else{
    $erreurs['erreur']='ERREUR';
    print_r($erreurs);
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

function emplacementValide($dateDebut, $dateFin, $idbateau)
{
    $emplacementDAO = new EmplacementDAO();
    $donnees = $emplacementDAO->idEmplacementSelonDate($dateDebut, $dateFin);

    foreach ($donnees as $emplacement) {
        // LISTE DES EMPLACEMENT DISPO SELON DATE
        if ($emplacementDAO->checkTailleEmplacementSelonBateau($idbateau, $emplacement)) {
            return $emplacement->id;
        }
    }
    return 0;
}


?>
    <h1>Ajouter une réservation :</h1>
    <div class="ajouterreservation">
        <fieldset>
            <legend>Effectuer une nouvelle réservation</legend>

            <form action="vueAjouterReservationClient.php?id=<?php echo $_SESSION['id']?>" method="post">
                <label>Date d'arrivé:
                    <input type="date" name="dateDebut" value="<?php if (isset($_POST['dateDebut'])) echo $_POST['dateDebut'] ?>"/>
                </label>
                </br>
                <label>Date de départ:
                    <input type="date" name="dateFin"
                           value="<?php if (isset($_POST['dateFin'])) echo $_POST['dateFin'] ?>"/>
                </label>

                </br>
                <label>Bateau:
                    <select name="select_bateau" required>
                        <?php if (isset($donneesBateaux[0])): ?>
                            <option selected="selected" value="default">-SELECTIONNEZ BATEAU-</option>
                            <?php foreach ($donneesBateaux as $bateau) : ?>
                                <option value="<?php echo $bateau->id ?>"><?php echo $bateau->nom ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">Pas de bateaux</option>
                        <?php endif; ?>
                    </select>
                </label>
                </br>
                <label><u>Services</u></label><br>

                <label>Electricité:
                    <input type="checkbox" name="electricite" <?php if ($electricite == 1) echo ' checked' ?>/>
                </label>
                </br>
                <label>Vidange:
                    <input type="checkbox" name="vidange" <?php if ($vidange == 1) echo ' checked' ?>/>
                </label>
                </br>
                <label>Essence:
                    <input type="checkbox" name="essence" <?php if ($essence == 1) echo ' checked' ?>/>
                </label>
                </br>

                <input type="submit" name="ajouterReservation" value="Effectuer une demande de réservation"/>

            </form>

        </fieldset>
    </div>

<?php include 'footer.php';