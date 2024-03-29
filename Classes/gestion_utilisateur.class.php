<?php
require_once('bdd.class.php');

class gestion_utilisateur extends bdd
{
    public function ShowIdDroits()
    {

        $con = $this->connectDb();

            if (isset($_GET['id']) and !empty($_GET['id'])) {
    
                if ($_SESSION['user']['id'] == $_GET['id']) {
    
                    echo '<div class="container">Impossible de supprimer un compte qui est connecté'.'</div>';
                } else {
    
                    $id = $_GET['id'];
                    $supp = $con->prepare("DELETE FROM info_client WHERE id = :id ");
                    $supp->bindValue('id', $id, PDO::PARAM_INT);
                    $supp->execute();
                    header('Refresh 0;');
                }
            }
    
            
        $stmt = $con->prepare('SELECT * FROM info_client');
        $stmt->execute();
        $result = $stmt->fetchAll();
?>
        <div class="container">
            <?php
            echo '<table class="responsive-table">' . '<thead>';
            echo '<th class="table_admin">  ID </th>';
            echo '<th class="table_admin"> LOGIN </th>';
            echo '<th class="table_admin"> NOM </th>';
            echo '<th class="table_admin"> PRENOM </th>';
            echo '<th class="table_admin"> NAISSANCE </th>';
            echo '<th class="table_admin"> E-MAIL </th>';
            echo '<th class="table_admin"> TEL </th>';
            echo '<th class="table_admin"> ID DROITS </th>';
            echo '</thead>';
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
                    <td class="table_admin" name="id"><?php echo '<a class="href_admin" href="../Gestion_utilisateur/modifier_utilisateur.php?id=' . $value[0] . '">' . 'Modifier' . '</a>'; ?></td>
                    <td class="table_admin" name="id"><?php echo '<a class="href_admin" href="gestion_utilisateur.php?id=' . $value[0] . '">' . 'Supprimer' . '</a>'; ?></td>
                </tr>
            <?php
            }
            echo '</tbody>' . '</table>';
            ?>
        </div>
        <?php


    }
}
?>