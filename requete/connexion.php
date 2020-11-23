<?php

include '../bdd.php';

if(isset($_POST['SeConnecter']))
{
    $email = htmlentities($_POST['email']);
    $mdp = md5(htmlentities($_POST['mdp']));

    if(empty($email) || empty($mdp))
    {
        header('Location: ../Connexion.php?erreur=1');
    }
    else{

        $resultatAdmin = Membre::ConnexionAdmin($email, $mdp);

        if(empty($resultatAdmin))
        {
            $resultat = Membre::ConnexionMembre($email, $mdp);

            if(empty($resultat))
            {
                header('Location: ../Connexion.php?erreur=2');
            }
            else
            {
                $_SESSION['NumMembre'] = $resultat[0]['NumMembre'];
                $_SESSION['prenom'] = $resultat[0]['Prenom'];
                $_SESSION['nom'] = $resultat[0]['Nom'];
                $_SESSION['email'] = $resultat[0]['Courriel'];
                $_SESSION['photo'] = $resultat[0]['Photo'];
            }
        }
        else
        {
            $_SESSION['admin'] = "Oui";

            $_SESSION['NumMembre'] = $resultatAdmin[0]['NumMembre'];
            $_SESSION['prenom'] = $resultatAdmin[0]['Prenom'];
            $_SESSION['nom'] = $resultatAdmin[0]['Nom'];
            $_SESSION['email'] = $resultatAdmin[0]['Courriel'];
            $_SESSION['photo'] = $resultatAdmin[0]['Photo'];
        }
        
        header('Location: ../ListeCourses.php');
    }
}
else
{
    header('Location: ../index.php');
}





?>