<?php
require_once('bdd.class.php');

class gestion_utilisateur extends bdd
{

    public function ShowIdDroits()
    {
        $con = $this->connectDb();
        $stmt = $con->prepare('SELECT * FROM info_client');
        $stmt->execute();
        $result = $stmt->fetchAll();

        echo '<table class="whole_table_admin">' . '<thead>';
        echo '<th class="table_admin"> ID </th>';
        echo '<th class="table_admin"> LOGIN </th>';
        echo '<th class="table_admin"> NOM </th>';
        echo '<th class="table_admin"> PRENOM </th>';
        echo '<th class="table_admin"> NAISSANCE </th>';
        echo '<th class="table_admin"> E-MAIL </th>';
        echo '<th class="table_admin"> TEL </th>';
        echo '<th class="table_admin"> ID DROITS </th>';
        echo '<tbody>';
        foreach ($result as $value) {
        ?>
            <tr>
                <td class="table_admin" name="id"><?php echo $value[0]; ?></td>
                <td class="table_admin" name="login"><?php echo $value[1]; ?></td>
                <td class="table_admin" name="nom"><?php echo $value[3]; ?></td>
                <td class="table_admin" name="prenom"><?php echo $value[4]; ?></td>
                <td class="table_admin" name="ddN"><?php echo $value[5]; ?></td>
                <td class="table_admin" name="email"><?php echo $value[6]; ?></td>
                <td class="table_admin" name="tel"><?php echo $value[7]; ?></td>
                <td class="table_admin" name="id_droits"><?php echo $value[8]; ?></td>
                <td class="table_admin" name="id"><?php echo '<a class="href_admin" href="../Modifier_utilisateur/modifier_utilisateur.php?id=' . $value[0] . '">' . 'Modifier' . '</a>'; ?></td>
                <td class="table_admin" name="id"><?php echo '<a class="href_admin" href="gestion_utilisateur.php?id=' . $value[0] . '">' . 'Supprimer' . '</a>'; ?></td>

            </tr>
<?php
        }
        echo '</tbody>' . '</table>';
        // Avec le GET_ID on va supprimer l'utilisateur en Bdd
        if(isset($_GET['id']) AND !empty($_GET['id'])){ 

            if($_SESSION['user']['id'] == $_GET['id']){

                echo'Impossible de supprimer un compte qui est connecté';

            }else{

                $id = $_GET['id'];
                $supp = $con->prepare("DELETE FROM info_client WHERE id = :id ");
                $supp->bindValue('id', $id, PDO::PARAM_INT);
                $supp->execute();
                header('Refresh 0;');
            }           

        }
    }


}

?>