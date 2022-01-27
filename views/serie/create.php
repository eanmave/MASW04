<?php
require_once('../../controllers/ActorController.php');
require_once('../../controllers/DirectorController.php');
require_once('../../controllers/PlatformController.php');
require_once('../../controllers/SerieController.php');
require_once('../../controllers/LanguageController.php');

?>
<head>
    <meta charset="UTF-8">
    <title>titulo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<?php
$languages = listLanguages();
$actors = listActors();
$directors = listDirectors();
$platforms = listPlatforms();

$sendData = false;
$error = '';
if (isset($_POST['createBtn'])) {
    $sendData = true;
}
if ($sendData && isset($_POST['title']) && isset($_POST['platformId']) && isset($_POST['directorId']) && isset($_POST['actorIds']) && isset($_POST['audioLanguageIds']) && isset($_POST['subtitleLanguageIds'])) {
    $error = storeSerie($_POST['title'], $_POST['platformId'], $_POST['directorId'], $_POST['actorIds'], $_POST['audioLanguageIds'], $_POST['subtitleLanguageIds']);
}

if (!$sendData) {
?>
<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Crear Serie</h2>
            </div>

            <form name="create_serie" action="" method="POST">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="title" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label>Plataforma</label>
                    <select name="platformId" class="form-control" required="">
                        <?php
                        foreach($platforms as $platform){ ?>
                            <option value="<?php echo $platform->getId();?>"><?php echo $platform->getName();?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Director</label>
                    <select name="directorId" class="form-control" required="">
                        <?php
                        foreach($directors as $director){ ?>
                            <option value="<?php echo $director->getId();?>"><?php echo $director->getFullName();?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Actores</label>
                    <select multiple="multiple" name="actorIds[]" class="form-control" required="">
                        <?php
                        foreach($actors as $actor){ ?>
                            <option value="<?php echo $actor->getId();?>"><?php echo $actor->getFullName();?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Idiomas de Audio</label>
                    <select multiple="multiple" name="audioLanguageIds[]" class="form-control" required="">
                        <?php
                        foreach($languages as $language){ ?>
                            <option value="<?php echo $language->getId();?>"><?php echo $language->getName();?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Idiomas de Subtítulos</label>
                    <select multiple="multiple" name="subtitleLanguageIds[]" class="form-control" required="">
                        <?php
                        foreach($languages as $language){ ?>
                            <option value="<?php echo $language->getId();?>"><?php echo $language->getName();?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <input type="submit" value="Crear" class="btn btn-primary" name="createBtn" required>
            </form>
<?php
} else {
    if (empty($error)) {
        ?>
            <div class="row">
                <div class="alert alert-success" role="alert">
                    Serie creada correctamente. <br><a href="list.php">Volver al listado de series</a>
                </div>
            </div>
        <?php
    } else {
        ?>
            <div class="row">
                <div class="alert alert-danger" role="alert">
                    El serie no se ha creado correctamente. <br><br><?php echo $error; ?><br><br><a href="create.php">Volver a
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