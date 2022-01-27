<?php

require_once('../../models/Director.php');
require_once('../../controllers/connection/DBConnection.php');
require_once('../../utils/DateUtils.php');

function listDirectors()
{
    $mysqli = initConectionDB();
    $directorList = $mysqli->query("SELECT * FROM director");

    $directorsArray = [];
    foreach ($directorList as $directorItem) {
        $directorObject = new Director($directorItem['id'], $directorItem['given_name'], $directorItem['surnames'], $directorItem['birth_date'], $directorItem['country']);
        array_push($directorsArray, $directorObject);
    }
    $mysqli->close();

    return $directorsArray;
}

function storeDirector($givenName, $surNames, $birthDate, $country)
{
    $mysqli = initConectionDB();

    $error = '';
    $formattedDate = formatDate($birthDate);
    if (!$mysqli->query("INSERT INTO director (given_name, surnames, birth_date, country) VALUES('$givenName', '$surNames', '$formattedDate', '$country')")) {
        $error = error($mysqli);
    }
    $mysqli->close();
    return $error;
}

function updateDirector($directorId, $givenName, $surNames, $birthDate, $country)
{
    $mysqli = initConectionDB();

    $error = '';
    $formattedDate = formatDate($birthDate);
    if (!$mysqli->query("UPDATE director SET given_name = '$givenName', surnames = '$surNames', birth_date = '$formattedDate', country = '$country' WHERE id = $directorId")) {
        $error = error($mysqli);
    }
    $mysqli->close();
    return $error;
}

function deleteDirector($directorId)
{
    $mysqli = initConectionDB();

    $error = '';
    if (!$mysqli->query("DELETE FROM director WHERE id = $directorId")) {
        $error = error($mysqli);
    }
    $mysqli->close();
    return $error;
}


function getDirectorData($iddirector)
{
    $mysqli = initConectionDB();

    $directorList = $mysqli->query("SELECT * FROM director WHERE id = $iddirector");
    $directorObject = null;

    foreach ($directorList as $directorItem) {
        $directorObject = new Director($directorItem['id'], $directorItem['given_name'], $directorItem['surnames'], $directorItem['birth_date'], $directorItem['country']);
    }
    $mysqli->close();

    return $directorObject;
}

?>
