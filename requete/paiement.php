<?php

include '../bdd.php';

if(isset($_SESSION['prenom']))
{
    if(isset($_POST['paiement']))
    {
        $numMembre = $_SESSION['NumMembre'];

        $coursePanier = Course::SelectPanier($numMembre);

        $_SESSION['panier'] = $coursePanier;
        $_SESSION['total'] = $_POST['total'];

        header('Location: ../formulairePaiement.php');
    }
}
else
{
    header('Location: ../ListeCourses.php?erreur=1');
}




?>