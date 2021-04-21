<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$pageFaq = new faq;
?>
<script type="text/javascript">
      $(document).ready(function(){
    $('select').formSelect();
  });
</script>
<main class="container">
    <div class="input-field col s12">
        <select>
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>
        </select>
        <label>Materialize Select</label>
    </div><br /><br />
    <h4>Vous avez une question à poser ?</h4><br />

    <form action="faq.php" method="POST">
        <!-- <label>Quelle est la catégorie de votre article ?</label><br /><br /> -->
        <select name="category" class="browser-default">
            <option class="col s12 m6 l6">Sélectionnez la sous-catégorie</option>
            <?php $pageFaq->selectSousCategory(); ?>
        </select>
        <label for="story">
        </label>
        <textarea class="txtareaFaq" name="questionAPoser" rows="10" cols="40"></textarea><br /><br />
        <div class="center-align"> <input class="btn black" type="submit" name="publier" value="Envoyer ma question"> </div><br /><br />
    </form>

    <?php

    $pageFaq->ShowQuestion();
    if (isset($_POST["publier"]) && !empty($_POST["questionAPoser"])) {
        $pageFaq->AskQuestion();
    }
    ?>
</main>
<?php require_once('../html_partials/footer.php'); ?>