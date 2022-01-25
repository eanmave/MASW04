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
$serieEdited = false;
if (isset($_POST['editBtn'])) {
    $sendData = true;
}
if ($sendData && isset($_POST['title']) && isset($_POST['platformId']) && isset($_POST['directorId']) && isset($_POST['actorIds']) && isset($_POST['audioLanguageIds']) && isset($_POST['subtitleLanguageIds'])) {
    $serieEdited = updateSerie($_POST['serieId'], $_POST['title'], $_POST['platformId'], $_POST['directorId'], $_POST['actorIds'], $_POST['audioLanguageIds'], $_POST['subtitleLanguageIds']);
}

if (!$sendData) {
$serieId = $_GET['id'];
$serieObject = getSerieData($serieId);
$serieActors = getIdList($serieObject->getActors());
$serieAudioLanguages = getIdList($serieObject->getAudioLanguages());
$serieSubtitleLanguages = getIdList($serieObject->getSubtitleLanguages());
?>
<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Editar Serie</h2>
            </div>

            <form name="edit_serie" action="" method="POST">
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" id="title" name="title" class="form-control" required=""
                           placeholder="Introduce el titulo"
                           value="<?php if (isset($serieObject)) echo $serieObject->getTitle(); ?>"/>
                </div>
                <div class="form-group">
                    <label>Plataforma</label>
                    <select name="platformId" class="form-control" required="">
                        <?php
                        foreach($platforms as $platform){ ?>
                            <option value="<?php echo $platform->getId();?>" <?php if($serieObject->getPlatform()==$platform){ echo "selected";}?>><?php echo $platform->getName();?></option>
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
                            <option value="<?php echo $director->getId();?>" <?php if($serieObject->getDirector()==$director){ echo "selected";}?>><?php echo $director->getFullName();?></option>
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
                            <option value="<?php echo $actor->getId();?> <?php if(isset($serieActors[$actor->getId()])){ echo "selected";}?>"><?php echo $actor->getFullName();?></option>
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
                            <option value="<?php echo $language->getId();?> <?php if(isset($serieAudioLanguages[$language->getId()])){ echo "selected";}?>"><?php echo $language->getName();?></option>
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
                            <option value="<?php echo $language->getId();?> <?php if(isset($serieSubtitleLanguages[$language->getId()])){ echo "selected";}?>"><?php echo $language->getName();?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <input type="hidden" name="serieId" class="form-control" value="<?php echo $serieId; ?>">
                <input type="submit" value="Editar" class="btn btn-primary" name="editBtn" required>
            </form>
            <?php
            } else {
                if ($serieEdited) {
                    ?>
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            Serie editado correctamente. <br><a href="list.php">Volver al listado de
                                series</a>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            El serie no se ha editado correctamente. <br><a href="edit.php">Volver a
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