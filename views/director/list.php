<?php
require_once('../../controllers/DirectorController.php')
?>
<head>
    <meta charset="UTF-8">
    <title>titulo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<div>
    <br>
    <div>
        <a href="../director/create.php" class="btn btn-primary">Crear director</a>
    </div>
    <br>
    <?php
$listDirectors = listDirectors();

if (count($listDirectors) > 0) {
    ?>
    <table class="table">
        <thead>
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Fecha nacimiento</th>
            <th>Pais</th>
            <th>Acciones</th>
        </thead>
        <tbody>
    <?php foreach($listDirectors as $director){?>
            <tr>
                <td><?php echo $director->getId();?></td>
                <td><?php echo $director->getGivenName();?></td>
                <td><?php echo $director->getSurnames();?></td>
                <td><?php echo $director->getBirthDate();?></td>
                <td><?php echo $director->getCountry();?></td>
                <td>
                    <div class="btn-toolbar">
                        <div>
                        <a class="btn btn-success" href="edit.php?id=<?php echo $director->getId();?>">Editar</a>
                        </div>
                        &#160
                        <div>
                        <form name="delete_director" action="delete.php" method="POST" style="...">
                            <input type="hidden" name="directorId" value="<?php echo $director->getId();?>"/>
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </form>
                        </div>
                    </div>
                </td>
            </tr>
        <?php }?>
        </tbody>

    </table>
    <?php
} else {
    ?>
    <p>No contiene directores</p>
    <?php
}
?>
    <br>
    <a href="../../index.html" class="btn btn-primary">Biblioteca</a>
    <br>
</div>
