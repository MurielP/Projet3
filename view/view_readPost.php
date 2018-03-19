<nav class="navbar navbar-expand-lg bg-secondary fixed-top navbar-shrink" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php"><img src="public/img/begins_Simon_Migaj_pexels.jpg" class="rounded" width="30px"  height="30px" alt="Let's begin image d'accueil" title="Que l'aventure commence !"> Jean Forteroche</a>

      <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu
        <i class="fa fa-bars"></i>
          </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item mx-0 mx-lg-1">
                  <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=adminProfile">Tableau de bord</a>
                </li>
              <li class="nav-item mx-0 mx-lg-1">
                  <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="index.php?action=logoutAdmin">Me déconnecter</a>
                </li>           
            </ul>
        </div>
    </div>
</nav>

<div id="mainContainer" class="container">

<?php
//echo '<pre>' . print_r($post,true) . '</pre>';
  if(isset($_SESSION['errors']) AND !empty($_SESSION['errors'])) {
    foreach ($_SESSION['errors'] as $type => $message) {
?>
  <div class="msg container mt-xs-4">
    <div id="errors" class="overflow-visible">
      <ul class="list-group mt-2 mt-sm-6">
        <li class="list-group-item list-group-item-warning">Une erreur s'est produite dans le formulaire :</br><?= $message ?></li>
      </ul>
    </div>
  </div>
<?php
}
} 
  // création d'un tableau vide pour vider les erreurs
  $_SESSION['errors'] = [];
?>


<div class="container">
  <div class="row">
      <article class="col-l-8 col-md-10 mx-auto">
      <h3 class="my-2">Titre de l'article : <?=  $post->getTitle() ?></h3>

    	<time>Date de création : <?= $post->getFormatted_creation_date() ?></time></br>   
    	<p><strong>Contenu</strong><br><?= $post->getContent() ?></p>
    </article>
  </div>
</div>




