<?php $title = 'Snippets'; ?>
<?php $h1 = 'Ajout d\'un snippet'; ?>

<?php ob_start(); ?>
<section>
    <h1><?= $h1; ?></h1>
    <p>
        <?php
            if ($user) {
                ?>
                    <table>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Pwd</th>
                        </tr>
                        <tr>
                            <td><?= $user->getUserId(); ?></td>
                            <td><?= $user->getName(); ?></td>
                            <td><?= $user->getEmail(); ?></td>
                            <td><?= $user->getPwd(); ?></td>
                        </tr>
                    </table>
                <?php
            } else {
                echo 'Impossible de trouver le snippet.';
            }
        ?>
    </p>
    <p>
        <a href="<?= ROOT_DIR; ?>/view/updUserView.php"><button>Modifier</button></a>
        <a href="<?= ROOT_DIR; ?>/view/delUserView.php"><button>Supprimer</button></a>
    </p>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
