<?php

  session_start();

  include '../fonctions/envoyerMail.php';


  require_once('./lib/stripe/init.php');

  require_once('./config.php');

  
  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];

  $customer = \Stripe\Customer::create(array(
      'email' => $email,
      'source'  => $token
  ));

  $charge = \Stripe\Charge::create(array(
      'customer' => $customer->id,
      'amount'   => 5000,
      'currency' => 'usd'
  ));

  echo '<h1>Successfully charged $50.00!</h1>';

  $mail_envoye = envoyerMail("Reservation ajoutee", "Votre réservation a bien été ajoutée sur notre site marina connect ! Elle aura lieu du " .  $_POST['datedebut'] . " au " .  $_POST['datefin'] . ".");

  header( 'refresh:5;url=../vue/vueReservationClient.php?id=' . $_SESSION['id'] . '&' . 'success=' . $mail_envoye );
?> 