<?php

require_once('../../models/Serie.php');
require_once('../../controllers/connection/DBConnection.php');
require_once('../../controllers/PlatformController.php');
require_once('../../controllers/DirectorController.php');

function listSeries()
{
    $mysqli = initConectionDB();
    $serieList = $mysqli->query("SELECT * FROM serie");

    $seriesArray = [];
    foreach ($serieList as $serieItem) {

        $serieId = $serieItem['id'];
        $platformId = $serieItem['platform_id'];
        $directorId=$serieItem['director_id'];
        $director=getDirectorData($directorId);
        $platform = getPlatform($platformId, $mysqli);
        $subtitlesLanguages = $mysqli->query("SELECT l.* FROM serie_subtitle_language as ssl1 JOIN language as l on ssl1.language_id = l.id WHERE ssl1.serie_id = $serieId");
        $audioLanguages = $mysqli->query("SELECT l.* FROM serie_audio_language as sal JOIN language as l on sal.language_id = l.id WHERE sal.serie_id = $serieId");
        $actors = $mysqli->query("SELECT * FROM actor_serie as as1 JOIN actor a on a.id = as1.actor_id WHERE as1.serie_id = $serieId");

        $serieObject = new Serie($serieId, $serieItem['title'], $platform->getName(),$director->getGivenName().' '.$director->getSurnames(), $actors, $audioLanguages, $subtitlesLanguages);
        array_push($seriesArray, $serieObject);
    }
    $mysqli->close();

    return $seriesArray;
}

function storeSerie($title, $platformId, $directorId, $actorIds, $audioLanguagesIds, $subtitleLanguageIds)
{
    $mysqli = initConectionDB();

    $serieCreated = false;
    if ($mysqli->query("INSERT INTO serie (title, platform_id, director_id) VALUES('$title', '$platformId', '$directorId')")) {
        $serieId = getSerieIdFromTitle($title, $mysqli);
        $serieCreated = saveReferences($serieId, $actorIds, $audioLanguagesIds, $subtitleLanguageIds, $mysqli);
    }
    $mysqli->close();
    return $serieCreated;
}

function updateSerie($serieId, $title, $platformId, $directorId, $actorIds, $audioLanguagesIds, $subtitleLanguageIds)
{
    $mysqli = initConectionDB();

    $serieUpdated = false;
    if ($mysqli->query("UPDATE serie SET title = '$title', platform_id = '$platformId', director_id = '$directorId' WHERE id = '$serieId'")) {
        deleteReferences($serieId, $mysqli);
        $serieUpdated = saveReferences($serieId, $actorIds, $audioLanguagesIds, $subtitleLanguageIds, $mysqli);
    }
    $mysqli->close();
    return $serieUpdated;
}

function deleteSerie($serieId)
{
    $mysqli = initConectionDB();

    $serieDeleted = false;
    if (deleteReferences($serieId, $mysqli) && $mysqli->query("DELETE FROM serie WHERE id = '$serieId'")) {
        $serieDeleted = true;
    }
    $mysqli->close();
    return $serieDeleted;
}

function getSerieIdFromTitle($title, $mysqli)
{
    $serieId = null;
    $serieList = $mysqli->query("SELECT * FROM serie WHERE title = '$title'");
    foreach ($serieList as $serieItem) {
        $serieId = $serieItem['id'];
    }
    return $serieId;
}

function getSerieData($serieId)
{
    $mysqli = initConectionDB();

    $serieList = $mysqli->query("SELECT * FROM serie WHERE id = '$serieId'");
    $serieObject = null;

    foreach ($serieList as $serieItem) {$platformId = $serieItem['platform_id'];
        $platform = getPlatform($platformId, $mysqli);
        $directorId = $serieItem['director_id'];
        $subtitlesLanguagesResponse = $mysqli->query("SELECT l.* FROM serie_subtitle_language as ssl1 JOIN language as l on ssl1.language_id = l.id WHERE ssl1.serie_id = $serieId");
        $audioLanguagesResponse = $mysqli->query("SELECT l.* FROM serie_audio_language as sal JOIN language as l on sal.language_id = l.id WHERE sal.serie_id = $serieId");
        $actorsResponse = $mysqli->query("SELECT * FROM actor_serie as as1 JOIN actor a on a.id = as1.actor_id WHERE as1.serie_id = $serieId");
        $directorsResponse = $mysqli->query("SELECT * FROM director as d WHERE d.id = $directorId");

        $subtitlesLanguages = languageFromResponse($subtitlesLanguagesResponse);
        $audioLanguages = languageFromResponse($audioLanguagesResponse);
        $actors = actorFromResponse($actorsResponse);
        $director = directorFromResponse($directorsResponse);

        $serieObject = new Serie($serieId, $serieItem['title'], $platform, $director, $actors, $audioLanguages, $subtitlesLanguages);
    }
    $mysqli->close();

    return $serieObject;
}

function languageFromResponse(mysqli_result $languagesResponse)
{
    $languageObject = null;
    foreach ($languagesResponse as $languageItem) {
        $languageObject = new Language($languageItem['id'], $languageItem['name'], $languageItem['iso_code']);
    }
    return $languageObject;
}

function directorFromResponse(mysqli_result $directorsResponse)
{
    $directorObject = null;
    foreach ($directorsResponse as $directorItem) {
        $directorObject = new Director($directorItem['id'], $directorItem['given_name'], $directorItem['surnames'], $directorItem['birth_date'],$directorItem['country']);
    }
    return $directorObject;
}

function actorFromResponse(mysqli_result $actorsResponse)
{
    $actorObject = null;
    foreach ($actorsResponse as $responseItem) {
        $actorObject = new Actor($responseItem['id'], $responseItem['given_name'], $responseItem['surnames'], $responseItem['birth_date'],$responseItem['country']);
    }
    return $actorObject;
}

function deleteReferences($serieId, $mysqli)
{
    if (!$mysqli->query("DELETE FROM actor_serie WHERE serie_id = '$serieId'")) {
        die('Error removing actors');
    }
    if (!$mysqli->query("DELETE FROM serie_audio_language WHERE serie_id = '$serieId'")) {
        die('Error removing audio languages');
    }
    if (!$mysqli->query("DELETE FROM serie_subtitle_language WHERE serie_id = '$serieId'")) {
        die('Error removing subtitle languages');
    }
    return true;
}

function saveReferences($serieId, $actorIds, $audioLanguagesIds, $subtitleLanguageIds, $mysqli)
{
    foreach ($actorIds as $actorId) {
        if (!$mysqli->query("INSERT INTO actor_serie (actor_id, serie_id) VALUES('$actorId', '$serieId')")) {
            return false;
        }
    }
    foreach ($audioLanguagesIds as $audioLanguageId) {
        if (!$mysqli->query("INSERT INTO serie_audio_language (serie_id, language_id) VALUES('$serieId', '$audioLanguageId')")) {
            return false;
        }
    }
    foreach ($subtitleLanguageIds as $subtitleLanguageId) {
        if (!$mysqli->query("INSERT INTO serie_subtitle_language (serie_id, language_id) VALUES('$serieId', '$subtitleLanguageId')")) {
            return false;
        }
    }

    return true;
}

function getIdList($objectList){
    $idList = null;
    foreach ($objectList as $item) {
        array_push($idList, $item['id']);
    }
    return $idList;
}
?>
