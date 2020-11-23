<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Votre historique de courses - site karting</title>
</head>

<body>

    <?php

    include('bdd.php');
    include('Menu.php');


if($_SESSION['prenom'])
{

    echo "<div class='alignDroite'>";
    echo 'Bonjour ' . $_SESSION['prenom'] . " !";
    echo "<img src='img/PhotoMembre/" . $_SESSION['photo'] ."' alt='PhotoProfil'>";
    echo "</div>";

    ?>
    <h1 class="ombreJaune">Les courses que vous avez achetés</h2>

    <?php

    $numMembre = $_SESSION['NumMembre'];

    $resultat = Course::SelectCourseAcheter($numMembre);

    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <p><div class="PresentationStatutCourseAVenir"></div> : Course à venir</p>
            </div>
            <div class="col-md-3">
            <p><div class="PresentationStatutCourseTermine"></div> : Course terminée</p>
            </div>
        </div>
    </div>
    
    <section class="flexSection">
        <?php

if(empty($resultat))
{
?>
    <div class="container"><br>
        <div class="alert alert-warning" role="alert">
            Vous n'avez acheté aucune course.
        </div>
    </div>
<?php
}
else
{
    foreach ($resultat as $result) : ?>

    <?php
        $date = Course::formaterDate($result['Date'], $result['Heure']);
        $dateAchat = Course::formaterDate($result['DateAchat'], $result['Heure']);
        $prix = Course::formaterPrix($result['Prix']);
    ?>

        <article class="articleCourse">
            <p class="description"><strong><?= $result['Description']; ?></strong>
            
            <?php if($result['Date'] <= date("Y-m-d"))
            {?>
                <div class="statutCourseTermine"></div>
            <?php }
            else
            {?>
                <div class="statutCourseAVenir"></div>
            <?php
            } ?>
            
        
            </p>
            <p><strong>Date de la course : </strong><?= $date[1] ?></p>
            <p><strong>Heure : </strong><?= $date[2]; ?></p>
            <p><strong>Sens de la course : </strong><?= $result['SensCourse']; ?></p>
            <p><strong>Nombre de tours : </strong><?= $result['NombreTours']; ?></p>
            <p><strong>Directeur de la course : </strong><?= $result['DirecteurCourse']; ?></p>
            <p><strong>Responsable de la course : </strong><?= $result['ResponsableCourse']; ?></p>
            <p><strong>Catégorie kart : </strong><?= $result['CategorieKart']; ?></p>
            <p><strong>Remarque : </strong><?= $result['Remarque']; ?></p>
            <p><strong>Prix : </strong><?= $prix; ?></p>
            <p><strong>Date d'achat : </strong><?= $dateAchat[1]; ?></p>
        </article>

        <?php endforeach;
} ?>

    </section>
<?php
}

else
{
    header('Location: ListeCourses.php?erreur=1');
}

?>


<?php
    include 'footer.php';
?>
</body>

</html>