<?php $title = 'Snippets'; ?>
<?php $h1 = 'Les snippets'; ?>
<?php $h2 = 'Un snippet'; ?>

<?php ob_start(); ?>
<aside id="listsnippets">
    <h1><?= $h1; ?></h1>
    <ul>
        <?php foreach ($snippets as $item) : ?>
            <a href="?action=oneSnippet&id=<?= $item->getSnippetId(); ?>">
                <li class="<?= $item->getSnippetId() == $snippet->getSnippetId() ? 'selected' : ''; ?>">
                    <p><?= $item->getTitle(); ?></p>
                    <p><?= $item->getLanguage(); ?></p>
                    <p><?= $item->getDateCrea(); ?></p>
                    <p><?= $item->getCatId(); ?></p>
                </li>
            </a>
        <?php endforeach; ?>
    </ul>
</aside>
<section class="flexgrow2">
    <h1><?= $h2; ?></h1>
    <p>
        <h2 id="titlesnippet"><?= $snippet->getTitle(); ?></h2>
        <?php
            if ($snippet) {
                ?>
                <p><?= $snippet->getSnippetId(); ?></p>
                <p><?= $snippet->getTitle(); ?></p>
                <p><?= $snippet->getLanguage(); ?></p>
                <p><?= $snippet->getCode(); ?></p>
                <p><?= $snippet->getDateCrea(); ?></p>
                <p><?= $snippet->getComment(); ?></p>
                <p><?= $snippet->getRequirement(); ?></p>
                <p><?= $snippet->getUser()->getName(); ?></p>
                <p><?= $snippet->getCat()->getLabel(); ?></p>
                <?php
            } else {
                echo 'Impossible de trouver le snippet.';
            }
        ?>
    </p>
    <p>
        <a href="<?= ROOT_DIR; ?>/view/updSnippetView.php?id=<?= $snippet->getSnippetId(); ?>"><button class="btn btn-secondary">Modifier</button></a>
        <a href="<?= ROOT_DIR; ?>/view/delSnippetView.php?id=<?= $snippet->getSnippetId(); ?>"><button class="btn btn-warning">Supprimer</button></a>
    </p>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
