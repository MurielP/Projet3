<container>
    	<nav class="navbar">
	    	<ul class="navbar-horizontale">
	    		<li ><a href="index.php">Retour à l'accueil</a></li>
	    		<li><a href="index.php?action=logout">Me déconnecter</a></li>
	    		<li><a href="index.php?action=adminProfile">Tableau de bord</a></li>
	       </ul>
	   	</nav>
    </container>

<article>
	<h2>Titre de l'article : <?=  htmlspecialchars($post->getTitle()) ?></h2>
	<time>Date de création : <?= $post->getFormatted_creation_date()?></time></article></br>   
	<time>Dernière modification : <?= $post->getFormatted_PAD() ?></time>
	<p>Contenu : <br><?= htmlspecialchars($post->getContent()) ?></p>
</article>

<?php
//echo '<pre>' . print_r($user,true) . '</pre>';
	if(isset($_SESSION['errors']) AND !empty($_SESSION['errors'])) {
		foreach ($_SESSION['errors'] as $type => $message) {
?>
	<div class="alert">
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

