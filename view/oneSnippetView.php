<?php
    $title = 'Snippets';
    $h1 = 'Tous les snippets';
    $h2 = 'Un snippet';

    ob_start();
?>
<section>
    <?php if (isset($deleted) && $deleted > 0) : ?>
        <p class="alert-success">Le snippet a été supprimé avec succès !</p>
    <?php elseif (isset($deleted)) : ?><p class="alert-danger">Echec de la suppression du snippet !</p><?php endif; ?>
    <h1><?= $h2; ?></h1>
    <h2 id="titlesnippet"><?= $snippetDto->getTitle(); ?></h2>
    <?php
        if ($snippetDto) {
            ?>
            <p><?= $snippetDto->getLanguage()->getLabel(); ?></p>
            <pre><code class="<?= $snippetDto->getLanguage()->getLabel(); ?>"><?= $snippetDto->getCode(); ?></code></pre>
            <p><?= date('d-m-Y h:i:s', strtotime($snippetDto->getDateCrea())); ?></p>
            <p><?= $snippetDto->getComment(); ?></p>
            <p><?= $snippetDto->getRequirement(); ?></p>
            <p><?= $snippetDto->getUser()->getName(); ?></p>
            <?php if ($snippetDto->getCats() != NULL) : ?>
                <p>Catégorie(s) :
                    <?php
                        $str = '';
                        foreach ($snippetDto->getCats() as $cat ) {
                            $str .= '<a href="?cat=' . $cat->getCatId() . '">' . $cat->getLabel() . '</a> | ';
                        }
                        echo substr($str, 0, strlen($str) - 3);
                    ?>
                </p>
            <?php endif; ?>
    <?php
        } else {
            echo 'Impossible de trouver le snippet.';
        }
    ?>
    <p>
        <a href="?action=addSnippet"><button class="btn btn-success">Ajouter</button></a>
        <a href="?action=updSnippet&id=<?= $snippetDto->getSnippetId(); ?>"><button class="btn btn-secondary">Modifier</button></a>
        <a href="?action=delSnippet&id=<?= $snippetDto->getSnippetId(); ?>"><button class="btn btn-danger">Supprimer</button></a>
    </p>
</section>
<?php
    $content = ob_get_clean();
    require('view/template.php');
?>

