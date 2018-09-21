/**
 * Created by PhpStorm.
 * User: 1832527
 * Date: 21/09/2018
 * Time: 13:33
 */

<?php include 'header.php';
if (isset($_SESSION['pseudo'])){?>
Bonjour, <?php echo  $_SESSION['pseudo']?>






<?php }
include "footer.php"; ?>