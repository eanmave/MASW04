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

    $actorCreated = false;
    $formattedDate = formatDate($birthDate);
    if ($mysqli->query("INSERT INTO actor (given_name, surnames, birth_date, country) VALUES('$givenName', '$surNames', '$formattedDate', '$country')")) {
        $actorCreated = true;
    }
    $mysqli->close();
    return $actorCreated;
}

function updateActor($actorId, $givenName, $surNames, $birthDate, $country)
{
    $mysqli = initConectionDB();

    $actorEdited = false;
    $formattedDate = formatDate($birthDate);
    if ($mysqli->query("UPDATE actor SET given_name = '$givenName', surnames = '$surNames', birth_date = '$formattedDate', country = '$country' WHERE id = $actorId")) {
        $actorEdited = true;
    }
    $mysqli->close();
    return $actorEdited;
}

function deleteActor($actorId)
{
    $mysqli = initConectionDB();

    $actorDeleted = false;
    if ($mysqli->query("DELETE FROM actor WHERE id = $actorId")) {
        $actorDeleted = true;
    }
    $mysqli->close();
    return $actorDeleted;
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
