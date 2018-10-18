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

<div class="partieGerant p-lg-5 p-md-3">

    <h1> Gestion de la marina</h1>

    Bonjour, <?php echo $clientDAO->trouverClientId($_SESSION['id'])->nom . ' ' . $clientDAO->trouverClientId($_SESSION['id'])->prenom ?>
    <br>
    <div style="text-align: center;">
        <a class="btn btn-primary btn-lg m-1" href="vueAjouterReservationGerant.php">Fermer un emplacement</a> &nbsp;
        <a class="btn btn-primary btn-lg m-1" href="vueEmplacement.php">Gérer les emplacements</a>
    </div>
    <div class="wb-tabs">
        <div class="tabpanels">
            <details id="details-panel1" open="open">
                <summary>Réservations en cours</summary>


                <div class="table-responsive">
                    <table class="table table-striped table-hover" border="2" style="text-align: center;">
                        <?php if (isset($donneesReservationEnCours[0])): ?>
                            <thead>
                            <tr>
                                <th>Prénom</th>
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
                                        <a class="btn btn-outline-secondary"
                                           href="vueModifierReservation.php?id=<?= $reservation->id; ?>">Modifier</a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?=$reservation->id;?>" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Êtes vous sur de vouloir supprimer?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="../fonctions/supprimerReservation.php?id=<?= $reservation->id; ?>"
                                                           class="btn btn-danger">Supprimer
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="btn btn-outline-danger" data-toggle="modal"
                                           data-target="#exampleModal<?=$reservation->id;?>">Supprimer</a>
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

            <details id="details-panel2">
                <summary>Réservations archivées</summary>

                <div class="table-responsive">
                    <table class="table table-striped table-hover" border="2" style="text-align: center;">
                        <?php if (isset($donneesReservationArchivees[0])): ?>
                            <thead>
                            <tr>
                                <th>Prénom</th>
                                <th>Nom</th>
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
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?=$reservation->id;?>" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Êtes vous sur de vouloir supprimer?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="../fonctions/supprimerReservation.php?id=<?= $reservation->id; ?>"
                                                           class="btn btn-danger">Supprimer
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="btn btn-outline-danger" data-toggle="modal"
                                           data-target="#exampleModal<?=$reservation->id;?>">Supprimer</a>
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
            <br>
            <h3>Carte des réservations de la marina:</h3>
            <div class="container">
                <form action="partieGerant.php" method="post">
                    <div class="row justify-content-start">
                        <div class="col-sm-4">
                            <input class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>" name="date">
                        </div>
                        <div class="col-sm-4">
                            <input class="btn btn-outline-primary btn-sm m-1" type="submit" name="submit"
                                   value="Actualiser la carte">
                        </div>
                    </div>
                </form>
            </div>
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
                                mapTypeControl: false,
                                streetViewControl: false,
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


