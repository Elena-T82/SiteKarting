<?php

include '../bdd.php';

if(isset($_SESSION['prenom']))
{
    if(isset($_POST['HistoriqueMembre']))
    {
        header('Location: ../HistoriqueAdmin.php?Historique=1');
    }
    else if(isset($_POST['HistoriqueCourse']))
    {
        header('Location: ../HistoriqueAdmin.php?Historique=2');
    }
    

    if(isset($_GET['numCourse']))
    {
        $numCourse = $_GET['numCourse'];

        $resultat = Membre::SelectMembreParCourse($numCourse);
        
        ?>
        
<div class="tableauHistorique">
    <table class="table table-hover table-dark">
        <thead>
        <tr>
            <th scope="col-2">Prénom</th>
            <th scope="col-2">Nom</th>
            <th scope="col-2">Tel</th>
            <th scope="col-2">Courriel</th>
            <th scope="col-2">Année d'expérience en karting</th>
        </tr>
        </thead>
        <tbody>

<?php foreach($resultat as $result) : ?>
        
        <tr>
            <td><?= $result['Prenom']?></td>
            <td><?= $result['Nom']?></td>
            <td><?= $result['Tel']?></td>
            <td><?= $result['Courriel']?></td>
            <td><?= $result['AnneeXpKarting']?></td>
        </tr>

<?php endforeach;?>
        
        </tbody>
    </table>
</div>

<form method="post" action="requete/genererPDF.php?course=<?= $numCourse ?>">
    <button type="submit" id="pdf" name="genererPDF" class="btn btn-dark"><i class="fa fa-pdf"></i>Generer PDF</button>
</form>

<?php
    }

    else if(isset($_GET['numMembre']))
    {
        $numMembre = $_GET['numMembre'];

        $resultat = Course::SelectCourseParMembre($numMembre);

        ?>

<div class="tableauHistorique">
    <table class="table table-hover table-dark">
        <thead>
        <tr>
            <th scope="col">Description</th>
            <th scope="col">Date</th>
            <th scope="col">Directeur de la course</th>
            <th scope="col">Responsable de la course</th>
            <th scope="col">Prix</th>
        </tr>
        </thead>
        <tbody>

<?php foreach($resultat as $result) : ?>
    <?php
        $date = Course::formaterDate($result['Date'], $result['Heure']);
        $prix = Course::formaterPrix($result['Prix']);
    ?>

        <tr>
            <td><?= $result['Description']?></td>
            <td><?= $date[1]?></td>
            <td><?= $result['DirecteurCourse']?></td>
            <td><?= $result['ResponsableCourse']?></td>
            <td><?= $prix?></td>
        </tr>

<?php endforeach;?>
        
        </tbody>
    </table>
</div>
<?php
    }


}
else{
    header('Location: ../index.php');
}



?>