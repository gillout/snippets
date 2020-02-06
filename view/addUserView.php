<?php $title = 'Snippets'; ?>
<?php $h1 = 'Ajout d\'un utilisateur'; ?>

<?php ob_start(); ?>
<section>
    <h1><?= $h1; ?></h1>
    <form action="" method="POST">
        <div>
            <label>Nom :</label>
            <input type="text" name="name" value="<?php if(isset($name)) {echo $name;} ?>" required />
        </div>
        <div>
            <label>Email :</label>
            <input type="email" name="email" value="<?php if(isset($email)) {echo $email;} ?>" required />
        </div>
        <div>
            <label>Pwd :</label>
            <input type="password" name="pwd" value="<?php if(isset($pwd)) {echo $pwd;} ?>" required />
        </div>
    </form>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
