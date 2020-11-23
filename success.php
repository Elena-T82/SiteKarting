<?php

include 'bdd.php';
include 'Menu.php';


if(isset($_GET['tid']))
{
    $idTransaction = $_GET['tid'];
}
else
{
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Legacy</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container mt-4">
        <h2>Merci <?= $_SESSION['prenom']; ?> pour votre achat ! </h2>
        <hr>
        <p>
            ID de transaction : <?= $idTransaction; ?>
        </p>
        <a href="index.php"><button type="button" class="btn btn-primary">Accueil</button></a>
    </div>
</body>

</html>