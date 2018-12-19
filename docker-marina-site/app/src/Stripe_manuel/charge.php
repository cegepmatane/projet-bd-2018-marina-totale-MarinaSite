<?php

session_start();

include '../fonctions/envoyerMail.php';


require_once('../lib/stripe/init.php');

require_once('./config.php');


$token  = $_POST['stripeToken'];
$email  = $_POST['stripeEmail'];

$customer = \Stripe\Customer::create(array(
    'email' => $email,
    'source'  => $token
));

$charge = \Stripe\Charge::create(array(
    'customer' => $customer->id,
    'amount'   => $_SESSION['montant'],
    'currency' => 'usd'

));

include '../vue/header.php';

$lien_vers_reservation = "<a href='http://158.69.113.110/site/vue/vueReservationDetailClient.php?idreservation=" . $_SESSION['idreservation'] . "'>Détails de votre réservation</a>";


$mail_envoye = envoyerMail("Reservation ajoutee", "Votre réservation a bien été ajoutée sur notre site marina connect ! Elle aura lieu du " .  $_SESSION['datedebut'] . " au " .  $_SESSION['datefin'] . ". " . $lien_vers_reservation);

//nettoyer $_Session
$_SESSION['datedebut'] = null;
$_SESSION['datefin'] = null;
$_SESSION['idreservation'] = null;


header( 'refresh:5;url=../vue/vueReservationClient.php?id=' . $_SESSION['id'] . '&' . 'success=' . $mail_envoye );
?>

<h1 class="text-justify">Le payement de <?php echo $_SESSION['montant'] ?>$ a été effectué avec succès !</h1><br>

<h3 class="text-justify">Vous allez être redirigés dans 5 secondes vers votre page client</h3>

<?php

$_SESSION['montant'] = null;


include '../vue/footer.php'; ?>
