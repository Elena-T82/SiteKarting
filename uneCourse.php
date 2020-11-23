<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>La course - site karting</title>
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

    if(isset($_GET['NumCourse']))
    {
        $numCourse = $_GET['NumCourse'];
    
        $resultat = Course::SelectCourseSpecifique($numCourse);

        if(empty($resultat))
        {
            header('Location: ListeCourses.php?erreur=4');
        }
        else
        {
        
        ?>

        <h1 class="ombreJaune">Détail de la course</h1>

        <section class="container"><?php

        foreach($resultat as $result) : ?>

        <?php
            $date = Course::formaterDate($result['Date'], $result['Heure']);
            $prix = Course::formaterPrix($result['Prix']);
        ?>

        <article class="uneCourse">
            <h2 class="description"><?= $result['Description']?></h2><br>

            <div class="row">
                <div class="col-md-5">
                    <p><strong>Date : </strong><?= $date[1]; ?></p>
                </div>
                <div class="col-md-5">
                    <p><strong>Heure : </strong><?= $date[2]; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <p><strong>Sens de la course : </strong><?= $result['SensCourse']; ?></p>
                </div>
                <div class="col-md-5">
                    <p><strong>Nombre de tours : </strong><?= $result['NombreTours']; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <p><strong>Directeur de la course : </strong><?= $result['DirecteurCourse']; ?></p>
                </div>
                <div class="col-md-5">
                     <p><strong>Responsable de piste : </strong><?= $result['ResponsableCourse']; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <p><strong>Remarques : </strong><?= $result['Remarque']; ?></p>
                </div>
                <div class="col-md-5">
                    <p><strong>Catégorie kart : </strong><?= $result['CategorieKart']; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <p><strong>Prix : </strong><?= $prix; ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="ListeCourses.php"><input type="submit" class="btn btn-dark float-right" value="◄ Retour sur la liste des courses"></a>
                </div>
        </article>
        <?php endforeach;
        }
    }
    else
    {
        header('Location: ListeCourses.php?erreur=2');

    }
}
else
{
    header('Location: ListeCourses.php?erreur=1');
}
    ?>
    
</body>

</html>