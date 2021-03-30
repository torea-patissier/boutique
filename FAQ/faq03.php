<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$pageFaq3 = new faq;
$pageFaq3->ShowQuestion3();
echo'<pre>';
echo'</pre>';
$value = $_GET['id'];



?>
<main>
    <form action="faq03.php?id=<?php echo $value;?>" method="POST">
        <textarea name="reponse" cols="45" rows="10" placeholder="Répondre ici"></textarea><br /><br />
        <input type="submit" name="answer">
    </form>

</main>
<?php
if(isset($_POST['answer'])){
    $pageFaq3->AnswerQuestion();
}else{
    echo'Veuillez répondre à la question pour envoyer le formulaire';
    return false;
}
require_once('../html_partials/footer.php');

?>