<?php
require_once('../../controllers/LanguageController.php')
?>
<head>
    <meta charset="UTF-8">
    <title>titulo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<div>
    <br>
    <div>
        <a href="../language/create.php" class="btn btn-primary">Crear idioma</a>
    </div>
    <br>
    <?php
$listLanguages = listLanguages();

if (count($listLanguages) > 0) {
    ?>
    <table class="table">
        <thead>
            <th>Id</th>
            <th>Nombre</th>
            <th>ISO</th>
            <th>Acciones</th>
        </thead>
        <tbody>
    <?php foreach($listLanguages as $language){?>
            <tr>
                <td><?php echo $language->getId();?></td>
                <td><?php echo $language->getName();?></td>
                <td><?php echo $language->getIsoCode();?></td>
                <td>
                    <div class="btn-toolbar">
                        <div>
                        <a class="btn btn-success" href="edit.php?id=<?php echo $language->getId();?>">Editar</a>
                        </div>
                        &#160
                        <div>
                        <form name="delete_language" action="delete.php" method="POST" style="...">
                            <input type="hidden" name="languageId" value="<?php echo $language->getId();?>"/>
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
    <p>No contiene idiomas</p>
    <?php
}
?>
    <br>
    <a href="../../index.html" class="btn btn-primary">Biblioteca</a>
    <br>
</div>
