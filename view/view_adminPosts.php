<nav class="navbar navbar-expand-lg bg-secondary fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php">
        	<img src="public/img/begins_Simon_Migaj_pexels.jpg" width="30" class="rounded" height="30" alt="Let's begin image d'accueil" title="Que l'aventure commence !"> Accueil</a>

			<button class="navbar-toggler navbar-toggler-right text-uppercase bg-secondary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">Menu
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

<h3>Mon tableau d'administration</h3>

</article>

<?php
//echo '<pre>' . print_r($user,true) . '</pre>';
	if(isset($_SESSION['errors']) AND !empty($_SESSION['errors'])) {
		foreach ($_SESSION['errors'] as $type => $message) {
?>
	<div class="btn btn-warning btn-block mt-3">
		<ul>
			<li><?= $message ?></li>
		</ul>
	</div>
<?php
}
}	
	// création d'un tableau vide pour vider les erreurs
	$_SESSION['errors'] = [];
?>

	<form class="form" method="post" action="index.php?action=createPost">
		<fieldset>
			<legend>Rédiger un nouvel épisode</legend>
				<p><label for="author">Auteur : </label><input type="text" name="author" id="author" value="" /></p>
				<p><label for="title">Titre de l'épisode : </label><input type="text" name="title" id="title" value="" /></p>
				<p><label for="content">Contenu : </label><textarea name="content" id="content" value=""></textarea></p>

				<p><input type="submit" name="submit" value="Publier l'article" /></p>
		</fieldset>
	</form>
	
<?php
	//var_dump($_SESSION['success']);
	if(isset($_SESSION['success']) AND !empty($_SESSION['success'])) {
		foreach ($_SESSION['success'] as $type => $message) {
?>
	<div class="btn btn-info btn-block mt-3">
		<ul>
			<li><?= $message ?></li>
		</ul>
	</div>
<?php
}
}	
	$_SESSION['success'] = [];
?>

<div class="tablePostList">
<table>
	<caption>Liste des billets</caption>
	<thead> <!-- en-tête du tableau -->
		<tr> <!-- Ligne du tabelau -->
			<th>Titre</th>
			<th>Aperçu du contenu</th>
			<th>Auteur</th>
		  	<th>Date de création</th>
		  	<th>Date de modification</th>
		  	<th>Action</th>
		</tr>
	</thead>	  

<?php foreach ($posts as $post) :?>
	<tbody>
		<tr>
			<td><?= htmlspecialchars ($post->getTitle()) ?></td>
			<td><?= htmlspecialchars ($post->getContent()) ?></td>
			<td><?= htmlspecialchars ($post->getAuthor()) ?></td>
			<td><?= htmlspecialchars ($post->getFormatted_creation_date()) ?></td>
			<td><?= htmlspecialchars ($post->getFormatted_PAD()) ?></td>
			<td>
				<ul>
					<li><button><a href="index.php?action=readPost&post_id=<?= htmlspecialchars($post->getId()) ?>">Lire</a></button></li>
					<li><button><a href="index.php?action=modifyPost&post_id=<?= htmlspecialchars($post->getId()) ?>">Modifier</a></button></li>
					<li><button><a href="index.php?action=cancelPost&post_id=<?= htmlspecialchars($post->getId()) ?>">Supprime</a></button></li>	
				</ul>
			</td>
		</tr>
	</tbody>
<?php endforeach; ?>

</table>
</div>