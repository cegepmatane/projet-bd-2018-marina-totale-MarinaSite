<?php include 'headerAdmin.php';
include '../accesseur/ClientDAO.php';
include '../accesseur/ReservationDAO.php';
include '../accesseur/EmplacementDAO.php';
include '../fonctions/verifAdmin.php';

$clientDAO = new ClientDAO();
$reservationDAO = new ReservationDAO();
$donneesReservationEnCours = $reservationDAO->listerReservationEnCours();
$donneesReservationArchivees = $reservationDAO->listerReservationArchivees();
$donneesReservationSelonDate = null;
if (isset($_POST["date"])) {
    $donneesReservationSelonDate = $reservationDAO->listerReservationSelonDate($_POST["date"]);
} else {
    $donneesReservationSelonDate = $reservationDAO->listerReservationSelonDate(date('Y-m-d'));
}
$emplacementDAO = new EmplacementDAO();
$donneesEmplacements = $emplacementDAO->listerEmplacement();
?>

<div class="partieGerant">

    <h1> Gestion de la marina</h1>
    Bonjour, <?php echo $clientDAO->trouverClientId($_SESSION['id'])->nom . ' ' . $clientDAO->trouverClientId($_SESSION['id'])->prenom ?>

    <br><br>
    <div class="wb-tabs">
        <div class="tabpanels">
            <details id="details-panel1" open="open">
                <summary>Réservations en cours</summary>


                <div class="row">
                    <table class="table table-hover" border="2">
                        <br>
                        <caption>Récapitulatif des clients ayant des réservations en cours</caption>
                        <?php if (isset($donneesReservationEnCours[0])): ?>
                            <thead>
                            <tr>
                                <th>Prénomm</th>
                                <th>Nom</th>
                                <th>Date début</th>
                                <th>Date fin</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($donneesReservationEnCours as $reservation) : ?>
                                <tr>
                                    <td>
                                        <?php echo $clientDAO->trouverClientId($reservation->id_client)->nom; ?>
                                    </td>
                                    <td>
                                        <?php echo $clientDAO->trouverClientId($reservation->id_client)->prenom; ?>
                                    </td>
                                    <td>
                                        <?php echo $reservation->datedebut; ?>
                                    </td>
                                    <td>
                                        <?php echo $reservation->datefin; ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary"
                                           href="vueModifierReservation.php?id=<?= $reservation->id; ?>">Modifier</a>
                                        <a class="btn btn-primary"
                                           href="../fonctions/supprimerReservation.php?id=<?= $reservation->id; ?>">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        <?php else: ?>
                            <tr>
                                <td>Pas de clients dans la base de données</td>
                            </tr>
                        <?php endif; ?>
                    </table>
                    <br><br>

                    <a class="btn btn-primary" href="vueAjouterReservationGerant.php">Ajouter une réservation</a>
                    &nbsp;
                    <a class="btn btn-primary" href="vueEmplacement.php">Gérer les emplacements</a>
                </div>


            </details>

            <details id="details-panel2">
                <summary>Réservations archivées</summary>

                <div class="row">
                    <table class="table table-hover" border="2">
                        <br>
                        <caption>Récapitulatif des clients ayant des réservations archivées</caption>
                        <?php if (isset($donneesReservationArchivees[0])): ?>
                            <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Date debut</th>
                                <th>Date fin</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($donneesReservationArchivees as $reservation) : ?>
                                <tr>
                                    <td>
                                        <?php echo $clientDAO->trouverClientId($reservation->id_client)->nom; ?>
                                    </td>
                                    <td>
                                        <?php echo $clientDAO->trouverClientId($reservation->id_client)->prenom; ?>
                                    </td>
                                    <td>
                                        <?php echo $reservation->datedebut; ?>
                                    </td>
                                    <td>
                                        <?php echo $reservation->datefin; ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary"
                                           href="../fonctions/supprimerReservation.php?id=<?= $reservation->id; ?>">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        <?php else: ?>
                            <tr>
                                <td>Pas de clients dans la base de données</td>
                            </tr>
                        <?php endif; ?>
                    </table>

                </div>
            </details>
            <form action="partieGerant.php" method="post">
                <input type="date" name="date" value="<?php echo date('Y-m-d');?>">
                <input type="submit" name="submit" value="choisirDate">
            </form>
            <div id="map" style="height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */">
                <script>
                    // Initialize and add the map
                    function initMap() {
                        var marina = {lat: 48.852543, lng: -67.529140};
                        var map = new google.maps.Map(
                            document.getElementById('map'), {
                                zoom: 18,
                                center: marina,
                                mapTypeId: 'satellite',
                            });
                        var pinColorVert = "009900";
                        var pinImageVert = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColorVert,
                            new google.maps.Size(21, 34),
                            new google.maps.Point(0, 0),
                            new google.maps.Point(10, 34));

                        var pinColorRouge = "BE4A47";
                        var pinImageRouge = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColorRouge,
                            new google.maps.Size(21, 34),
                            new google.maps.Point(0, 0),
                            new google.maps.Point(10, 34));
                        <?php foreach ($donneesEmplacements as $emplacement) {
                        $estReserve = false;
                        $lat = $emplacement->latitude;
                        $long = $emplacement->longitude;
                        echo "var marina" . $emplacement->id . " = {lat: " . $lat . ", lng: " . $long . "};";
                        foreach ($donneesReservationSelonDate as $reservation) {
                            if ($reservation->id_emplacement == $emplacement->id) {
                                echo "var contentString" . $emplacement->id . " = '<a href=" . 'VueDetailReservation.php?id=' . $reservation->id . "><h3>Emplacement " . $emplacement->label . "</h3></a>'+
                                    '<p>Reservé depuis: " . $reservation->datedebut . "</p>'+
                                    '<p>Jusqu au: " . $reservation->datefin . "</p>'+
                                    '<p>Electricité: " . ($reservation->electricite == 1 ? "oui" : "non") . "</p>'+
                                    '<p>Vidange: " . ($reservation->vidange == 1 ? "oui" : "non") . "</p>'+
                                    '<p>Essence: " . ($reservation->essence == 1 ? "oui" : "non") . "</p>';
                                    var infowindow" . $emplacement->id . " = new google.maps.InfoWindow({
                                    content: contentString" . $emplacement->id . "
                                    });";

                                echo "var marker" . $emplacement->id . " = new google.maps.Marker({position: marina" . $emplacement->id . ", map: map, icon: pinImageRouge});";

                                echo "marker" . $emplacement->id . ".addListener('click', function() {
                                    infowindow" . $emplacement->id . ".open(map, marker" . $emplacement->id . ");
                                });";

                                $estReserve = true;
                            }
                        }
                        if ($estReserve == false) {
                            echo "var contentString" . $emplacement->id . " = '<h3 >Emplacement " . $emplacement->label . "</h3>'+
                                    '<p>Disponible!</p>';
                                    var infowindow" . $emplacement->id . " = new google.maps.InfoWindow({
                                    content: contentString" . $emplacement->id . "
                                    });";
                            echo "var marker" . $emplacement->id . " = new google.maps.Marker({position: marina" . $emplacement->id . ", map: map, icon: pinImageVert});";
                            echo "marker" . $emplacement->id . ".addListener('click', function() {
                                    infowindow" . $emplacement->id . ".open(map, marker" . $emplacement->id . ");
                                });";
                        }
                    }
                        ?>
                    }

                </script>
                <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbQCiTsS2QS1Brpn12EeiUmiNZZoxj60o&callback=initMap">
                </script>
            </div>


        </div>
    </div>


</div>


<?php include "footer.php"; ?>


