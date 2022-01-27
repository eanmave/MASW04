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
$error = '';
if (isset($_POST['createBtn'])) {
    $sendData = true;
}
if ($sendData && isset($_POST['givenName']) && isset($_POST['surNames']) && isset($_POST['birthDate']) && isset($_POST['country'])) {
    $error = storeActor($_POST['givenName'], $_POST['surNames'], $_POST['birthDate'], $_POST['country']);
}

if (!$sendData) {
?>
<div class="container mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h2>Crear Actor</h2>
            </div>

            <form name="create_actor" action="" method="POST">
                <div class="form-group">
                    <label>Nombres</label>
                    <input type="text" name="givenName" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label>Apellidos</label>
                    <input type="text" name="surNames" class="form-control" required="">
                </div>
                <div class="input-group date" data-provide="datepicker">
                    <label>Fecha nacimiento</label>
                    <input type="date" name="birthDate" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label>Pais</label>
                    <input type="text" name="country" class="form-control" required="" maxlength="3">
                </div>
                <input type="submit" value="Crear" class="btn btn-primary" name="createBtn" required>
            </form>
<?php
} else {
    if (empty($error)) {
        ?>
            <div class="row">
                <div class="alert alert-success" role="alert">
                    Actor creado correctamente. <br><a href="list.php">Volver al listado de actores</a>
                </div>
            </div>
        <?php
    } else {
        ?>
            <div class="row">
                <div class="alert alert-danger" role="alert">
                    El actor no se ha creado correctamente. <br><br><?php echo $error; ?><br><br><a href="create.php">Volver a
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