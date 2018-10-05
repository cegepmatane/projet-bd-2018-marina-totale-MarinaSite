<!DOCTYPE html>
<html>
<title>Pêche dur la rivière Matane</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}
    .w3-sidebar {
        z-index: 3;
        width: 250px;
        top: 43px;
        bottom: 0;
        height: inherit;
    }
</style>
<body>

<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
        <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
        <a href="index.php" class="w3-bar-item w3-button w3-theme-l1">Marina Connect&trade;</a>
    </div>
</div>

<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
        <i class="fa fa-remove"></i>
    </a>
    <h4 class="w3-bar-item"><b>Menu</b></h4>
    <a class="w3-bar-item w3-button w3-hover-black" href="prezPeche.php">Pêche</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="prezTraversee.php">Traversée</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="prezSecurite.php">Sécurité</a>
    <a class="w3-bar-item w3-button w3-hover-black" href="connexion.php">Reserver ! </a>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:250px">

    <div class="w3-row w3-padding-64">
        <div class="w3-twothird w3-container">
            <h1 class="w3-text-teal">La rivière Matane, paradis pour pêcheurs</h1>
            <p>La rivière Matane est l’une des meilleures rivières à saumon au Québec. En plus d’être parmi les rivières où il remonte le plus de saumons annuellement, sa grande accessibilité et la facilité pour la pêcher permettent d’être l’endroit par excellence pour s’initier à ce sport.
            </p>
            <p>
            La rivière Matane c’est :</br>
            • Une rivière exceptionnelle située à seulement 4 heures de route de Québec;</br>
            • 80 fosses à saumon;</br>
            • 8 secteurs de pêche, dont 4 secteurs contingentés;</br>
            • 2 500 saumons qui remontent la rivière annuellement;</br>
            • Pouvoir pêcher autant dans un environnement urbain que d'être en plein coeur de la forêt;</br>
            • Être dans un endroit offrant des installations de qualité et un excellent service aux pêcheurs;
            </p>
            <p>
                La rivière Matane, c’est surtout l’endroit parfait pour vivre une expérience de pêche mémorable.</br</p>

               <p> Pêcher sur la rivière Matane, c'est un plaisir facilement accessible!</p>
        </div>
        <div class="w3-third w3-container">
            <img class="w3-border w3-padding-large w3-padding-32 w3-center" src="../img/peche.png">
        </div>
    </div>
    <div class="w3-row w3-padding-64">
        <div class="w3-twothird w3-container">
            <h1 class="w3-text-teal">Informations complémentaires:</h1>
            <br>
            <p>
                <a href="http://rivierematane.com">Site de la rivière Matane</a>, expliquant toutes les modalités nécessaires</br>
                <a href="https://www.pac.dfo-mpo.gc.ca/fm-gp/rec/licence-permis/index-fra.html">Informations sur le permis de pêche</a>, site du gouvernement Canadien</br>

            </p>
        </div>
    </div>




    <footer id="myFooter">
        <div class="w3-container w3-theme-l2 w3-padding-25">
            <h4>La Marina de Matane, un espace de détente fort en couleurs!</h4>
        </div>
    </footer>

    <!-- END MAIN -->
</div>

<script>
    // Get the Sidebar
    var mySidebar = document.getElementById("mySidebar");

    // Get the DIV with overlay effect
    var overlayBg = document.getElementById("myOverlay");

    // Toggle between showing and hiding the sidebar, and add overlay effect
    function w3_open() {
        if (mySidebar.style.display === 'block') {
            mySidebar.style.display = 'none';
            overlayBg.style.display = "none";
        } else {
            mySidebar.style.display = 'block';
            overlayBg.style.display = "block";
        }
    }

    // Close the sidebar with the close button
    function w3_close() {
        mySidebar.style.display = "none";
        overlayBg.style.display = "none";
    }
</script>

</body>
</html>
