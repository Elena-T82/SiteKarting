<?php

include "../bdd.php";
require '../vendor/autoload.php';


if(isset($_POST["s'enregistrer"]))
{
    $nom = html_entity_decode(htmlentities($_POST['nom']));
    $prenom = html_entity_decode(htmlentities($_POST['prenom']));
    $email = html_entity_decode(htmlentities($_POST['email']));
    $mdp = md5(html_entity_decode(htmlentities($_POST['mdp'])));
    $VerifMdp = md5(html_entity_decode(htmlentities($_POST['VerifMdp'])));
    $tel = html_entity_decode(htmlentities($_POST['tel']));
    $ddn = html_entity_decode(htmlentities($_POST['ddn']));
    $XpKarting = html_entity_decode(htmlentities($_POST['XpKarting']));
    $poids = html_entity_decode(htmlentities($_POST['poids']));


    $storage = new \Upload\Storage\FileSystem('../img/PhotoMembre');
    $file = new \Upload\File('photo', $storage);


    // Optionally you can rename the file on upload
    $new_filename = uniqid();
    $file->setName($new_filename);

    $file->addValidations(array(
    // Vérifier si le type de l'image est bien JPEG, GIF ou PNG
    new \Upload\Validation\Mimetype(array('image/jpeg', 'image/gif', 'image/png')),
    
        // Ensure file is no larger than 5M (use "B", "K", M", or "G")
        new \Upload\Validation\Size('5M')
    ));

    // Données du fichier uploadé
    $photo = array(
        'name'       => $file->getNameWithExtension(),
        'extension'  => $file->getExtension(),
        'mime'       => $file->getMimetype(),
        'size'       => $file->getSize(),
        'md5'        => $file->getMd5(),
        'dimensions' => $file->getDimensions()
    );

    // Essai de téléchargement du fichier
try {
    // Success!
    $file->upload();
    $success = 1;
} catch (\Exception $e) {
    // Fail!
    $errors = $file->getErrors();
    $success = 0;
}

    if(empty($nom) || empty($prenom) || empty($email) || empty($mdp) || empty($VerifMdp) || empty($tel) || empty($ddn) || empty($XpKarting) || empty($poids) || empty($photo))
    {
        header('Location: ../CreerCompte.php?erreur=1');
    }
    else
    {
        if($mdp == $VerifMdp)
        {
            if($success = 1)
            {
                $Membre = new membre($nom, $prenom, $tel, $email, $mdp, $VerifMdp, $ddn, $XpKarting, $poids, $photo['name']);
                $Membre->AjouterMembre();

                header('Location: ../Connexion.php?success=1');
            }
            else
            {
                header('Location: ../CreerCompte.php?erreur=' . $errors);

            }
        }
        else
        {
            header('Location: ../CreerCompte.php?erreur=2');
        }
    }
}
else
{
    header('Location: ../index.php');
}

?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="node_modules/jquery/dist/jquery.slim.min.js"><\/script>')
    </script>
    <script src="/docs/4.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
