<?php

include ('../bdd.php');

if($_SESSION['prenom'])
{
    if(isset($_GET['AjouterCourse']))
    {
        $membre = $_SESSION['NumMembre'];
        $course = $_GET['AjouterCourse'];

        Course::AjouterCoursePanier($membre, $course);
    }

    if(isset($_GET['RetirerCourse']))
    {
        $membre = $_SESSION['NumMembre'];
        $course = $_GET['RetirerCourse'];


        Course::RetirerCoursePanier($membre, $course);

        $resultat = Course::SelectPanier($membre);

        if(isset($_GET['success']))
        {
            if($_GET['success'])
            {?>
            <div class="container">
                <div class="alert alert-success" role="alert">
                    Votre achat a bien été effectué
                </div>
            </div>
        <?php }
        }

        if(empty($resultat))
        {?>
            <div class="container">
                <div class="alert alert-warning" role="alert">
                    Votre panier est vide !
                </div>
            </div>

        <?php
        }
        else
        {
            $totalPanier = 0;

            foreach($resultat as $result) : ?>

        <?php
            $date = Course::formaterDate($result['Date'], $result['Heure']);
            $prix = Course::formaterPrix($result['Prix']);

        ?>

            <article class='articlePanier'>
                <div class="row">
                    <div class="col-md-12">
                        <p><strong class="titreCourse"><?php echo $result['Description'];?></strong></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Remarque : </strong><?php echo $result['Remarque'];?></p><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p><strong>Date</strong></p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Heure</strong></p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Nombre de tours</strong></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p><?php echo $date[1];?></p>
                    </div>
                    <div class="col-md-3">
                        <p><?php echo $date[2];?></p>
                    </div>
                    <div class="col-md-3">
                        <p><?php echo $result['NombreTours'];?></p>
                    </div>
                    <div class="col-md-3">
                    <a href="uneCourse.php?NumCourse=<?= $result['NumCourse']?>"><button type="button" class="btn btn-dark float-right">Détails ►</button></a>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-md-2">
                        <p><?php echo $prix;?></p>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-dark float-right" onclick="test('<?php echo $result['NumCourse'] ?>')">Retirer du panier</button>
                    </div>
                </div>

                <?php 

                $totalPanier += $result['Prix'];

                ?>

            </article>
            <?php endforeach ?>
            
            <form action="requete/paiement.php" method="post">
                <input type="submit" class="btn btn-dark float-right" name="paiement" value="Procéder au paiement">
                <input type="hidden" name="total" value="<?= $totalPanier ?>">
                <label style="margin-right: 50px" class="float-right"><?= "Total : " . $totalPanier . " $ (prix TTC)" ?></label>
            </form>
            <?php
        }
    }
}

else
{
    header('Location: ../Connexion.php?erreur=3');
}

?>