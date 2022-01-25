<?php

require_once('../../models/Platform.php');
require_once('../../controllers/connection/DBConnection.php');

function listPlatforms()
{
    $mysqli = initConectionDB();
    $platformList = $mysqli->query("SELECT * FROM platform");

    $platformsArray = [];
    foreach ($platformList as $platformItem) {
        $platformObject = new Platform($platformItem['id'], $platformItem['name']);
        array_push($platformsArray, $platformObject);
    }
    $mysqli->close();

    return $platformsArray;
}

function storePlatform($platformName)
{
    $mysqli = initConectionDB();

    $platformCreated = false;
    if ($mysqli->query("INSERT INTO platform (name) VALUES('$platformName')")) {
        $platformCreated = true;
    }
    $mysqli->close();
    return $platformCreated;
}

function updatePlatform($platformId, $platformName)
{
    $mysqli = initConectionDB();

    $platformEdited = false;
    if ($mysqli->query("UPDATE platform SET name = '$platformName' WHERE id = $platformId")) {
        $platformEdited = true;
    }
    $mysqli->close();
    return $platformEdited;
}

function deletePlatform($platformId)
{
    $mysqli = initConectionDB();

    $platformDeleted = false;
    if ($mysqli->query("DELETE FROM platform WHERE id = $platformId")) {
        $platformDeleted = true;
    }
    $mysqli->close();
    return $platformDeleted;
}

function getPlatform($platformId, $mysqli)
{
    return getPlatformObject($platformId, $mysqli);
}

function getPlatformData($platformId)
{
    $mysqli = initConectionDB();
    return getPlatformObject($platformId, $mysqli);
}

function getPlatformObject($platformId, $mysqli)
{
    $platformList = $mysqli->query("SELECT * FROM platform WHERE id = '$platformId'");
    $platformObject = null;
    foreach ($platformList as $platformItem) {
        $platformObject = new Platform($platformItem['id'], $platformItem['name']);
    }
    return $platformObject;
}

?>
