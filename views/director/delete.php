<?php
require_once('../../controllers/DirectorController.php')
?>
<head>
    <meta charset="UTF-8">
    <title>titulo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<?php
$directorId = $_POST['directorId'];
$error = deleteDirector($directorId);

if (empty($error)) {
    ?>
    <div class="row">
        <div class="alert alert-success" role="alert">
            Director borrado correctamente. <br><a href="list.php">Volver al listado de
                directores</a>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="row">
        <div class="alert alert-danger" role="alert">
            El director no se ha borrado correctamente. <br><br><?php echo $error; ?><br><br><a href="list.php">Regresar</a>
        </div>
    </div>
    <?php
}

?>
