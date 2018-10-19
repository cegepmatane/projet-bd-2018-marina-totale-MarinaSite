<?php
include 'header.php';

include '../accesseur/ReservationDAO.php';
include '../accesseur/ClientDAO.php';
include '../accesseur/BateauDAO.php';
include '../accesseur/EmplacementDAO.php';

$reservationDAO = new ReservationDAO();
$bateauDAO = new BateauDAO();
$clientDAO = new ClientDAO();
$emplacementDAO = new EmplacementDAO();

$donneesReservation = $reservationDAO->listerReservationId($_SESSION['id']);

?>
    <!-- Modal -->
    <div class="modal fade" id="success" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Un mail de confirmation vous a été envoyé!
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>


    <div class="p-lg-5 p-md-3">
        <h1>Recapitulatifs de mes réservations :</h1>

        <div class="table-responsive">
            <table border="2" class="table table-striped table-hover">
                <?php if (isset($donneesReservation[0])): ?>
                    <thead>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Date de début de réservation</th>
                        <th>Date de fin de réservation</th>
                        <th>Bateau</th>
                        <th>Emplacement</th>
                        <th>Electricité</th>
                        <th>Essence</th>
                        <th>Vidange</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($donneesReservation as $reservation) : ?>
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
                                <?php echo $bateauDAO->trouverBateau($reservation->id_bateau)->nom ?>
                            </td>
                            <td>
                                <?php echo $emplacementDAO->trouverEmplacement($reservation->id_emplacement)->label ?>
                            </td>
                            <td>
                                <?php if ($reservation->electricite) {
                                    echo 'X';
                                } else echo 'O'; ?>
                            </td>
                            <td>
                                <?php if ($reservation->essence) {
                                    echo 'X';
                                } else echo 'O'; ?>
                            </td>
                            <td>
                                <?php if ($reservation->vidange) {
                                    echo 'X';
                                } else echo 'O'; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                <?php else: ?>
                    <tr>
                        <td>Pas de réservation</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>

        <?php if (isset($_GET['success'])) {
            if ($_GET['success'] == 1) echo
            "<script type='text/javascript'>
               $(document).ready(function () {
            
                $('#success').modal('show');
            
            });
            </script>";
        else
            echo "Il y a eu un problème avec l'envoi du mail de confirmation.";

        } ?>

        <div class="span12">
            <a class="btn btn-outline-secondary btn-lg" style="text-align: center;" href="partieClient.php">Retour</a>

        </div>
    </div>

<?php
require __DIR__ . '/../lib/google-api-php-client-2.2.2/vendor/autoload.php';

if (php_sapi_name() != 'cli') {
    throw new Exception('This application must be run on the command line.');
}

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName('Google Calendar API PHP Quickstart');
    $client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);
    $client->setAuthConfig('credentials.json');
    $client->setAccessType('offline');
    $client->setPrompt('select_account consent');

    // Load previously authorized token from a file, if it exists.
    $tokenPath = 'token.json';
    if (file_exists($tokenPath)) {
        $accessToken = json_decode(file_get_contents($tokenPath), true);
        $client->setAccessToken($accessToken);
    }

    // If there is no previous token or it's expired.
    if ($client->isAccessTokenExpired()) {
        // Refresh the token if possible, else fetch a new one.
        if ($client->getRefreshToken()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            printf("Open the following link in your browser:\n%s\n", $authUrl);
            print 'Enter verification code: ';
            $authCode = trim(fgets(STDIN));

            // Exchange authorization code for an access token.
            $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
            $client->setAccessToken($accessToken);

            // Check to see if there was an error.
            if (array_key_exists('error', $accessToken)) {
                throw new Exception(join(', ', $accessToken));
            }
        }
        // Save the token to a file.
        if (!file_exists(dirname($tokenPath))) {
            mkdir(dirname($tokenPath), 0700, true);
        }
        file_put_contents($tokenPath, json_encode($client->getAccessToken()));
    }
    return $client;
}


// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Calendar($client);

// Print the next 10 events on the user's calendar.
$calendarId = 'primary';
$optParams = array(
    'maxResults' => 10,
    'orderBy' => 'startTime',
    'singleEvents' => true,
    'timeMin' => date('c'),
);
$results = $service->events->listEvents($calendarId, $optParams);
$events = $results->getItems();

if (empty($events)) {
    print "No upcoming events found.\n";
} else {
    print "Upcoming events:\n";
    foreach ($events as $event) {
        $start = $event->start->dateTime;
        if (empty($start)) {
            $start = $event->start->date;
        }
        printf("%s (%s)\n", $event->getSummary(), $start);
    }
}?>
<?php include 'footer.php'; ?>