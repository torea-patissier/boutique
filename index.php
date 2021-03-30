<?php
session_start();
require_once('html_partials/header.index.php');
include 'Classes/search_bar.class.php';
$index = new index;
$index->Recherche();
require_once('html_partials/footer.index.php');
?>