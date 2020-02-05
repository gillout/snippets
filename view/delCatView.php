<?php $title = 'Snippets'; ?>
<?php $h1 = 'Résultat de la suppression d\'une catégorie.'; ?>

<?php ob_start(); ?>
<section>
    <h1><?= $h1; ?></h1>
    <p>
        <?php
            if ($result > 0) {
                echo 'La catégorie a été supprimée avec succès.';
            } else {
                echo 'Erreur lors de la suppression de la catégorie.';
            }
        ?>
    </p>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
