<div id="menu">


	<ul>
		<li><a href="index.php?action=registerUser">Créer un compte</a></li>
		<li><a href="index.php?action=log">Se connecter</a></li>
	</ul>

</div>

<?php foreach ($posts as $post) : ?> 
	
	<article>
		<header>
		
			<a href="index.php?action=post&id=<?php echo $post->getId(); ?>">

			<h1><?= htmlspecialchars($post->getTitle()) ?></h1></a>
			De : <?= htmlspecialchars($post->getAuthor()) ?><br />
			Le <time><?= $post->getCreation_date() ?></time>
		</header>
			<p><?=  htmlspecialchars($post->getContent()) ?></p>
	</article>
		<hr/> 
<?php endforeach; ?>

