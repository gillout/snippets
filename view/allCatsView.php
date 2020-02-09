<?php $title = 'Snippets'; ?>
<?php $h1 = 'Liste des catégories'; ?>

<?php ob_start(); ?>
<section class="flexgrow2">
    <h1><?= $h1; ?></h1>
    <p>
        <table>
            <tr>
                <th>Id</th>
                <th>Label</th>
            </tr>
            <?php foreach ($cats as $cat) : ?>
                <tr>
                    <td><?= $cat->getCatId(); ?></td>
                    <td><?= $cat->getLabel(); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </p>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
