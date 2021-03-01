<?php

class bdd
{
        //Function pour se connecter à la Db
        function connectDb()
        {
            $local = 'mysql:host=localhost;dbname=boutique';
            $user = 'root';
            $pass = '';
            try {
                $db = new PDO($local, $user, $pass);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return $db;
            // Important le return sinon la function ne marche pas
        }
}
?>