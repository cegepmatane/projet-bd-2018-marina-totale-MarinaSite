<?php include 'headerAdmin.php';
include '../accesseur/ClientDAO.php';
include '../accesseur/ReservationDAO.php';
include '../fonctions/verifAdmin.php';

$clientDAO = new ClientDAO();
$reservationDAO = new ReservationDAO();
$donneesReservationEnCours = $reservationDAO->listerReservationEnCours();
$donneesReservationArchivees = $reservationDAO->listerReservationArchivees();
?>

<div class="partieGerant">

    <h1> Gestion de la marina</h1>
    Bonjour, <?php echo  $clientDAO->trouverClientId($_SESSION['id'])->nom.' '.$clientDAO->trouverClientId($_SESSION['id'])->prenom?>

    <br><br>
    <div class="wb-tabs">
        <div class="tabpanels">
            <details id="details-panel1" open="open">
                <summary>Réservations en cours</summary>


                <div class="row">
                    <table class="table table-hover" border="2">
                        <br>
                        <caption>Récapitulatif des clients ayant des réservations en cours</caption>
                            <?php if(isset($donneesReservationEnCours[0])): ?>
                            <thead>
                            <tr><th>Nom</th><th>Prénom</th><th>Date début</th><th>Date fin</th><th>Actions</th></tr>
                            </thead>
                            <tbody>
                            <?php foreach ($donneesReservationEnCours as $reservation) :?>
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
                                        <a class="btn btn-primary" href="vueModifierReservation.php?id=<?=$reservation->id; ?>">Modifier</a>
                                        <a class="btn btn-primary" href="../fonctions/supprimerReservation.php?id=<?=$reservation->id; ?>">Supprimer</a>
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
                            <?php if(isset($donneesReservationArchivees[0])): ?>
                                <thead>
                                <tr><th>Nom</th><th>Prénom</th><th>Date debut</th><th>Date fin</th><th>Action</th></tr>
                                </thead>
                                <tbody>
                                <?php foreach ($donneesReservationArchivees as $reservation) :?>
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
                                            <a class="btn btn-primary" href="../fonctions/supprimerReservation.php?id=<?=$reservation->id; ?>">Supprimer</a>
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
<div id="map" style="height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */">
            <script>
                // Initialize and add the map
                function initMap() {
                    var marina = {lat: 48.852543, lng: -67.529140};
                    var map = new google.maps.Map(
                        document.getElementById('map'), {zoom: 18,
                            center: marina,
                            mapTypeId: 'satellite',
                        });
                    var marina1 = {lat: 48.852399, lng: -67.530745};
                    var marina2 = {lat: 48.852451, lng: -67.530578};
                    var marina3 = {lat: 48.852503, lng: -67.530441};
                    var marina4 = {lat: 48.852541, lng: -67.530260};
                    var marina5 = {lat: 48.852557, lng: -67.530106};
                    var marina6 = {lat: 48.852618, lng: -67.529936};
                    var pinColorVert = "009900";
                    var pinImageVert = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColorVert,
                        new google.maps.Size(21, 34),
                        new google.maps.Point(0,0),
                        new google.maps.Point(10, 34));

                    var pinColorRouge = "BE4A47";
                    var pinImageRouge = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColorRouge,
                        new google.maps.Size(21, 34),
                        new google.maps.Point(0,0),
                        new google.maps.Point(10, 34));

                    var contentString = '<h1 >Emplacement 1</h1>'+
                    '<p>Présentation de l emplacement 1 avec les differents services proposés</p>';

                    var infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });

                    var marker = new google.maps.Marker({position: marina1, map: map, icon: pinImageVert});
                    marker.addListener('click', function() {
                        infowindow.open(map, marker);
                    });
                    var marker1 = new google.maps.Marker({position: marina2, map: map, icon: pinImageRouge});
                    var marker2 = new google.maps.Marker({position: marina3, map: map, icon: pinImageVert});
                    var marker3 = new google.maps.Marker({position: marina4, map: map, icon: pinImageRouge});
                    var marker4 = new google.maps.Marker({position: marina5, map: map, icon: pinImageRouge});
                    var marker5 = new google.maps.Marker({position: marina6, map: map, icon: pinImageVert});
                    //recuperer liste emplacements ->liste emplacement[]
                    //for i allant de 0 au nombre d'emplacements-1:
                        //recuperer emplacement[i]
                        //creer content string: Emplacement i
                                            //  Services: emplacement[i].getservices()
                                            //  Disponibilité: emplacement[i].isDisponible()
                       //if emplacement[i].isDisponible:
                                //marker vert à emplacement[i].getcoordonnées
                                //setlistener avec le content string
                         //else:
                                 //marker rouge à emplacement[i].getcoordonnées avec Content String
                                //setlistener avec le content string

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


