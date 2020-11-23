<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    
    <title>Accueil - site karting</title>
</head>

<body>
    <div class="main">
    <?php

    include('bdd.php');
    include('Menu.php');
    ?>
    <header>
        <h1>Bienvenue sur PocaKart !</h1>
    </header>

    <section class="sectionAccueil">
        <article>
            <h2 class="titreAccueil">♦ Présentation de la ligue</h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto, alias! Veniam, incidunt eveniet ratione explicabo, nobis, nostrum at distinctio quas sed odio dolorem molestias rerum? Laborum inventore totam qui voluptates! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto, alias! Veniam, incidunt eveniet ratione explicabo, nobis, nostrum at distinctio quas sed odio dolorem molestias rerum? Laborum inventore totam qui voluptates! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto, alias! Veniam, incidunt eveniet ratione explicabo, nobis, nostrum at distinctio quas sed odio dolorem molestias rerum? Laborum inventore totam qui voluptates! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto, alias! Veniam, incidunt eveniet ratione explicabo, nobis, nostrum at distinctio quas sed odio dolorem molestias rerum? Laborum inventore totam qui voluptates!</p>
        </article><br><br>

        <article>
            <h2 class="titreAccueil">♦ Présentation du club</h2>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto, alias! Veniam, incidunt eveniet ratione explicabo, nobis, nostrum at distinctio quas sed odio dolorem molestias rerum? Laborum inventore totam qui voluptates! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto, alias! Veniam, incidunt eveniet ratione explicabo, nobis, nostrum at distinctio quas sed odio dolorem molestias rerum? Laborum inventore totam qui voluptates! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto, alias! Veniam, incidunt eveniet ratione explicabo, nobis, nostrum at distinctio quas sed odio dolorem molestias rerum? Laborum inventore totam qui voluptates! Lorem ipsum dolor sit, amet consectetur adipisicing elit. Architecto, alias! Veniam, incidunt eveniet ratione explicabo, nobis, nostrum at distinctio quas sed odio dolorem molestias rerum? Laborum inventore totam qui voluptates!</p>
        </article>
    </section>


    <?php include 'footer.php' ?>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="node_modules/jquery/dist/jquery.slim.min.js"><\/script>')
    </script>
    <script src="/docs/4.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
    
</body>

</html>