<!-- conserver l'affichage du template des vues même en cas d'erreur, on reprend le code vueAccueil-->
<title><?php  $this->title = 'Page d\'erreur'; ?></title>

<div id="viewError" class="alert alert-danger my-5 text-center" role="alert">
  <h4 class="alert-heading">Oups! Une erreur est survenue</h4>
  <!-- $errorMessage (méthode privée créée ds le router-->
  <p><?= $errorMessage ?></p>
</div>