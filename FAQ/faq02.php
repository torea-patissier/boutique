<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';
$pageFaq2 = new faq;
$val = ($_GET['id']);
$pageFaq2->questionReponse();
?>

<main>
</main>

<?php require_once('../html_partials/footer.php');
?>