<?php
require_once('../../controllers/DirectorController.php')
?>
<head>
    <meta charset="UTF-8">
    <title>titulo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<?php
$sendData = false;
$directorEdited = false;
if (isset($_POST['editBtn'])) {
    $sendData = true;
}
if ($sendData && isset($_POST['givenName']) && isset($_POST['surNames']) && isset($_POST['birthDate']) && isset($_POST['country'])) {
    $directorEdited = updateDirector($_POST['directorId'], $_POST['givenName'], $_POST['surNames'], $_POST['birthDate'], $_POST['country']);
}

if (!$sendData) {
$directorId = $_GET['id'];
$directorObject = getDirectorData($directorId);
?>
<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Editar Director</h2>
            </div>

            <form name="edit_director" action="" method="POST">
                <div class="form-group">
                    <label>Nombre del idioma</label>
                    <input type="text" id="givenName" name="givenName" class="form-control" required=""
                           placeholder="Introduce el nombre"
                           value="<?php if (isset($directorObject)) echo $directorObject->getGivenName(); ?>"/>
                    <input type="text" id="surNames" name="surNames" class="form-control" required=""
                           placeholder="Introduce los apellidos"
                           value="<?php if (isset($directorObject)) echo $directorObject->getSurnames(); ?>"/>
                    <input type="text" id="birthDate" name="birthDate" class="form-control" required=""
                           placeholder="Introduce la fecha de nacimiento"
                           value="<?php if (isset($directorObject)) echo $directorObject->getBirthDate(); ?>"/>
                    <input type="text" id="country" name="country" class="form-control" required=""
                           placeholder="Introduce el pais de origen"
                           value="<?php if (isset($directorObject)) echo $directorObject->getCountry(); ?>"/>
                    <input type="hidden" name="directorId" class="form-control" value="<?php echo $directorId; ?>">
                </div>
                <input type="submit" value="Editar" class="btn btn-primary" name="editBtn" required>
            </form>


            <?php
            } else {
                if ($directorEdited) {
                    ?>
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            Director editado correctamente. <br><a href="list.php">Volver al listado de
                                directores</a>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            El director no se ha editado correctamente. <br><a href="edit.php">Volver a
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