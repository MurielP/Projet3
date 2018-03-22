<!-- conserver l'affichage du template des vues même en cas d'erreur, on reprend le code vueAccueil-->
<title><?php  $this->title = 'Page d\'erreur'; ?></title>

<nav class="navbar navbar-expand-lg bg-secondary fixed-top navbar-shrink" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php"><img src="public/img/begins_Simon_Migaj_pexels.jpg" class="rounded" width="30"  height="30" alt="Let's begin image d'accueil" title="Que l'aventure commence !"> Jean Forteroche</a>

        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
          	<li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php">Accueil</a>
            </li>    

            </ul>
        </div>
    </div>
</nav>	

<div id="viewError" class="alert alert-danger my-5 text-center" role="alert">
  <h4 class="alert-heading">Oups! Une erreur est survenue</h4>
  <!-- $errorMessage (méthode privée créée ds le router-->
  <p><?= $errorMessage ?></p>
</div>