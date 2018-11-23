<?php
include "header.php";

include "../fonctions/envoyerMailNousContacter.php";
?>

<!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">-->
<div class="container">
    <h2 class="text-center">Formulaire de contact</h2>
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 pb-5">


            <!--Form with header-->

            <form action="vueContact.php" method="post">
                <div class="card border-primary rounded-0">
                    <div class="card-header p-0">
                        <div class="bg-info text-white text-center py-2">
                            <h3><i class="fa fa-envelope"></i> Nous écrire</h3>
                            <p class="m-0">Faites nous part de votre demande ou de votre avis sur notre Marina</p>
                        </div>
                    </div>
                    <div class="card-body p-3">

                        <!--Body-->
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                </div>
                                <input type="text" class="form-control" id="nombre" name="nom" placeholder="Nom" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                </div>
                                <input type="email" class="form-control" id="mail" name="email" placeholder="exemple@gmail.com" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                                </div>
                                <textarea name="message" class="form-control" placeholder="Votre message ici..." required></textarea>
                            </div>
                        </div>

                        <div class="text-center">
                            <input type="submit" name="envoyer" value="Envoyer" class="btn btn-info btn-block rounded-0 py-2">
                        </div>
                    </div>

                </div>
            </form>
            <!--Form with header-->


        </div>
    </div>
</div>


<?php

    if (isset($_POST['nom'], $_POST['email'], $_POST['message'], $_POST['envoyer'])){

        $mail_envoye = envoyerMailNousContacter($_POST['nom'], $_POST['email'], $_POST['message']);

        ?> <script> location.replace("http://158.69.113.110/site/vue/index.php"); </script> <?php //header('Location: index.php?success=' .  $mail_envoye.'');
    }

    include 'footer.php';

?>


<!--<meta http-equiv="Location" content="http://158.69.113.110/site/vue/index.php">-->
