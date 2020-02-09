<?php
    $title = 'Snippets';
    $isUpdate = isset($snippet);
    $h2 = $isUpdate ? 'Modification d\'un snippet' : 'Ajout d\'un snippet';
    $action = $isUpdate ? "?action=updSnippet&id={$_GET['id']}" : "?action=addSnippet";
    ob_start();
?>
<section class="flexgrow2">
    <h1><?= $h2; ?></h1>
    <form autocomplete="off" action="<?= $action ?>" method="POST">
        <?php if ($isUpdate) { ?>
                <input type="text" name="snippetId" value="<?= $isUpdate ? $snippet->getSnippetId() : '' ?>" hidden>
        <?php } ?>
        <div>
            <label>Titre :</label>
            <input type="text" name="title" value="<?= $isUpdate ? $snippet->getTitle() : '' ?>" required>
        </div>
        <div>
            <label>Langage :</label>
            <input type="text" name="language" value="<?= $isUpdate ? $snippet->getLanguage() : '' ?>" required>
        </div>
        <div>
            <label>Code :</label>
            <textarea name="code" rows="8" cols="50" required><?= $isUpdate ? $snippet->getCode() : '' ?></textarea>
        </div>
        <div>
            <label>Date de création :</label>
            <input type="date" name="dateCrea" value="<?= $isUpdate ? $snippet->getDateCrea() : '' ?>">
        </div>
        <div>
            <label>Commentaire :</label>
            <textarea name="comment" rows="4" cols="50"><?= $isUpdate ? $snippet->getComment() : '' ?></textarea>
        </div>
        <div>
            <label>Prérequis :</label>
            <input type="text" name="requirement" value="<?= $isUpdate ? $snippet->getRequirement() : '' ?>">
        </div>
        <div>
            <label>Id utilisateur :</label>

            <select name="userId">
                <?php foreach($users as $user) : ?>
                    <option value="<?= $user->getUserId(); ?>"<?= ($isUpdate && $snippet->getUserId() == $user->getUserId()) ? 'selected' : '' ?>><?= $user->getName(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
<!--        <div>-->
<!--            <label>Id catégorie :</label>-->
<!--            <input type="number" name="catId" value="--><?//= $isUpdate ? $snippet->getCatId() : '' ?><!--" required>-->
<!--        </div>-->
        <div>
            <button class="btn btn-primary" name="validate">Valider</button>
        </div>
    </form>
</section>
<?php
    $content = ob_get_clean();
    require_once(ROOT_DIR . '/view/template.php');
?>
