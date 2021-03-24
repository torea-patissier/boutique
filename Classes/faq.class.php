<?php

require_once("bdd.class.php");

class faq extends bdd
{
    // Envoyer une question en Bdd 
    function AskQuestion()
    {    
            $question = htmlspecialchars($_POST["questionAPoser"]);//
            $date = date("Y-m-d H:i:s");//
            $idUser = $_SESSION["user"]["id"];//Je récupère l'user id dans ma variable session
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
                header("Refresh: 0;");
            }


    // Sélectionner la sous catégorie pour la question posés
    function selectSousCategory()
    {
        $con = $this->connectDb(); // Connexion Db 
        $stmt = $con->prepare("SELECT * FROM sous_categories");// Requete
        $stmt->execute();//J'éxécute la requete
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);//Result devient un tableau des valeurs obtenues

        foreach($result as $resultat){
            $categorie = $resultat["nom"];
            $idCategorie = $resultat["id"];

            echo "<option value='$idCategorie'>$categorie</option>";
        
        }
    }


    // Afficher les questions posés enregistré en Bdd classé par Catégorie/Sous catégorie
    function ShowQuestion()
    {
        $con = $this->connectDb();
        $req3 = $con->prepare("SELECT * FROM faq_question");
        $req0 = $con->prepare("SELECT * FROM categories");
        $req = $con->prepare("SELECT * FROM faq_question INNER JOIN  sous_categories ON faq_question.id_sous_categorie = sous_categories.id ORDER BY sous_categories.id DESC ");
        $req2 = $con->prepare("SELECT * FROM sous_categories");

        $req0->execute();
        $req->execute();
        $req2->execute();
        $req3->execute();

        $result0 = $req0->fetchAll();
        $result = $req->fetchAll();
        $result2 = $req2->fetchAll();
        $result3 = $req3->fetchAll();

        foreach($result3 as $res3){

            $id_question = $res3['id'];
            echo $id_question;
        }

        foreach ($result0 as $resultat0){

            $id_categorie = $resultat0['id'];
            $categorie = $resultat0['nom'];
            echo '<hr />' . 'Catégorie : ' . $categorie . '<br />' . '<br />' . '<br />' ;

            foreach($result2 as $resultat){

                $id_sous_categorie = $resultat['id_categories'];
                $nom = $resultat['nom'];

                if($id_categorie == $id_sous_categorie){

                    echo 'Sujet : ' . $nom . '<br />' . '<br />';

                        foreach($result as $res){

                            if($res['nom'] == $resultat['nom']){
                                $question = $res['question'];
                                echo $id_question;
                                echo   'Question : ' . $question . '<br />' . '<br />' . '<br />' ;
                                ?>
    
                                <form action="faq.php" method="POST">
                                    <textarea name="reponse" cols="40" rows="2" placeholder="Répondre ici"></textarea><br /><br />
                                    <input type="submit" name="answer" value="Répondre">
                                </form><hr>
                                <?php
                            }
                        } 
                }
            } 
        }
    }
}
?>
