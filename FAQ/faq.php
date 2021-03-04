<?php
session_start();
include '../autoloader.php';
$pageCreate = new faq;
?>
<main>
    <form action="faq.php" method="POST">
        <div class="faq">
            <label>Quelle est la catégorie de votre article ?</label><br /><br />
            <select class="buttonFaq" name="category">
                <?= $pageCreate->selectCategory(); ?>
            </select>
            <br /><br />
            <label for="story">
                <h3>Vous avez une question à poser?<br /><br />
                    C'est ici :</h3>
            </label><br /><br />
            <textarea name="questionAPoser" rows="10" cols="66"></textarea><br />
            <input class="buttonCommentaireArticle" type="submit" name="publier">
        </div>
    </form>
    <?php
    if (isset($_POST["publier"]) && !empty($_POST["newarticle"])) {
        $pageCreate->AskQuestion();
    }
    ?>
</main>