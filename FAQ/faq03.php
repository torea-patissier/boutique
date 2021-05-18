<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$pageFaq3 = new faq;

if ($id_droits != 2) {
    header('location:http://localhost/boutique/faq/faq02.php');
    exit();
}

$value = $_GET['id'];
?>
<main class="container">
    <h1>Salut <?php echo $_SESSION['user']['prenom']; ?> , pour répondre c'est ici</h1>
    <form action="faq03.php?id=<?php echo $value; ?>" method="POST">
        <div class="row">
            <div class="col s12 m12 l12">
                <textarea name="reponse" rows="10" cols="15"  placeholder="Répondre ici"></textarea><br /><br />
            </div>
        </div>
        <input class="btn black" type="submit" name="answer">
    </form><br /><br />
    <?php
    $pageFaq3->ShowQuestion3();
    echo '<br /><br />';
    if (isset($_POST['answer'])) {
        $pageFaq3->AnswerQuestion();
    } else {
        echo 'Veuillez répondre à la question pour envoyer le formulaire';
    }
    echo '</main>';
    require_once('../html_partials/footer.php');

    ?>