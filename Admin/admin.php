<?php session_start(); 

include "../Classes/admin.class.php"; 

$pageAdmin = new gestion;
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BACK OFFICE ADMIN</title>
</head>
<body>
    <header>
    </header>
    <main>
        <h1> BACK OFFICE ADMIN </h1>
        <form action="" method="POST">    
            <input type="submit" name="articles" value="Gèrer Articles">
            <input type="submit" name="categories" value="Gèrer Categories">
            <input type="submit" name="utilisateurs" value="Gèrer Users">
            <input type="submit" name="codes" value="Gèrer CodesP">
        </form>
<?php 

    if(isset($_POST["articles"])){
        header('Location: http://localhost/boutique/Gestion_article/gestion_article.php');
    }

    if(isset($_POST["categories"])){
        header('Location: http://localhost/boutique/Gestion_categorie/gestion_categorie.php');
    }

    if(isset($_POST["utilisateurs"])){
        header('Location: http://localhost/boutique/Gestion_utilisateur/gestion_utilisateur.php');
    }

    if(isset($_POST["codes"])){
        header('Location: http://localhost/boutique/Codes_promo/codes_promo.php');
    }

?>
    </main>
    <footer>
    </footer>
</body>
</html>