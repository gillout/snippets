<?php
    $title = 'Snippets';
    $isUpdate = isset($snippetDto);
    $h2 = $isUpdate ? 'Modification d\'un snippet' : 'Ajout d\'un snippet';
    $action = $isUpdate ? "?action=updSnippet&id={$_GET['id']}" : "?action=addSnippet";
    ob_start();
?>
<section>
    <h1><?= $h2; ?></h1>
    <form autocomplete="off" action="<?= $action ?>" method="POST">
        <?php if ($isUpdate) { ?>
                <input type="text" name="snippetId" value="<?= $isUpdate ? $snippetDto->getSnippetId() : '' ?>" hidden>
        <?php } ?>
        <div class="form-group">
            <label for="title">Titre :</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $isUpdate ? $snippetDto->getTitle() : '' ?>" required>
        </div>
        <div class="form-group">
            <label for="code">Code :</label>
            <textarea class="form-control" id="code" name="code" rows="8" cols="50" required><?= $isUpdate ? $snippetDto->getCode() : '' ?></textarea>
        </div>
        <div class="form-group">
            <label for="comment">Commentaire :</label>
            <textarea class="form-control" id="comment" name="comment" rows="4" cols="50"><?= $isUpdate ? $snippetDto->getComment() : '' ?></textarea>
        </div>
        <div class="form-group">
            <label for="requirement">Prérequis :</label>
            <input type="text" class="form-control" id="requirement" name="requirement" value="<?= $isUpdate ? $snippetDto->getRequirement() : '' ?>">
        </div>
        <div class="form-group">
            <label for="userid">Utilisateur :</label>
            <select class="form-control" id="userid" name="userId">
                <?php foreach($users as $user) : ?>
                    <option value="<?= $user->getUserId(); ?>"<?= ($isUpdate && $snippetDto->getUser()->getUserId() == $user->getUserId()) ? ' selected' : '' ?>><?= $user->getName(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="languageid">Langage :</label>
            <select class="form-control" id="languageid" name="languageId">
                <?php foreach($languages as $language) : ?>
                    <option value="<?= $language->getLanguageId() ?>"<?= ($isUpdate && $snippetDto->getLanguage()->getLanguageId() == $language->getLanguageId()) ? ' selected' : '' ?>><?= $language->getLabel() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <button class="btn btn-primary" name="validate">Valider</button>
        </div>
    </form>
</section>
<?php
    $content = ob_get_clean();
    require_once(ROOT_DIR . '/view/template.php');
?>
