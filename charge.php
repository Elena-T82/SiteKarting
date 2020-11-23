<?php
require_once('vendor/autoload.php');
include 'bdd.php';

\Stripe\Stripe::setApiKey('sk_test_BQokikJOvBiI2HlWgH4olfQ2');

// Sanitize POST ARRAY
$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
// Référence : https://www.php.net/manual/fr/filter.filters.sanitize.php

$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$email = $_SESSION['email'];
$token = $POST['stripeToken'];
$total = $_SESSION['total'] . '00';

$panier = $_SESSION['panier'];

// Création acheteur pour Stripe
$customer = \Stripe\Customer::create([
    'email' => $email,
    'source' => $token
]);


// Charger "l'acheteur"
$charge = \Stripe\Charge::create([
    'amount' => $total,
    'currency' => 'cad',
    'customer' => $customer->id,
]);

$charge->billing_details['email'] = $email; // Ajout information email
$charge->billing_details['name'] = $nom . ' ' . $prenom; // Ajout information Nom

foreach($panier as $produit)
{
    $achat = Course::acheterCourse($_SESSION['NumMembre'], $produit['NumCourse']);
}

unset($_SESSION['panier']);
unset($_SESSION['total']);

// Renvoyer vers success
header('location: success.php?tid=' . $charge->id);



// TEST À RÉALISER - Commenter la ligne 49 et décommenter les lignes ci-dessous

// echo $token;
// echo '<pre>';
// print_r($charge); // Pour afficher le contenu de l'objet Charge et voir tous attributs de cet objet
// echo '</pre>';
