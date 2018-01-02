<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="public/style.css" />
        <title><?= $title ?></title>
    </head>
    <body>
        <div id="global">
            <header>
                <h1 id="blogTitle">Mon Blog pour un écrivain</h1></a>
                <p>Je vous souhaite la bienvenue !</p>
            </header>
            <div id="content">
                <?= $content ?>
            </div> <!-- #contenu -->
            <footer id="blogFooter">
                Blog réalisé avec PHP, HTML5 et CSS.
            </footer>
        </div> <!-- #global -->
    </body>
</html>