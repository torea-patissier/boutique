<?php 
    session_start();
    include ("../classes/profil.class.php");
    $pageProfil = new modprofil();

?>
<div class="imgBack">
<main class="main_profil">
<section class="formulaire_profil">
<h2 class="h2_profil">Profil</h2>
<p>Pour modifier vos informations, veuillez remplir les champs ci-dessous</p>
    <form action="profil.php" method="POST">
        <input class="zonetxt_profil" type="text" name="login" placeholder="Login"><br /><br />
        <input class="zonetxt_profil" type="password" name="password" placeholder="Mot de passe"><br /><br />
        <input class="zonetxt_profil" type="password" name="confpass" placeholder="Confimation mdp"><br /><br />
        <input class="zonetxt_profil" type="email" name="email" placeholder="E-mail"><br /><br />
        <input class="zonetxt_profil" type="text" name="login" placeholder="Login"><br /><br />
        <input class="button-profil" type="submit" name="modifier"><br /><br />
        <input class="button-profil2" type="submit" name="deco" value="Déconnexion">
    </form>
</section>
<?php $pageProfil -> profil();?>
<?php
    if(isset($_POST['deco'])){
        $pageProfil->Deconnexion();
    }
?>
</div>
</main>
