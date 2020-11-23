<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Gestion courses - site karting</title>
</head>

<body>

    <?php
    include('bdd.php');
    include('Menu.php');

if (isset($_SESSION['admin'])) {

    echo "<div class='alignDroite'>";
    echo 'Bonjour ' . $_SESSION['prenom'] . " !";
    echo "<img src='img/PhotoMembre/" . $_SESSION['photo'] ."' alt='PhotoProfil'>";
    echo "</div>";
    

    $resultat = Course::SelectCourseAVenir();

    ?>

    <div id="appelleFonction">
        <!-- Contient la course selectionner dans le formulaire -->
    </div>

<script>
    function autoCompletion(){
        
        var numCourse = document.getElementById("idCourse").value;

        $("#appelleFonction").load("requete/autocompletion.php?numCourse=" + numCourse);

    }

</script>


<h1 class="ombreJaune">Gestion des courses</h1>

<div class="container">
    <form method="POST" action="Requete/gestionCourse.php">
        <div class="row">
            <input type="submit" class="btn btn-warning inputStyle" name="AjouterCourse" value="Ajouter une course">
            <input type="submit" class="btn btn-warning inputStyle" name="ModifierCourse" value="Modifier une course">
            <input type="submit" class="btn btn-warning inputStyle" name="SupprimerCourse" value="Supprimer une course">
        </div>
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
                Certains champs n'ont pas été remplis. Veuillez remplir tous le formulaire.
            </div>
        </div>
        <?php
    }
}
else if(isset($_GET['success']))
{
    if($_GET['success'] == "1")
    {
        ?>
        <div class="container">
            <div class="alert alert-success" role="alert">
                L'ajout de la course a bien été réalisé.
            </div>
        </div>
        <?php
    }
    else if($_GET['success'] == "2")
    {
        ?>
        <div class="container">
            <div class="alert alert-success" role="alert">
                La modification de la course a bien été réalisé.
            </div>
        </div>
        <?php
    }
    else if($_GET['success'] == "3")
    {
        ?>
        <div class="container">
            <div class="alert alert-success" role="alert">
                La suppression de la course a bien été réalisé.
            </div>
        </div>
        <?php
    }
}

if(isset($_GET['Gestion']))
{
    if($_GET['Gestion'] == "1")
    {?>
    <div class="container">
        <h2 class="titreDebutPage">Ajouter une course</h2>
        <form method="post" action="Requete/gestionCourse.php">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" autocomplete="off" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="date">Date </label>
                    <input type="date" class="form-control" name="date" autocomplete="off" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="heure">Heure </label>
                    <input type="time" class="form-control" name="heure" autocomplete="off" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="sensCourse">Sens de la course</label>
                    <select class="form-control" name="sensCourse" autocomplete="off" required>
                        <option value="Horaire">Horaire</option>
                        <option value="Anti-horaire">Anti-horaire</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="nombreTours">Nombre de tours</label>
                    <input type="number" min="1" class="form-control" name="nombreTours" autocomplete="off" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="directeurCourse">Directeur de la course</label>
                    <input type="text" class="form-control" name="directeurCourse" autocomplete="off" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="responsableCourse">Responsable de la course</label>
                    <input type="text" class="form-control" name="responsableCourse" autocomplete="off" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="categoriekarts">Catégorie des karts</label>
                    <input type="text" class="form-control" name="categorieKarts" autocomplete="off" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="remarque">Remarque</label>
                    <input type="text" class="form-control" name="remarque" autocomplete="off" required>
                </div>
            </div>
            <button type="submit" class="btn btn-warning" name="ajouter">Ajouter la course</button>
        </form>
    </div>
    <?php     
    }


    else if($_GET['Gestion'] == "2")
    {?>
        <div class="container">
        <h2 class="titreDebutPage">Modifier une course</h2>
        <form method="post" action="Requete/gestionCourse.php">
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="idCourseModif">Quelle course voulez-vous modifier ?</label>

                <select id="idCourse" class="form-control" name="idCourseModif" onchange="autoCompletion()" required>
                    <option value="default" selected disabled hidden> • Choisir une course • </option>
                <?php foreach($resultat as $result) : ?>
                    <option value="<?php echo $result['NumCourse']?>"><?php echo $result['Description']?></option>
                <?php endforeach; ?>
                </select>

                </div>
                <div class="form-group col-md-6">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" autocomplete="off" id="descriptionCourse" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="date">Date </label>
                    <input type="date" class="form-control" name="date" autocomplete="off" id="dateCourse" required>
                </div>
                <div class="form-group col-md-3">
                    <label for="heure">Heure </label>
                    <input type="time" class="form-control" name="heure" autocomplete="off" id="heureCourse" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="sensCourse">Sens de la course</label>
                    <select id="sensCourse" class="form-control" name="sensCourse" autocomplete="off" required>
                        <option value="Horaire">Horaire</option>
                        <option value="Anti-horaire">Anti-horaire</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="nombreTours">Nombre de tours</label>
                    <input type="number" min="1" class="form-control" name="nombreTours" autocomplete="off" id="nombreTours" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="directeurCourse">Directeur de la course</label>
                    <input type="text" class="form-control" name="directeurCourse" autocomplete="off" id="directeurCourse" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="responsableCourse">Responsable de la course</label>
                    <input type="text" class="form-control" name="responsableCourse" autocomplete="off" id="responsableCourse" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="categoriekarts">Catégorie des karts</label>
                    <input type="text" class="form-control" name="categorieKarts" autocomplete="off" id="categorieKartCourse" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="remarque">Remarque</label>
                    <input type="text" class="form-control" name="remarque" autocomplete="off" id="remarqueCourse" required>
                </div>
            </div>
            <button type="submit" class="btn btn-warning" name="modifier">Modifier la course</button>
        </form>
    </div>

    <?php 
    }


    else if($_GET['Gestion'] == "3")
    {?>
       <div class="container">
        <h2 class="titreDebutPage">Supprimer une course</h2>
        <form method="post" action="Requete/gestionCourse.php">
        <div class="form-group row">
            <label for="idCourseSuppr" class="col-sm-4 col-form-label">Quelle course voulez-vous supprimer ?</label>
            <div class="col-sm-8">

            <select class="form-control" name="idCourseSuppr" required>
                <option value="default" selected disabled hidden> • Choisir une course • </option>
            <?php foreach($resultat as $result) : ?>
                    <option value="<?php echo $result['NumCourse']?>"><?php echo $result['Description']?></option>
                <?php endforeach; ?>
            </select>

            </div>
        </div>
            <button type="submit" class="btn btn-warning" name="supprimer">Supprimer la course</button>
        </form>
       </div>
    <?php 
    }
}

    include 'footer.php';
}
else
{
    header('Location: ListeCourses.php?erreur=3');

}
?>
</body>

</html>