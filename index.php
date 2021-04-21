<?php
session_start();
require_once('html_partials/header.index.php');
echo '<main>';
include 'Classes/search_bar.class.php';
$index = new index;
$index->Recherche();
echo '</main>';
require_once('html_partials/footer.index.php');
?>