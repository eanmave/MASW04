<?php
require_once('../../controllers/PlatformController.php')
?>
<head>
    <meta charset="UTF-8">
    <title>titulo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<?php
$sendData = false;
$error = '';
if (isset($_POST['editBtn'])) {
    $sendData = true;
}
if ($sendData && isset($_POST['platformName'])) {
    $error = updatePlatform($_POST['platformId'], $_POST['platformName']);
}

if (!$sendData) {
$platformId = $_GET['id'];
$platformObject = getPlatformData($platformId);
?>
<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Editar Plataforma</h2>
            </div>

            <form name="edit_platform" action="" method="POST">
                <div class="form-group">
                    <label>Nombre de la plataforma</label>
                    <input type="text" id="platformName" name="platformName" class="form-control" required=""
                           placeholder="Introduce el nombre de la plataforma"
                           value="<?php if (isset($platformObject)) echo $platformObject->getName(); ?>"/>
                    <input type="hidden" name="platformId" class="form-control" value="<?php echo $platformId; ?>">
                </div>
                <input type="submit" value="Editar" class="btn btn-primary" name="editBtn" required>
            </form>


            <?php
            } else {
                if (empty($error)) {
                    ?>
                    <div class="row">
                        <div class="alert alert-success" role="alert">
                            Plataforma editada correctamente. <br><a href="list.php">Volver al listado de
                                plataformas</a>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            La plataforma no se ha editado correctamente. <br><br><?php echo $error; ?><br><br><a href="edit.php">Volver a
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