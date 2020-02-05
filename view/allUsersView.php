<?php $title = 'Snippets'; ?>
<?php $h1 = 'Liste des utilisateurs'; ?>

<?php ob_start(); ?>
<section>
    <h1><?= $h1; ?></h1>
    <p>
        <table>
            <tr>
                <th>Id</th>
                <th>Label</th>
            </tr>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= $user->getUserId(); ?></td>
                    <td><?= $user->getName(); ?></td>
                    <td><?= $user->getEmail(); ?></td>
                    <td><?= $user->getPwd(); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </p>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
