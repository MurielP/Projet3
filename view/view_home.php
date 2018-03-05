<?php
	var_dump($_SESSION['errors']);
	if(isset($_SESSION['errors']) AND !empty($_SESSION['errors'])) {
		foreach ($_SESSION['errors'] as $type => $message) {
?>
	<div class="alert">
		<p>Une erreur s'est produite dans le formulaire.</p>
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

<container>
    <nav class="navbar">
	    <ul class="navbar-horizontale">
	   		<li><a href="index.php?action=registerUser">Devenir membre</a></li>
	 		<li><a href="index.php?action=logUser">Espace membre</a></li>
	    	<li><a href="index.php?action=logAdmin">Espace administrateur</a></li>	
	    </ul>
	</nav>
</container>

<p>Nombre d'épisodes publiés : <?= htmlspecialchars($posts_nb) ?></p>

<?php foreach ($posts as $post) : ?> 
	<article>
		<header>
			<a href="index.php?action=post&post_id=<?= htmlspecialchars($post->getId()) ?>">
				<h1><?= htmlspecialchars($post->getTitle()) ?></h1>
			</a>

			<p>De : <?= htmlspecialchars($post->getAuthor()) ?><br />
				Le <time><?= htmlspecialchars($post->getFormatted_creation_date()) ?></time>
			</p>
		</header>

		<body>
			<p><?=  htmlspecialchars($post->getContent()) ?></p>
		</body>	
	</article>
		<hr/> 
<?php endforeach; ?>

