<?php
include 'header.php';

$label = null;
$longueur = null;
$largeur = null;


if ((isset($_POST['label']))) {
    $label = $_POST['label'];
}
if ((isset($_POST['longueur']))) {
    $longueur = $_POST['longueur'];
}
if ((isset($_POST['largeur']))) {
    $largeur = $_POST['largeur'];
}

if ((isset($label)) && (isset($longueur)) && (isset($largeur))) {
    include '../modele/Emplacement.php';
    $emplacement = new Emplacement($longueur, $largeur, $label);

    print_r($emplacement);

    include '../accesseur/EmplacementDAO.php';
    $emplacementDAO = new EmplacementDAO();

    $emplacementDAO->ajouterEmplacement($emplacement);

   header('Location: vueEmplacement.php');
    exit();
}

?>
    <div class="ajouterEmplacement">
        <fieldset>
            <legend>Ajouter un nouvel emplacement</legend>

            <form action="vueAjouterEmplacement.php" method="post">
                <label>Label:
                    <input class="form-control" type="text" name="label" value="<?php if (isset($_POST['label'])) echo $_POST['label'] ?>"/>
                </label>
                </br>
                <label>Longueur:
                    <input class="form-control" type="text" name="longueur" value="<?php if (isset($_POST['longueur'])) echo $_POST['longueur'] ?>"/>
                </label>
                </br>
                <label>Largeur:
                    <input class="form-control" type="text" name="largeur" value="<?php if (isset($_POST['largeur'])) echo $_POST['largeur'] ?>"/>
                </label>

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
                    var marker = new google.maps.Marker({
                        position: null,
                        map: map,
                        title: 'Position choisie'
                    });

                    google.maps.event.addListener(map, 'click', function (event) {
                        displayCoordinates(event.latLng);
                        marker.setPosition(event.latLng);
                    });

                    function displayCoordinates(pnt) {

                        var lat = pnt.lat();
                        lat = lat.toFixed(4);
                        var lng = pnt.lng();
                        lng = lng.toFixed(4);
                        console.log("Latitude: " + lat + "  Longitude: " + lng);
                    }
                }


            </script>
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbQCiTsS2QS1Brpn12EeiUmiNZZoxj60o&callback=initMap">
            </script>
        </div>
    </div>

<?php include 'footer.php';