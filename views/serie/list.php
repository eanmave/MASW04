<?php
require_once('../../controllers/SerieController.php')
?>
<head>
    <meta charset="UTF-8">
    <title>titulo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<div>
    <br>
    <div>
        <a href="../serie/create.php" class="btn btn-primary">Crear serie</a>
    </div>
    <br>
    <?php
$listSeries = listSeries();

if (count($listSeries) > 0) {
    ?>
    <table class="table">
        <thead>
            <th>Id</th>
            <th>Nombre</th>
            <th>Plataforma</th>
            <th>Director</th>
            <th>Acciones</th>
        </thead>
        <tbody>
    <?php foreach($listSeries as $serie){?>
            <tr>
                <td><?php echo $serie->getId();?></td>
                <td><?php echo $serie->getTitle();?></td>
                <td><?php echo $serie->getPlatform();?></td>
                <td><?php echo $serie->getDirector();?></td>
                <td>
                    <div class="btn-toolbar">
                        <div>
                        <a class="btn btn-success" href="edit.php?id=<?php echo $serie->getId();?>">Editar</a>
                        </div>
                        &#160
                        <div>
                        <form name="delete_serie" action="delete.php" method="POST" style="...">
                            <input type="hidden" name="serieId" value="<?php echo $serie->getId();?>"/>
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
    <p>No contiene series</p>
    <?php
}
?>
    <br>
    <a href="../../index.html" class="btn btn-primary">Biblioteca</a>
    <br>
</div>
