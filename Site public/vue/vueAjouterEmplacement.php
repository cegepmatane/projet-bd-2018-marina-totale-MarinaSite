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

$dejaPost = 0;
if (!empty($_POST)) {
    $dejaPost = 1;
}

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

if ($dejaPost == 1){
    //PHP FILTERS
    $label =   filter_var($label, FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
    $longueur =   filter_var($longueur, FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
    $largeur =   filter_var($largeur, FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
    $latitude =   filter_var($latitude, FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);
    $longitude =   filter_var($longitude, FILTER_SANITIZE_STRING, FILTER_FLAG_EMPTY_STRING_NULL);

    if (empty($_POST['lat']) || empty($_POST['lng'])) {
        $erreurs['coord'] = "<div class=\"alert alert-danger\">"._("Veuillez placer une pinouche sur la carte pour donner la position de votre nouvel emplacement.")."</div>";
    }

    if (!preg_match("/^[A-Za-z0-9]{2,}/", $label)) $erreurs['label'] = "<div class=\"alert alert-danger\">"._("Votre label doit faire plus que 2 caractere minimum.")."</div>";
    if (!preg_match("/^[0-9]{1,2}/", $longueur)) $erreurs['longueur'] = "<div class=\"alert alert-danger\">"._("Votre longueur doit faire plus que 2 chiffres maximum et 1 minimum.")."</div>";
    if (!preg_match("/^[0-9]{1,2}/", $largeur)) $erreurs['largeur'] = "<div class=\"alert alert-danger\">"._("Votre largueur doit faire plus que 2 chiffres maximum et 1 minimum.")."</div>";
}

if ((!empty($_POST['label'])) && (!empty($_POST['longueur'])) && (!empty($_POST['largeur'])) && (!empty($_POST['lat'])) && (!empty($_POST['lng']))) {

    include '../modele/Emplacement.php';
    $emplacement = new Emplacement($longueur, $largeur,$latitude,$longitude,$label);
    $emplacementDAO = new EmplacementDAO();

    $emplacementDAO->ajouterEmplacement($emplacement);
    header('Location: vueEmplacement.php');
    exit();
}

?>
    <div class="ajouterEmplacement p-lg-5 p-md-3">

        <fieldset>
            <legend><?php echo _("Ajouter un nouvel emplacement")?></legend>

            <form action="vueAjouterEmplacement.php" method="post">
                <label><?php echo _("Label: ")?>
                    <input class="form-control" type="text" name="label"
                           value="<?php if (isset($_POST['label'])) echo $_POST['label'] ?>"/>
                </label>
                <?php if (isset($erreurs['label'])) {
                    echo $erreurs['label'];
                } ?>
                </br>
                <label><?php echo _("Longueur: ")?>
                    <input class="form-control" type="text" name="longueur"
                           value="<?php if (isset($_POST['longueur'])) echo $_POST['longueur'] ?>"/>
                </label>
                <?php if (isset($erreurs['longueur'])) {
                    echo $erreurs['longueur'];
                } ?>
                </br>
                <label><?php echo _("Largeur: ")?>
                    <input class="form-control" type="text" name="largeur"
                           value="<?php if (isset($_POST['largeur'])) echo $_POST['largeur'] ?>"/>
                </label>
                <?php if (isset($erreurs['largeur'])) {
                    echo $erreurs['largeur'];
                } ?>
                    <input type="hidden" id="lat" name="lat">
                    <input type="hidden" id="lng" name="lng">
                </br>

                <input class="btn btn-primary" type="submit" name="ajouterEmplacement" value="<?php echo _("Ajouter un emplacement ")?>"/>

            </form>

        </fieldset>
        <?php if (isset($erreurs['coord'])) {
            echo $erreurs['coord'];
        } ?>
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

                    echo "var contentString" . $emplacement->id . " = '<h3 >"._("Emplacement: "). $emplacement->label . "</h3>';
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



    </fieldset>


<?php include 'footer.php'; ?>