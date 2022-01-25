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
$directorDeleted = deleteDirector($directorId);

if ($directorDeleted) {
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
            El director no se ha borrado correctamente. <br><a href="delete.php">Volver a
                intentarlo</a>
        </div>
    </div>
    <?php
}

?>
