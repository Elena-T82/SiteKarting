<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>Historique admin - site karting</title>
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

    $resultatCourse = Course::SelectCourse();
    $resultatMembre = Membre::SelectMembre();

?>

<script>
    function autoCompletion1(){
        
        var numCourse = document.getElementById("idCourse").value;

        $("#TableauParticipant").load("requete/historiqueCourse.php?numCourse=" + numCourse);

    }

    function autoCompletion2(){
        
        var numMembre = document.getElementById("idMembre").value;

        $("#TableauCourse").load("requete/historiqueCourse.php?numMembre=" + numMembre);

    }
</script>

<h1 class="ombreJaune">Gestion des courses</h1>

<div class="container">
    <form method="POST" action="Requete/historiqueCourse.php">
        <div class="row">
            <input type="submit" class="btn btn-warning inputStyle" name="HistoriqueMembre" value="Voir membres par course">
            <input type="submit" class="btn btn-warning inputStyle" name="HistoriqueCourse" value="Voir courses par membre">
        </div>
    </form>
</div>

<?php

if(isset($_GET['Historique']))
{
    if($_GET['Historique'] == "1")
    {
?>
        <div class="container">
            <h2 class="titreDebutPage">Historique course</h2>
            <form method="post" action="Requete/historiqueCourse.php">
            <div class="form-group row">
                <label for="idCourse" class="col-sm-5 col-form-label">Sur quelle course voulez-vous voir les participants ?</label>
                <div class="col-sm-7">

                <select id="idCourse" class="form-control" name="idCourse" onchange="autoCompletion1()" required>
                    <option value="default" selected disabled hidden> • Choisir une course • </option>
                <?php foreach($resultatCourse as $result) : ?>
                        <option value="<?php echo $result['NumCourse']?>"><?php echo $result['Description']?></option>
                    <?php endforeach; ?>
                </select>

                </div>
            </div>
            </form>

            <div id="TableauParticipant"></div>
       </div>


<?php
    }

    else if($_GET['Historique'] == "2")
    {
    ?>
        <div class="container">
            <h2 class="titreDebutPage">Historique membre</h2>
            <form method="post" action="Requete/historiqueCourse.php">
            <div class="form-group row">
                <label for="idMembre" class="col-sm-5 col-form-label">Sur quel membre voulez-vous voir les courses ?</label>
                <div class="col-sm-7">

                <select id="idMembre" class="form-control" name="idMembre" onchange="autoCompletion2()" required>
                    <option value="default" selected disabled hidden> • Choisir un membre • </option>
                <?php foreach($resultatMembre as $result) : ?>
                        <option value="<?php echo $result['NumMembre']?>"><?php echo $result['Prenom'] . ' ' . $result['Nom']?></option>
                    <?php endforeach; ?>
                </select>

                </div>
            </div>
            </form>

            <div id="TableauCourse"></div>
       </div>

<?php
    }
}

}
else{
    
    header('Location: ListeCourses.php?erreur=3');

}

include 'footer.php';

    ?>
</body>

</html>