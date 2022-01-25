<?php
require_once('../../controllers/ActorController.php')
?>
<head>
    <meta charset="UTF-8">
    <title>titulo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<div>
    <br>
    <div>
        <a href="../actor/create.php" class="btn btn-primary">Crear actor</a>
    </div>
    <br>
    <?php
$listActors = listActors();

if (count($listActors) > 0) {
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
    <?php foreach($listActors as $actor){?>
            <tr>
                <td><?php echo $actor->getId();?></td>
                <td><?php echo $actor->getGivenName();?></td>
                <td><?php echo $actor->getSurnames();?></td>
                <td><?php echo $actor->getBirthDate();?></td>
                <td><?php echo $actor->getCountry();?></td>
                <td>
                    <div class="btn-toolbar">
                        <div>
                        <a class="btn btn-success" href="edit.php?id=<?php echo $actor->getId();?>">Editar</a>
                        </div>
                        &#160
                        <div>
                        <form name="delete_actor" action="delete.php" method="POST" style="...">
                            <input type="hidden" name="actorId" value="<?php echo $actor->getId();?>"/>
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
    <p>No contiene actores</p>
    <?php
}
?>
    <br>
    <a href="../../index.html" class="btn btn-primary">Biblioteca</a>
    <br>
</div>
