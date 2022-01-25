<?php
require_once('../../controllers/LanguageController.php')
?>
<head>
    <meta charset="UTF-8">
    <title>titulo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<?php
$sendData = false;
$languageEdited = false;
if (isset($_POST['editBtn'])) {
    $sendData = true;
}
if ($sendData && isset($_POST['languageName']) && isset($_POST['isoCode'])) {
    $languageEdited = updateLanguage($_POST['languageId'], $_POST['languageName'], $_POST['isoCode']);
}

if (!$sendData) {
$languageId = $_GET['id'];
$languageObject = getLanguageData($languageId);
?>
<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Editar Idioma</h2>
            </div>

            <form name="edit_language" action="" method="POST">
                <div class="form-group">
                    <label>Nombre del idioma</label>
                    <input type="text" id="languageName" name="languageName" class="form-control" required=""
                           placeholder="Introduce el nombre de la idioma"
                           value="<?php if (isset($languageObject)) echo $languageObject->getName(); ?>"/>
                    <input type="text" id="isoCode" name="isoCode" class="form-control" required=""
                           placeholder="Introduce el ISO" maxlength="2"
                           value="<?php if (isset($languageObject)) echo $languageObject->getIsoCode(); ?>"/>
                    <input type="hidden" name="languageId" class="form-control" value="<?php echo $languageId; ?>">
                </div>
                <input type="submit" value="Editar" class="btn btn-primary" name="editBtn" required>
            </form>


            <?php
            } else {
                if ($languageEdited) {
                    ?>
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            Idioma editado correctamente. <br><a href="list.php">Volver al listado de
                                idiomas</a>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            El idioma no se ha editado correctamente. <br><a href="edit.php">Volver a
                                intentarlo</a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>