<?php
session_start();
//https://stackoverflow.com/questions/33775897/how-do-i-install-the-ext-curl-extension-with-php-7
//sudo apt-get install php-curl
//sudo service apache2 restart

// * sudo apt-get install php7.0-mbstring
// https://askubuntu.com/questions/851847/how-to-enable-and-disable-php7-modules-in-linux-server-16-4
//mbstring
//phpenmod moduleName       enables a module to php7 (restart apache after that sudo service apache2 restart)

error_reporting(E_ALL & ~E_NOTICE);

require_once('./lib/stripe/init.php');
require_once('./config.php');

$_SESSION['datedebut'] = $_GET['datedebut'];
$_SESSION['datefin'] = $_GET['datefin'];
?>

<form action="charge.php" method="post">

    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="<?php echo $stripe['publishable_key']; ?>"
            data-description="Access for a year"
            data-amount="5000"
            data-locale="auto">

    </script>

</form>


