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
$languageCreated = false;
if (isset($_POST['createBtn'])) {
    $sendData = true;
}
if ($sendData && isset($_POST['languageName']) && isset($_POST['isoCode'])) {
    $languageCreated = storeLanguage($_POST['languageName'], $_POST['isoCode']);
}

if (!$sendData) {
?>
<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Crear Idioma</h2>
            </div>

            <form name="create_language" action="" method="POST">
                <div class="form-group">
                    <label>Idioma</label>
                    <input type="text" name="languageName" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label>Codigo ISO</label>
                    <input type="text" name="isoCode" class="form-control" required="" maxlength="2">
                </div>
                <input type="submit" value="Crear" class="btn btn-primary" name="createBtn" required>
            </form>
<?php
} else {
    if ($languageCreated) {
        ?>
            <div class="row">
                <div class="alert alert-success" role="alert">
                    Idioma creado correctamente. <br><a href="list.php">Volver al listado de idiomas</a>
                </div>
            </div>
        <?php
    } else {
        ?>
            <div class="row">
                <div class="alert alert-danger" role="alert">
                    El idioma no se ha creado correctamente. <br><a href="create.php">Volver a
                        intentarlo</a>
                </div>
            </div>
        <?php
            }
        }
        ?>
        <br>
        <a href="../../index.html" class="btn btn-primary">Biblioteca</a>
        <br>
        </div>
    </div>
</div>