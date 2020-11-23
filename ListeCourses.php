<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Liste des courses - site karting</title>
</head>

<body>
<div id="actualisationStatutCourse"></div>

    <?php

    include('bdd.php');
    include('Menu.php');

    ?>
<script>

function addCourse(numCourse)
{
    $('#actualisationStatutCourse').load('Requete/Panier.php?AjouterCourse=' + numCourse);

}

</script>

<?php

    $resultat = Course::SelectCourseAVenir();
    

    if (isset($_SESSION['prenom'])) {

        echo "<div class='alignDroite'>";
        echo 'Bonjour ' . $_SESSION['prenom'] . " !";
        echo "<img src='img/PhotoMembre/" . $_SESSION['photo'] ."' alt='PhotoProfil'>";
        echo "</div>";
    }
    else
    {
        echo "<div class='alert alert-warning alignDroite' role='alert'>";
        echo "<a href='Connexion.php'>Connectez-vous</a> pour accéder aux détails des courses et au panier.";
        echo "</div>";
    }


    if(isset($_GET['erreur']))
{
    if($_GET['erreur'] == "1")
    {
        ?>
        <div class="container"><br>
            <div class="alert alert-danger" role="alert">
                Vous n'avez pas accès à cette page. Connectez-vous pour y accéder.
            </div>
        </div>
        <?php
    }
    elseif($_GET['erreur'] == "2")
    {
        ?>
        <div class="container"><br>
            <div class="alert alert-danger" role="alert">
                Une erreur est survenue.
            </div>
        </div>
        <?php
    }
    elseif($_GET['erreur'] == "3")
    {
        ?>
        <div class="container"><br>
            <div class="alert alert-danger" role="alert">
                Vous n'avez pas accès à cette partie du site.
            </div>
        </div>
        <?php
    }
    elseif($_GET['erreur'] == "4")
    {
        ?>
        <div class="container"><br>
            <div class="alert alert-danger" role="alert">
                La course que vous recherchez n'existe pas.
            </div>
        </div>
        <?php
    }
}
    ?>

    <h1 class="ombreJaune">Courses actuellements proposées</h2>

    <section class="flexSection">
        <?php

        foreach ($resultat as $result) : ?>

        <?php
            $date = Course::formaterDate($result['Date'], $result['Heure']);
            $prix = Course::formaterPrix($result['Prix']);
        ?>

            <article class="articleCourse">
                <p class="description"><strong><?= $result['Description']; ?></strong></p>
                <p><strong>Date : </strong><?= $date[1]; ?></p>
                <p><strong>Heure : </strong><?= $date[2]; ?></p>
                <p><strong>Nombre de tours : </strong><?= $result['NombreTours']; ?></p>
                <p><strong>Catégorie kart : </strong><?= $result['CategorieKart']; ?></p>
                <p><strong>Prix : </strong><?= $prix; ?></p>

                <?php if(isset($_SESSION['prenom']))
            {?>
                <a href="uneCourse.php?NumCourse=<?= $result['NumCourse'] ?>"><button type="button" class="btn btn-dark float-right" name="detailCourse">Voir détails ►</button></a>
<?php
                $coursePanier = Course::SelectCoursePanierOuAcheter($_SESSION['NumMembre'], $result['NumCourse']); 

                if(empty($coursePanier))
                {?>
                    <button type="button" class="btn btn-dark float-right btnPanier" onclick="addCourse('<?php echo $result['NumCourse'] ?>')" name="AjouterPanier">Ajouter au panier <i class="fas fa-cart-plus"></i></button>
                <?php
                }
                else
                {?> 
                    <button type="button" disabled class="btn btn-dark float-right btnPanier btnPanierBloquer" name="panier">Ajouter au panier <span>Cette course est déjà acheté ou dans votre panier</span><i class="fas fa-cart-plus"></i></button>
                <?php
                }
            }
            else
            {?>
                <button type="button" disabled class="btn btn-dark float-right btnBloquer" name="detailCourse">Voir détails ►<span>Vous n'avez pas accès à ces options hors-connexion</span></button>
                <button type="button" disabled class="btn btn-dark float-right btnPanier btnBloquer" name="panier">Ajouter au panier <span>Vous n'avez pas accès à ces options hors-connexion</span><i class="fas fa-cart-plus"></i></button>
            <?php
            }
            ?>
            </article>

        <?php endforeach ?>

    </section>

    <?php 





?>

</body>

</html>