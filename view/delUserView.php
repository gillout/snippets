<?php $title = 'Snippets'; ?>
<?php $h1 = 'Résultat de la suppression d\'un utilisateur.'; ?>

<?php ob_start(); ?>
<section>
    <h1><?= $h1; ?></h1>
    <p>
        <?php
            if ($result > 0) {
                echo 'L\'utilisateur a été supprimé avec succès.';
            } else {
                echo 'Erreur lors de la suppression de l\'utilisateur.';
            }
        ?>
    </p>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
