<?php
    $title = 'Snippets';
    $h1 = 'Tous les snippets';
    $h2 = 'Un snippet';

    ob_start();
?>
<section class="flexgrow2">
    <?php if (isset($deleted) && $deleted > 0) : ?>
        <p class="alert-success">Le snippet a été supprimé avec succès !</p>
    <?php elseif (isset($deleted)) : ?><p class="alert-danger">Echec de la suppression du snippet !</p><?php endif; ?>
    <h1><?= $h2; ?></h1>
    <p>
        <h2 id="titlesnippet"><?= $snippet->getTitle(); ?></h2>
        <?php
            if ($snippet) {
                ?>
                <p><?= $snippet->getSnippetId(); ?></p>
                <p><?= $snippet->getTitle(); ?></p>
                <p><?= $snippet->getLanguage(); ?></p>
                <pre><?= $snippet->getCode(); ?></pre>
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
        <a href="?action=addSnippet"><button class="btn btn-success">Ajouter</button></a>
        <a href="?action=updSnippet&id=<?= $snippet->getSnippetId(); ?>"><button class="btn btn-secondary">Modifier</button></a>
        <a href="?action=delSnippet&id=<?= $snippet->getSnippetId(); ?>"><button class="btn btn-danger">Supprimer</button></a>
    </p>
</section>
<?php
    $content = ob_get_clean();
    require('view/template.php');
?>
