<?php
include 'headerConnexion.php';
include '../accesseur/BateauDAO.php';
include '../accesseur/ServiceDAO.php';
include '../accesseur/EmplacementDAO.php';
include '../accesseur/ReservationDAO.php';

include '../modele/Reservation.php';
include '../modele/Service.php';

$bateauDAO = new BateauDAO();
$donneesBateaux = $bateauDAO->listerBateau($_SESSION['id']);

$dateDebut = null;
$dateFin = null;
$id_bateau = null;
$electricite = null;
$vidange = null;
$essence = null;
$id_service = null;

if ((isset($_POST['dateDebut']))) {
    $dateDebut = $_POST['dateDebut'];
}
if ((isset($_POST['dateFin']))) {
    $dateFin = $_POST['dateFin'];
}
if ((isset($_POST['electricite']))) {
    $electricite = true;
}else{
    $electricite = false;
}
if ((isset($_POST['vidange']))) {
    $vidange = true;
}else{
    $vidange = false;
}
if ((isset($_POST['essence']))) {
    $essence = true;
}else{
    $essence = false;
}
if (isset($_POST['select_bateau']) && $_POST['select_bateau'] != 'default'){
    $id_bateau = $_POST['select_bateau'];
}

//TODO gestion erreurs
if ((isset($dateDebut)) && (isset($dateFin)) && (isset($id_bateau)) && checkDateAAAAMMDD($dateDebut) && checkDateAAAAMMDD($dateFin) && dateCompare($dateDebut,$dateFin)) {
    $id_service = creerService($electricite,$vidange,$essence);




    emplacementValide($dateDebut,$dateFin,$id_bateau);





    //$reservation = new Reservation($dateDebut,$dateFin,$_SESSION['id'],$id_bateau,$id_service);


   /* $reservationDAO = new ReservationDAO();
    $reservationDAO->ajouterReservation($reservation);*/

    /*header('Location: vueReservationClient.php?id='.$_SESSION['id'] .'');
    exit();*/
}


function creerService($electricite,$vidange,$essence){

    $service = new Service($essence,$electricite,$vidange);


    $serviceDAO = new ServiceDAO();

    return $serviceDAO->ajouterService($service);
}

function checkDateAAAAMMDD($date){
    list($y, $m, $d) = array_pad(explode('-', $date, 3), 3, 0);
    return ctype_digit("$y$m$d") && checkdate($m, $d, $y);
}

function dateCompare($dateDebut, $dateFin){
    $dateTimeDebut = new DateTime($dateDebut);
    $dateTimeFin = new DateTime($dateFin);

    return $dateTimeDebut < $dateTimeFin;
}
function emplacementValide($dateDebut, $dateFin, $idbateau){

    $reservationDAO = new ReservationDAO();

    $emplacementDAO = new EmplacementDAO();
    $donnees = $emplacementDAO->emplacementSelonDate($dateDebut,$dateFin);
    foreach ($donnees as $donnee){
        print_r($donnee);
        echo '<br>';
    }

    return;
}


?>

    <div class="ajouterreservation">
        <fieldset>
            <legend>Effectuer une nouvelle réservation</legend>

            <form action="vueAjouterReservation.php" method="post">
                <label>Date d'arrivé:
                    <input type="date" name="dateDebut"/>
                </label>
                </br>
                <label>Date de départ:
                    <input type="date" name="dateFin"/>
                </label>
                </br>
                <label>Bateau:
                    <select name="select_bateau" required>
                        <?php if (isset($donneesBateaux[0])): ?>
                            <option selected="selected" value="default">-SELECTIONNEZ VOTRE BATEAU-</option>
                            <?php foreach ($donneesBateaux as $bateau) : ?>
                                <option value="<?php echo $bateau->id ?>"><?php echo $bateau->nom?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">Pas de bateaux</option>
                        <?php endif; ?>
                    </select>
                </label>
                </br>
                <label><u>Services</u></label><br>

                <label>Electricité:
                    <input type="checkbox" name="electricite"/>
                </label>
                </br>
                <label>Vidange:
                    <input type="checkbox" name="vidange"/>
                </label>
                </br>
                <label>Essence:
                    <input type="checkbox" name="essence"/>
                </label>
                </br>

                <input type="submit" name="ajouterReservation" value="Effectuer une demande de réservation"/>

            </form>

        </fieldset>
    </div>

<?php include 'footer.php';