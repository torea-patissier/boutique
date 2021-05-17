<?php
require_once('../Classes/bdd.class.php');
class admin extends bdd {
        // Function pour s'inscrire
    public function pageArticles()
    {
        Header('Location : http://localhost:8888/boutique/Gestion_article/gestion_article.php');
    }

    public function pageCategories()
    {
        Header('Location : http://localhost:8888/boutique/Gestion_categorie/gestion_categorie.php');
    }

    public function pageUtilisateurs()
    {
        Header('Location : http://localhost:8888/boutique/Gestion_utilisateur/gestion_utilisateur.php');
    }

    public function pageCodes()
    {
        Header('Location : http://localhost:8888/boutique/Codes_promo/codes_promo.php');
    }

}

?>