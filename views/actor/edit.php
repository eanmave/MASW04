<?php
require_once('../../controllers/ActorController.php')
?>
<head>
    <meta charset="UTF-8">
    <title>titulo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<?php
$sendData = false;
$actorEdited = false;
if (isset($_POST['editBtn'])) {
    $sendData = true;
}
if ($sendData && isset($_POST['givenName']) && isset($_POST['surNames']) && isset($_POST['birthDate']) && isset($_POST['country'])) {
    $actorEdited = updateActor($_POST['actorId'], $_POST['givenName'], $_POST['surNames'], $_POST['birthDate'], $_POST['country']);
}

if (!$sendData) {
$actorId = $_GET['id'];
$actorObject = getActorData($actorId);
?>
<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Editar Actor</h2>
            </div>

            <form name="edit_actor" action="" method="POST">
                <div class="form-group">
                    <label>Nombre del idioma</label>
                    <input type="text" id="givenName" name="givenName" class="form-control" required=""
                           placeholder="Introduce el nombre"
                           value="<?php if (isset($actorObject)) echo $actorObject->getGivenName(); ?>"/>
                    <input type="text" id="surNames" name="surNames" class="form-control" required=""
                           placeholder="Introduce los apellidos"
                           value="<?php if (isset($actorObject)) echo $actorObject->getSurnames(); ?>"/>
                    <input type="text" id="birthDate" name="birthDate" class="form-control" required=""
                           placeholder="Introduce la fecha de nacimiento"
                           value="<?php if (isset($actorObject)) echo $actorObject->getBirthDate(); ?>"/>
                    <input type="text" id="country" name="country" class="form-control" required=""
                           placeholder="Introduce el pais de origen"
                           value="<?php if (isset($actorObject)) echo $actorObject->getCountry(); ?>"/>
                    <input type="hidden" name="actorId" class="form-control" value="<?php echo $actorId; ?>">
                </div>
                <input type="submit" value="Editar" class="btn btn-primary" name="editBtn" required>
            </form>


            <?php
            } else {
                if ($actorEdited) {
                    ?>
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            Actor editado correctamente. <br><a href="list.php">Volver al listado de
                                actores</a>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            El actor no se ha editado correctamente. <br><a href="edit.php">Volver a
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