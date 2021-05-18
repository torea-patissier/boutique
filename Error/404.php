<?php
session_start();
require_once('../html_partials/header.php');
?>

<body class="body404">
    <main style="text-align: center;">
        <div class="center-align">
            <h1> Erreur 404 </h1>

            <h2>Vous semblez perdu !</h2>

            <h3>La page que vous cherchez n'est pas disponible</h3>
            <button class="btn black"><a class="white-text" href="../index.php">Retour à l'accueil</a></button>
        </div>
  </main><br/><br/><br/>
</body><br /><br /><br />
<?php
require_once('../html_partials/footer.php');
?>