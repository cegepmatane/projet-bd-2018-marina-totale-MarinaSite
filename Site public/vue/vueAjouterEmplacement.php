<?php
include 'header.php';
include '../accesseur/ClientDAO.php';
include '../accesseur/ReservationDAO.php';
include '../accesseur/EmplacementDAO.php';
include '../fonctions/verifAdmin.php';

$label = null;
$longueur = null;
$largeur = null;
$latitude = null;
$longitude = null;

$clientDAO = new ClientDAO();
$reservationDAO = new ReservationDAO();

$donneesReservationEnCours = $reservationDAO->listerReservationEnCours();
$donneesReservationArchivees = $reservationDAO->listerReservationArchivees();
$donneesReservationSelonDate = null;

$emplacementDAO = new EmplacementDAO();
$donneesEmplacements = $emplacementDAO->listerEmplacement();

if ((isset($_POST['label']))) {
    $label = $_POST['label'];
}
if ((isset($_POST['longueur']))) {
    $longueur = $_POST['longueur'];
}
if ((isset($_POST['largeur']))) {
    $largeur = $_POST['largeur'];
}
if ((isset($_POST['lat']))) {
    $latitude = $_POST['lat'];
}
if ((isset($_POST['lng']))) {
    $longitude = $_POST['lng'];
}


if ((isset($_POST['label'])) && (isset($_POST['label'])) && (isset($_POST['label'])) && (isset($_POST['label'])) && (isset($_POST['label']))) {
    include '../modele/Emplacement.php';
    $emplacement = new Emplacement($longueur, $largeur, $latitude, $longitude, $label);

    print_r($emplacement);
    /*
        include '../accesseur/EmplacementDAO.php';
        $emplacementDAO = new EmplacementDAO();*/

    //$emplacementDAO->ajouterEmplacement($emplacement);
    echo 'pk t la twa?..';
    //header('Location: vueEmplacement.php');
    exit();
}

?>
    <div class="ajouterEmplacement p-lg-5 p-md-3">
        <fieldset>
            <legend>Ajouter un nouvel emplacement</legend>

            <form action="vueAjouterEmplacement.php" method="post">
                <label>Label:
                    <input class="form-control" type="text" name="label"
                           value="<?php if (isset($_POST['label'])) echo $_POST['label'] ?>"/>
                </label>
                </br>
                <label>Longueur:
                    <input class="form-control" type="text" name="longueur"
                           value="<?php if (isset($_POST['longueur'])) echo $_POST['longueur'] ?>"/>
                </label>
                </br>
                <label>Largeur:
                    <input class="form-control" type="text" name="largeur"
                           value="<?php if (isset($_POST['largeur'])) echo $_POST['largeur'] ?>"/>
                </label>
                <input type="hidden" id="lat" name="lat">
                <input type="hidden" id="lng" name="lng">
                </br>

                <input class="btn btn-primary" type="submit" name="ajouterEmplacement" value="Ajouter emplacement"/>

            </form>

        </fieldset>
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
                    var marker = new google.maps.Marker({
                        position: null,
                        map: map,
                        title: 'Position choisie'
                    });

                    google.maps.event.addListener(map, 'click', function (event) {
                        marker.setPosition(event.latLng);
                        var lat = event.latLng.lat();
                        lat = lat.toFixed(4);
                        var lng = event.latLng.lng();
                        lng = lng.toFixed(4);
                        console.log("Latitude: " + lat + "  Longitude: " + lng);
                        document.getElementById('lat').value = lat;
                        document.getElementById('lng').value = lng;
                    });




                    <?php foreach ($donneesEmplacements as $emplacement) {
                    $lat = $emplacement->latitude;
                    $long = $emplacement->longitude;
                    echo "var marina" . $emplacement->id . " = {lat: " . $lat . ", lng: " . $long . "};";

                    echo "var contentString" . $emplacement->id . " = '<h3 >Emplacement " . $emplacement->label . "</h3>';
                                    var infowindow" . $emplacement->id . " = new google.maps.InfoWindow({
                                    content: contentString" . $emplacement->id . "
                                    });";
                    echo "var marker" . $emplacement->id . " = new google.maps.Marker({position: marina" . $emplacement->id . ", map: map, icon: pinImageVert});";
                    echo "marker" . $emplacement->id . ".addListener('click', function() {
                                    infowindow" . $emplacement->id . ".open(map, marker" . $emplacement->id . ");
                                });";
                }?>}


            </script>
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbQCiTsS2QS1Brpn12EeiUmiNZZoxj60o&callback=initMap">
            </script>
        </div>
    </div>

<?php include 'footer.php'; ?>