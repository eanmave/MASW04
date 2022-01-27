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

    $error = '';
    if (!$mysqli->query("INSERT INTO platform (name) VALUES('$platformName')")) {
        $error = error($mysqli);
    }
    $mysqli->close();
    return $error;
}

function updatePlatform($platformId, $platformName)
{
    $mysqli = initConectionDB();

    $error = '';
    if (!$mysqli->query("UPDATE platform SET name = '$platformName' WHERE id = $platformId")) {
        $error = error($mysqli);
    }
    $mysqli->close();
    return $error;
}

function deletePlatform($platformId)
{
    $mysqli = initConectionDB();

    $error ='';
    if (!$mysqli->query("DELETE FROM platform WHERE id = $platformId")) {
        $error = error($mysqli);
    }
    $mysqli->close();
    return $error;
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
