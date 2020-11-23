<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    
    <title>Site karting - paiement</title>
</head>

<body>

<?php
    include('bdd.php');
    include('Menu.php');
?>

<?php

    if(isset($_SESSION['panier']))
    {
        $total = $_SESSION['total'];

        echo "<div class='alignDroite'>";
        echo 'Bonjour ' . $_SESSION['prenom'] . " !";
        echo "<img src='img/PhotoMembre/" . $_SESSION['photo'] ."' alt='PhotoProfil'>";
        echo "</div>";
        
        echo "<h1 class='ombreJaune'>Paiement</h2>";

?>
        <section class="container">

    <form action="charge.php" method="post" id="payment-form">
        <div class="form-row">
            <?php echo "Montant total du paiement : " . $total . " $(prix TTC)" ?>

            <div id="card-element" class="form-control mt-4">
                <!-- css BootStrap -->
                <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
        </div>

            <button>Paiement</button>
    </form>
        </section>

        <?php
    }
    else
    {
        header('Location: index.php');
    }
?>
        <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="js/charge.js"></script>

</body>

</html>