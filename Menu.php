<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">La PocaKart</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Accueil <i class="fas fa-home"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ListeCourses.php">Liste courses <i class="fas fa-car"></i></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Compte <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <?php 

          if(isset($_SESSION['prenom']))
          {?>
          
          <a class="dropdown-item" href="HistoriqueMembre.php">Historique des courses</a>
          
          <?php
          }
          else{
          ?>

          <a class="dropdown-item" href="CreerCompte.php">Créer compte</a>
          <a class="dropdown-item" href="Connexion.php">Connexion</a>
          
          <?php
          } ?>
        </div>
      </li>
      <?php
      if(isset($_SESSION['prenom']))
      {?>
      <li class="nav-item">
        <a class="nav-link" href="Panier.php?NumMembre=<?=$_SESSION['NumMembre']?>">Panier <i class="fas fa-shopping-cart"></i></a>
      </li>
      <?php
          }
        ?>
    </ul>
    <ul class="navbar-nav ml-auto">
      <?php
        if(isset($_SESSION['admin']))
        {
      ?>

      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Espace Admin
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="GestionCourses.php">Gestion des courses</a>
            <a class="dropdown-item" href="HistoriqueAdmin.php">Historique</a>
          </div>
        </li>

        <?php
        }?>
    <?php 
        if(isset($_SESSION['prenom']))
        {?>

        <li class="nav-item">
        <a class="nav-link" href="deconnexion.php">Déconnexion</a>
        </li>

        <?php
        }?>
    </ul>
  </div>
</nav>