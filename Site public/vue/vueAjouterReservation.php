<?php
include 'headerIndex.php';

include '../accesseur/BateauDAO.php';
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



if ((isset($dateDebut)) && (isset($dateFin)) /*&& (isset($id_bateau))*/) {
    echo 'test service';
    $id_service = creerService($electricite,$vidange,$essence);
    /*include '../modele/Reservation.php.php';
    $reservation = new Reservation();

    include '../accesseur/ReservationDAO.php.php';
    $reservationDAO = new ReservationDAO();
    $reservationDAO->ajouterReservation($reservation);

    header('Location: partieClient.php');
    exit();*/
}


function creerService($electricite,$vidange,$essence){
    include '../modele/Service.php';
    $service = new Service($essence,$electricite,$vidange);

    include '../accesseur/ServiceDAO.php';
    $serviceDAO = new ServiceDAO();

    return $serviceDAO->ajouterService($service);
}

?>

    <div class="ajouterbateau">
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
                    <select required>
                        <?php if (isset($donneesBateaux[0])): ?>
                            <option selected="selected">-SELECTIONNEZ VOTRE BATEAU-</option>
                            <?php foreach ($donneesBateaux as $bateau) : ?>
                                <option value="<?php $bateau->id?>"><?php echo $bateau->nom?></option>
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