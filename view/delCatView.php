<?php $title = 'Snippets'; ?>
<?php $h1 = 'Suppression d\'une catégorie'; ?>

<?php ob_start(); ?>
<section>
    <h1><?= $h1; ?></h1>
    <form action="" method="POST">
        <div>
            <label>Id catégorie :</label>
            <input type="number" name="catId" value="<?php if(isset($catId)) {echo $catId;} ?>" required />
            <label>Label :</label>
            <input type="text" name="label" value="<?php if(isset($label)) {echo $label;} ?>" required />
        </div>
    </form>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>