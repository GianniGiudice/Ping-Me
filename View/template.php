<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="content/style.css" />
        <title><?= $title ?></title>
    </head>
    <body>
        <div id="template">
            <header>
                <a href="index.php"><h1>Mon Blog</h1></a>
                <p>Bienvenue sur ce site.</p>
            </header>
            <div id="content">
                <?= $content ?>
            </div>
            <footer>
                Copyright
            </footer>
        </div>
    </body>
</html>
