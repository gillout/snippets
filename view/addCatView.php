<?php $title = 'Snippets'; ?>
<?php $h1 = 'Ajout d\'une catégorie'; ?>

<?php ob_start(); ?>
<section>
    <h1><?= $h1; ?></h1>
    <form action="" method="POST">
        <div>
            <label>Label :</label>
            <input type="text" name="label" value="<?php if(isset($label)) {echo $label;} ?>" required />
        </div>
        <div>
            <button class="btn btn-primary">Valider l'ajout</button>
        </div>
    </form>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
