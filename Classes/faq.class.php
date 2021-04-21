<?php

require_once("bdd.class.php");

class faq extends bdd
{
    // Envoyer une question en Bdd 
    function AskQuestion()
    {
        $question = htmlspecialchars($_POST["questionAPoser"]); //
        $date = date("Y-m-d H:i:s"); //
        $idUser = $_SESSION["user"]["id"]; //Je récupère l'user id dans ma variable session
        $idCategorie = htmlspecialchars($_POST['category']);
        var_dump($idCategorie);
        $con = $this->connectDb(); // Connexion Db 
        $stmt = $con->prepare("INSERT INTO faq_question (id_utilisateurQ, question, dateQ, id_sous_categorie)
                 VALUES (:id_utilisateurQ, :question, :date, :id_sous_categorie)");
        $stmt->bindValue('id_utilisateurQ', $idUser, PDO::PARAM_INT);
        $stmt->bindValue('question', $question, PDO::PARAM_STR);
        $stmt->bindValue('date', $date, PDO::PARAM_STR);
        $stmt->bindValue('id_sous_categorie', $idCategorie, PDO::PARAM_INT);
        $stmt->execute();
        header("Refresh: 0;url=http://localhost:8888/boutique/faq/faq.php");
    }

    // Sélectionner la sous catégorie pour la question posés
    function selectSousCategory()
    {
        $con = $this->connectDb(); // Connexion Db 
        $stmt = $con->prepare("SELECT * FROM sous_categories"); // Requete
        $stmt->execute(); //J'éxécute la requete
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //Result devient un tableau des valeurs obtenues

        foreach ($result as $resultat) {
            $categorie = $resultat["nom"];
            $idCategorie = $resultat["id"];
            echo "<option class='col s12 m6 l6' value='$idCategorie'>$categorie</option>";
        }
    }


    // Afficher les questions posés enregistré en Bdd classé par Catégorie/Sous catégorie
    function ShowQuestion()
    {
        $con = $this->connectDb();
        $req0 = $con->prepare("SELECT * FROM categories");
        $req2 = $con->prepare("SELECT * FROM sous_categories");

        $req0->execute();
        $req2->execute();

        $result0 = $req0->fetchAll();
        $result2 = $req2->fetchAll();

        //Boucle pour affichr les catégories
        foreach ($result0 as $resultat0) {

            $id_categorie = $resultat0['id'];
            $categorie = $resultat0['nom'];
            echo '<hr />' . '<b>Catégorie : ' . $categorie . '</b><br />' . '<br />' . '<br />';

            //Boucle pour afficher les sous catégories
            foreach ($result2 as $resultat) {

                $id_categoriee = $resultat['id_categories'];
                $id_sous_categorie = $resultat['id'];
                $nom = $resultat['nom'];

                if ($id_categorie == $id_categoriee) {
                    echo 'Sous catégorie : ' . '<a class="href_admin" href="../faq/faq02.php?id=' . $id_sous_categorie . '"><b>' . $nom . '</b></a>' . '<br />' . '<br />';
                }
            }
        }
    }

    // Montrer la liste de toutes les question de la sous-catégorie
    function questionReponse()
    {
        $con = $this->connectDb(); // Connexion Db 
        $req = $con->prepare('SELECT * FROM faq_reponse INNER JOIN faq_question ON faq_reponse.id_question = faq_question.id');
        $req2 = $con->prepare("SELECT * FROM faq_question WHERE id_sous_categorie = '" . $_GET['id'] . "' ");
        $req->execute();
        $req2->execute();
        $result1 = $req->fetchAll();
        $result2 = $req2->fetchAll();

        foreach ($result2 as $resultat) {
            
            $id_question = $resultat['id'];
            $question = $resultat['question'];
            echo 'Question : ' . ' <a class="href_admin" href="../faq/faq03.php?id=' . $id_question . '">' . $question . '</a>' . '<br />';

                foreach($result1 as $resultat){

                    $reponse = $resultat['reponse'];
                    $id_reponse = $resultat['id_question'];

                        if($id_question == $id_reponse){
                            
                            // echo $id_question;
                            echo  "Réponse : " . $reponse . '<br/>' . '<br/>';
                        }
                }
        }
    }

    //Montrer une question, et y répondre
    function ShowQuestion3()
    {
        $con = $this->connectDb();
        $req = $con->prepare("SELECT * FROM faq_question WHERE id = '" . $_GET['id'] . "' ");
        $req->execute(); 
        $result = $req->fetchAll();

        foreach ($result as $res) {
            $question = $res['question'];
            echo $question;
        }
    }

    function  AnswerQuestion()
    {
        $reponse = htmlspecialchars($_POST["reponse"]); //
        $date = date("Y-m-d H:i:s"); //
        $idUser = $_SESSION["user"]["id"]; //Je récupère l'user id dans ma variable session
        $id_question = $_GET["id"];
        $con = $this->connectDb(); // Connexion Db 
        $stmt = $con->prepare("INSERT INTO faq_reponse (id_utilisateurR, reponse, dateR, id_question)VALUES(:id_utilisateurR, :reponse, :dateR, :id_question)");
        $stmt->bindValue('id_utilisateurR', $idUser, PDO::PARAM_INT);
        $stmt->bindValue('reponse', $reponse, PDO::PARAM_STR);
        $stmt->bindValue('dateR', $date, PDO::PARAM_STR);
        $stmt->bindValue('id_question', $id_question, PDO::PARAM_INT);
        $stmt->execute();
        header("Refresh: 0;url=http://localhost:8888/boutique/faq/faq.php");


        echo '<pre>';
        var_dump($reponse);
        var_dump($date);
        var_dump($idUser);
        var_dump($id_question);
        echo '</pre>';
    }
}

// Afficher les réponses propres à chaques questions

?>