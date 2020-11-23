<?php

include '../bdd.php';

//choix du formulaire à afficher

if(isset($_POST['AjouterCourse']))
{
    header('Location: ../GestionCourses.php?Gestion=1');
}

else if(isset($_POST['ModifierCourse']))
{
    header('Location: ../GestionCourses.php?Gestion=2');
}

else if(isset($_POST['SupprimerCourse']))
{
    header('Location: ../GestionCourses.php?Gestion=3');
}

//envoie des requêtes

if(isset($_POST['ajouter']) || isset($_POST['modifier']))
{
    if(isset($_POST['ajouter']))
    {
        $gestion = 1;
    }
    elseif(isset($_POST['modifier']))
    {
        $gestion = 2;
    }

    $description = html_entity_decode(htmlentities($_POST['description']));
    $date = html_entity_decode(htmlentities($_POST['date']));
    $heure = html_entity_decode(htmlentities($_POST['heure']));
    $sensCourse = html_entity_decode(htmlentities($_POST['sensCourse']));
    $nombreTours = html_entity_decode(htmlentities($_POST['nombreTours']));
    $directeurCourse = html_entity_decode(htmlentities($_POST['directeurCourse']));
    $responsableCourse = html_entity_decode(htmlentities($_POST['responsableCourse']));
    $categorieKart = html_entity_decode(htmlentities($_POST['categorieKarts']));
    $remarque = html_entity_decode(htmlentities($_POST['remarque']));

    if(empty($description) || empty($date) || empty($heure) || empty($sensCourse) || empty($nombreTours) || empty($directeurCourse) || empty($responsableCourse) || empty($categorieKart) || empty($remarque))
    {
        header('Location: ../GestionCourses.php?Gestion=' . $gestion . '&erreur=1');
    }
    else
    {
        if(isset($_POST['ajouter']))
        {
            $course = new Course($description, $date, $heure, $sensCourse, $nombreTours, $directeurCourse, $responsableCourse, $categorieKart, $remarque);

            $course->AjouterCourse();

            header('Location: ../GestionCourses.php?Gestion=1&success=1');
        }
        else if(isset($_POST['modifier']))
        {
            if(!isset($_POST['idCourseModif']))
            {
                header('Location: ../GestionCourses.php?Gestion=2&erreur=1');
            }
            else
            {
                $idCourseModif = htmlentities($_POST['idCourseModif']);
            
                $course = new Course($description, $date, $heure, $sensCourse, $nombreTours, $directeurCourse, $responsableCourse, $categorieKart, $remarque);

                $course->ModifierCourse($idCourseModif);

                header('Location: ../GestionCourses.php?Gestion=2&success=2');
            }
        }
    }
}

else if(isset($_POST['supprimer']))
{
    if(!isset($_POST['idCourseSuppr']))
    {
        header('Location: ../GestionCourses.php?Gestion=3&erreur=1');
    }
    else
    {
        $idCourseSuppr = htmlentities($_POST['idCourseSuppr']);

        $course = Course::SupprimerCourse($idCourseSuppr);

        header('Location: ../GestionCourses.php?Gestion=3&success=3');
        
    }
}

?>