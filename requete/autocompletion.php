


<?php

include '../bdd.php';


if($_SESSION['prenom'])
{
    if(isset($_GET['numCourse']))
    {
        $numCourse = $_GET['numCourse'];

        $LaCourse = Course::SelectCourseSpecifique($numCourse);

        $description = $LaCourse[0]["Description"];
        $date = $LaCourse[0]["Date"];
        $heure = $LaCourse[0]["Heure"];
        $sensCourse = $LaCourse[0]["SensCourse"];
        $nombreTours = $LaCourse[0]["NombreTours"];
        $directeurCourse = $LaCourse[0]["DirecteurCourse"];
        $responsableCourse = $LaCourse[0]["ResponsableCourse"];
        $categorieKart = $LaCourse[0]["CategorieKart"];
        $remarque = $LaCourse[0]["Remarque"];

        ?>

        <script>

        document.getElementById("descriptionCourse").value = <?php echo json_encode($description); ?>

        document.getElementById("dateCourse").value = <?php echo json_encode($date); ?>

        document.getElementById("heureCourse").value = <?php echo json_encode($heure); ?>

        document.getElementById("sensCourse").value = <?php echo json_encode($sensCourse); ?>

        document.getElementById("nombreTours").value = <?php echo json_encode($nombreTours); ?>

        document.getElementById("directeurCourse").value = <?php echo json_encode($directeurCourse); ?>

        document.getElementById("responsableCourse").value = <?php echo json_encode($responsableCourse); ?>

        document.getElementById("categorieKartCourse").value = <?php echo json_encode($categorieKart); ?>
        
        document.getElementById("remarqueCourse").value = <?php echo json_encode($remarque); ?>

        </script>
    
<?php

    }

}

else
{
    header('Location: ../GestionCourses.php?erreur=1');
}




?>
