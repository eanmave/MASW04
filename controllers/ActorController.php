<?php

require_once('../../models/Actor.php');
require_once('../../controllers/connection/DBConnection.php');
require_once('../../utils/DateUtils.php');

function listActors()
{
    $mysqli = initConectionDB();
    $actorList = $mysqli->query("SELECT * FROM actor");

    $actorsArray = [];
    foreach ($actorList as $actorItem) {
        $actorObject = new Actor($actorItem['id'], $actorItem['given_name'], $actorItem['surnames'], $actorItem['birth_date'], $actorItem['country']);
        array_push($actorsArray, $actorObject);
    }
    $mysqli->close();

    return $actorsArray;
}

function storeActor($givenName, $surNames, $birthDate, $country)
{
    $mysqli = initConectionDB();

    $error = '';
    $formattedDate = formatDate($birthDate);
    if (!$mysqli->query("INSERT INTO actor (given_name, surnames, birth_date, country) VALUES('$givenName', '$surNames', '$formattedDate', '$country')")) {
        $error = error($mysqli);
    }
    $mysqli->close();
    return $error;
}

function updateActor($actorId, $givenName, $surNames, $birthDate, $country)
{
    $mysqli = initConectionDB();

    $error = '';
    $formattedDate = formatDate($birthDate);
    if (!$mysqli->query("UPDATE actor SET given_name = '$givenName', surnames = '$surNames', birth_date = '$formattedDate', country = '$country' WHERE id = $actorId")) {
        $error = error($mysqli);
    }
    $mysqli->close();
    return $error;
}

function deleteActor($actorId)
{
    $mysqli = initConectionDB();

    $error = '';
    if (!$mysqli->query("DELETE FROM actor WHERE id = $actorId")) {
        $error = error($mysqli);
    }
    $mysqli->close();
    return $error;
}


function getActorData($idactor)
{
    $mysqli = initConectionDB();

    $actorList = $mysqli->query("SELECT * FROM actor WHERE id = $idactor");
    $actorObject = null;

    foreach ($actorList as $actorItem) {
        $actorObject = new Actor($actorItem['id'], $actorItem['given_name'], $actorItem['surnames'], $actorItem['birth_date'], $actorItem['country']);
    }
    $mysqli->close();

    return $actorObject;
}

?>
