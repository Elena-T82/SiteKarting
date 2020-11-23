<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Créer compte - site karting</title>
</head>

<body>
    <?php
    
    include('Menu.php');
    ?>

    <h1 class="ombreJaune">S'enregistrer</h1>
    <div class="container">
        <form method="post" action="requete/enregistrement.php" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Nom">Nom</label>
                    <input type="text" class="form-control" name="nom" autocomplete="off" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="prenom">Prénom</label>
                    <input type="text" class="form-control" name="prenom" autocomplete="off" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" autocomplete="off" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="mdp">Mot de passe</label>
                    <input type="password" class="form-control" name="mdp" autocomplete="off" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="VerifMdp">Vérification du mot de passe</label>
                    <input type="password" class="form-control" name="VerifMdp" autocomplete="off" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="tel">Téléphone</label>
                    <input type="tel" class="form-control" name="tel" placeholder="123-45-678" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" autocomplete="off" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="ddn">Date de naissance</label>
                    <input type="date" class="form-control" name="ddn" autocomplete="off" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="XpKarting">Nombre d'année d'expérience en karting</label>
                    <input type="number" min="0" class="form-control" name="XpKarting" autocomplete="off" required 
                    >
                </div>
                <div class="form-group col-md-4">
                    <label for="poids">Poids (en KG)</label>
                    <input type="number" min="50" class="form-control" name="poids" autocomplete="off" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" class="form-control-file" name="photo" autocomplete="off" required>
                </div>
            </div>

            <button type="submit" class="btn btn-warning" name="s'enregistrer">Devenir membre</button>
        </form>
    </div>

<?php

if(isset($_GET['erreur']))
{
    if($_GET['erreur'] == "1")
    {
        ?>
        <div class="container">
            <div class="alert alert-danger" role="alert">
                Certains champs ne sont pas remplis. Veuillez remplir tous le formulaire pour vous inscrire.
            </div>
        </div>
        <?php
    }
    else if($_GET['erreur'] == "2")
    {
        ?>
        <div class="container">
            <div class="alert alert-danger" role="alert">
                Les mots de passe ne sont pas identiques. Veuillez réessayer.
            </div>
        </div>
        <?php
    }
    else
    {
        $tableau = $_GET['erreur'];

        foreach($tableau as $tab)
        echo $tab;
    }
}

    include 'footer.php';

?>
</body>

</html>