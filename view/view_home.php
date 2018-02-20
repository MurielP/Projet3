<container>
    <nav class="navbar">
	    <ul class="navbar-horizontale">
	   		<li><a href="index.php?action=registerUser">Devenir membre</a></li>
	 		<li><a href="index.php?action=logUser">Espace membre</a></li>
	    	<li><a href="index.php?action=logAdmin">Espace administrateur</a></li>	
	    </ul>
	</nav>
</container>

<?php foreach ($posts as $post) : ?> 
	
	<article>
		<header>
		
			<a href="index.php?action=post&id=<?= htmlspecialchars($post->getId()) ?>">
				<h1><?= htmlspecialchars($post->getTitle()) ?></h1>
			</a>
			<p>
				De : <?= htmlspecialchars($post->getAuthor()) ?><br />
				Le <time><?= htmlspecialchars($post->getFormatted_creation_date()) ?></time>
				
			</p>
		</header>
			<p><?=  htmlspecialchars($post->getContent()) ?></p>
	</article>
		<hr/> 
<?php endforeach; ?>

