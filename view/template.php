<!DOCTYPE html>
<html lang='fr'>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-ti-fit=no">
        <meta name="description" content="Snippets">
        <title><?= $title ?></title>
        <link href="../bootstrap-4.2.1/css/bootstrap.css" rel="stylesheet">
        <link href="../style/style.css" rel="stylesheet">
    </head>
    <body>
        <main>
            <aside id="listsnippets">
                <h1>Tous les snippets</h1>
                <ul>
                    <?php foreach ($snippets as $item) : ?>
                        <a href="?action=oneSnippet&id=<?= $item->getSnippetId(); ?>">
                            <li class="<?= isset($snippet) && $item->getSnippetId() == $snippet->getSnippetId() ? 'selected' : ''; ?>">
                                <p><?= $item->getTitle(); ?></p>
                                <p><?= $item->getLanguage(); ?></p>
                                <p><?= $item->getDateCrea(); ?></p>
                                <p><?= $item->getCatId(); ?></p>
                            </li>
                        </a>
                    <?php endforeach; ?>
                </ul>
            </aside>
            <?= $content ?>
        </main>
    </body>
</html>
