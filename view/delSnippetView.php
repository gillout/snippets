<?php $title = 'Snippets'; ?>
<?php $h1 = 'Suppression d\'un snippet'; ?>

<?php ob_start(); ?>
<section>
    <h1><?= $h1; ?></h1>
    <form action="" method="POST">
        <div>
            <label>Id snippet :</label>
            <input type="number" name="snippetId" value="<?php if(isset($snippetId)) {echo $snippetId;} ?>" required />
        </div>
        <div>
            <label>Titre :</label>
            <input type="text" name="title" value="<?php if(isset($title)) {echo $title;} ?>" required />
        </div>
        <div>
            <label>Langage :</label>
            <input type="text" name="language" value="<?php if(isset($language)) {echo $language;} ?>" required />
        </div>
        <div>
            <label>Code :</label>
            <textarea name="code" rows="10" cols="100" maxlength="" required>
                <?php if(isset($code)) {echo $code;} ?></textarea>
        </div>
        <div>
            <label>Date de création :</label>
            <input type="date" name="dateCrea" value="<?php if(isset($dateCrea)) {echo $dateCrea;} ?>" required />
        </div>
        <div>
            <label>Commentaire :</label>
            <input type="text" name="comment" value="<?php if(isset($comment)) {echo $comment;} ?>" required />
        </div>
        <div>
            <label>Prérequis :</label>
            <input type="text" name="requirement" value="<?php if(isset($requirement)) {echo $requirement;} ?>" />
        </div>
        <div>
            <label>Id utilisateur :</label>
            <input type="number" name="userId" value="<?php if(isset($userId)) {echo $userId;} ?>" required />
        </div>
        <div>
            <label>Id catégorie :</label>
            <input type="number" name="catId" value="<?php if(isset($catId)) {echo $catId;} ?>" required />
        </div>
        <div>
            <button class="btn btn-danger">Valider la suppression</button>
        </div>
    </form>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>
