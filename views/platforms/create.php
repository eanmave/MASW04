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
$platformCreated = false;
if (isset($_POST['createBtn'])) {
    $sendData = true;
}
if ($sendData && isset($_POST['platformName'])) {
    $platformCreated = storePlatform($_POST['platformName']);
}

if (!$sendData) {
?>
<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Crear Plataforma</h2>
            </div>

            <form name="create_platform" action="" method="POST">
                <div class="form-group">
                    <label>Nombre de la plataforma</label>
                    <input type="text" name="platformName" class="form-control" required="">
                </div>
                <input type="submit" value="Crear" class="btn btn-primary" name="createBtn" required>
            </form>
<?php
} else {
    if ($platformCreated) {
        ?>
            <div class="row">
                <div class="alert alert-success" role="alert">
                    Plataforma creada correctamente. <br><a href="list.php">Volver al listado de plataformas</a>
                </div>
            </div>
        <?php
    } else {
        ?>
            <div class="row">
                <div class="alert alert-danger" role="alert">
                    La plataforma no se ha creado correctamente. <br><a href="create.php">Volver a
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