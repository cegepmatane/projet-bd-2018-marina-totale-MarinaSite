<?php
require_once('vendor/autoload.php');

$stripe = array(
  "secret_key"      => "sk_test_4ze01GO5a0M4Y9WqYdzMVKIg",
  "publishable_key" => "pk_test_pSm1ytPZVDPsWKag9q7zZ0no"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>