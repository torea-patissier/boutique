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
        <form action="admin.php" method="POST">    
            <input type="submit" name="articles" value="Gèrer Articles">
            <input type="submit" name="categories" value="Gèrer Categories">
            <input type="submit" name="utilisateurs" value="Gèrer Users">
            <input type="submit" name="codes" value="Gèrer CodesP">
        </form>
<?php 

    if(isset($_POST["articles"])){
        $pageAdmin -> pageArticles();
    }

    if(isset($_POST["categories"])){
        $pageAdmin -> pageCategories();
    }

    if(isset($_POST["utilisateurs"])){
        $pageAdmin -> pageUtilisateurs();
    }

    if(isset($_POST["codes"])){
        $pageAdmin -> pageCodes();
    }
?>
    </main>
    <footer>
    </footer>
</body>
</html>