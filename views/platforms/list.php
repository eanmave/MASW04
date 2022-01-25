<?php
require_once('../../controllers/PlatformController.php');
?>
<head>
    <meta charset="UTF-8">
    <title>titulo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<div>
    <br>
    <div>
        <a href="../platforms/create.php" class="btn btn-primary">Crear plataforma</a>
    </div>
    <br>
    <?php
$listPlatforms = listPlatforms();

if (count($listPlatforms) > 0) {
    ?>
    <table class="table">
        <thead>
            <th>Id</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </thead>
        <tbody>
    <?php foreach($listPlatforms as $platform){?>
            <tr>
                <td><?php echo $platform->getId();?></td>
                <td><?php echo $platform->getName();?></td>
                <td>
                    <div class="btn-toolbar">
                        <div>
                        <a class="btn btn-success" href="edit.php?id=<?php echo $platform->getId();?>">Editar</a>
                        </div>
                        &#160
                        <div>
                        <form name="delete_platform" action="delete.php" method="POST" style="...">
                            <input type="hidden" name="platformId" value="<?php echo $platform->getId();?>"/>
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
    <p>No contiene plataforma</p>
    <?php
}
?>
    <br>
    <a href="../../index.html" class="btn btn-primary">Biblioteca</a>
    <br>
</div>
