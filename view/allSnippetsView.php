<?php $title = 'Snippets'; ?>
<?php $h1 = 'Tous les Snippets'; ?>

<?php ob_start(); ?>
<h1><?= $h1; ?></h1>
<aside>
    <?php foreach ($snippets as $snippet) : ?>
    <article>
        <p><?= $snippet->getSnippetId(); ?></p>
        <p><?= $snippet->getTitle(); ?></p>
        <p><?= $snippet->getLanguage(); ?></p>
        <p><?= $snippet->getCode(); ?></p>
        <p><?= $snippet->getDateCrea(); ?></p>
        <p><?= $snippet->getComment(); ?></p>
        <p><?= $snippet->getRequirement(); ?></p>
        <p><?= $snippet->getUserId(); ?></p>
        <p><?= $snippet->getCatId(); ?></p>
    </article>
    <?php endforeach; ?>
</aside>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
