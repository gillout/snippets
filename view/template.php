<!DOCTYPE html>
<html lang='fr'>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-ti-fit=no">
        <meta name="description" content="Snippets">
        <title><?= $title ?></title>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/styles/vs.min.css">
        <link href="../bootstrap-4.2.1/css/bootstrap.css" rel="stylesheet">
        <link href="../style/style.css" rel="stylesheet">
    </head>
    <body>
        <main>
            <aside id="navcol">
                <ul>Languages
                    <li><a href=".">Tous les langages</a></li>
                    <?php foreach ($languages as $language) : ?>
                        <li><a href="?language=<?= $language->getLanguageId() ?>"><?= $language->getLabel() ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <ul>Catégories
                    <li><a href=".">Toutes les catégories</a></li>
                    <?php foreach ($cats as $cat) : ?>
                        <li><a href="?cat=<?= $cat->getCatId() ?>"><?= $cat->getLabel() ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </aside>
            <?php $cat = (isset($_GET['cat'])) ? '&cat=' . $_GET['cat'] : ''; ?>
            <aside id="listsnippets">
                <h1>Tous les snippets</h1>
                <ul>
                    <?php foreach ($snippetsDto as $item) : ?>
                        <a href="?action=oneSnippet&id=<?= $item->getSnippetId() . $cat ?>">
                            <li class="<?= isset($snippet) && $item->getSnippetId() == $snippet->getSnippetId() ? 'selected' : ''; ?>">
                                <h2><?= $item->getTitle(); ?></h2>
                                <p><?= $item->getLanguage()->getLabel(); ?></p>
                                <p><?= date('d-m-Y', strtotime($item->getDateCrea())); ?></p>
                            </li>
                        </a>
                    <?php endforeach; ?>
                </ul>
            </aside>
            <?= $content ?>
        </main>
        <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/highlight.min.js"></script>
        <script>hljs.initHighlightingOnLoad();</script>
    </body>
</html>
