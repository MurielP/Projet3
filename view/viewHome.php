<a href="index.php?action=registerUser">Se connecter</a>

<?php foreach ($posts as $key => $post) : ?> 
	
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

