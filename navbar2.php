<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="client0.php">Home</a>
        </li>
      </ul>

      <form class="d-flex">
        <!-- Passer noUtilisateur in the URL -->
        <!-- <a class="btn btn-outline-primary mx-2" href="commande.php?noUtilisateur=<?php echo $user['noUtilisateur']; ?>">Commande</a> -->

        <a class="btn btn-outline-primary mx-2" type="submit" href="commande.php" >nouvelle commande</a>

        <a class="btn btn-outline-primary mx-2" type="submit" href="login1.php" >mes commandes</a>


        <a class="btn btn-outline-success mx-2" href="home.php">Déconnexion</a>
      </form>
    </div>
  </div>
</nav>
