<?php
session_start();
require_once('../html_partials/header.php');
include '../autoloader.php';

?>
<body id="faq02img">

<main class="container">
<h2>Les questions qui sont souvent posés concernant ce produit: </h2><br />
<?php
$pageFaq2 = new faq;
$val = ($_GET['id']);
$pageFaq2->questionReponse();

?>
<div class="container"></div>
</main>

</body>

<?php require_once('../html_partials/footer.php');
?>