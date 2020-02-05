<?php $title = 'Snippets'; ?>
<?php $h1 = 'Une catégorie'; ?>

<?php ob_start(); ?>
<section>
    <h1><?= $h1; ?></h1>
    <p>
        <?php
            if ($cat) {
                ?>
                    <table>
                        <tr>
                            <th>Id</th>
                            <th>Label</th>
                        </tr>
                        <tr>
                            <td><?= $cat->getCatId(); ?></td>
                            <td><?= $cat->getLabel(); ?></td>
                        </tr>
                    </table>
                <?php
                // var_dump($user);
            } else {
                echo 'Impossible de trouver la catégorie.';
            }
        ?>
    </p>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
