<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$pageFaq = new faq;
var_dump($_SESSION['user']['id']);

?>

<main>
    <form action="faq.php" method="POST">
            <label>Quelle est la catégorie de votre article ?</label><br /><br />
            <select name="category">
                <?= $pageFaq->selectSousCategory(); ?>
            </select>
            <br /><br />
            <label for="story">
                <h3>Vous avez une question à poser?<br /><br />
                    C'est ici :</h3>
            </label><br /><br />
            <textarea name="questionAPoser" rows="10" cols="66"></textarea><br />
            <input type="submit" name="publier" value="Envoyer ma question">
    </form>
    <?php

        $pageFaq->ShowQuestion();
    if (isset($_POST["publier"]) && !empty($_POST["questionAPoser"])) {
        $pageFaq->AskQuestion();
    }else{
        Echo'Veuillez remplir le formulaire avant pour poser une question';
        return false;
    }
    ?>
</main>
<?php require_once('../html_partials/footer.php');?>