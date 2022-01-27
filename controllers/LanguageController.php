<?php

require_once('../../models/Language.php');
require_once('../../controllers/connection/DBConnection.php');

function listLanguages()
{
    $mysqli = initConectionDB();
    $languageList = $mysqli->query("SELECT * FROM language");

    $languagesArray = [];
    foreach ($languageList as $languageItem) {
        $languageObject = new Language($languageItem['id'], $languageItem['name'], $languageItem['iso_code']);
        array_push($languagesArray, $languageObject);
    }
    $mysqli->close();

    return $languagesArray;
}

function storeLanguage($languageName, $isoCode)
{
    $mysqli = initConectionDB();

    $error = '';

    $upperIsoCode = strtoupper($isoCode);
    if (!$mysqli->query("INSERT INTO language (name, iso_code) VALUES('$languageName', '$upperIsoCode')")) {
        $error = error($mysqli);
    }
    $mysqli->close();
    return $error;
}

function updateLanguage($languageId, $languageName, $isoCode)
{
    $mysqli = initConectionDB();

    $error = '';

    $upperIsoCode = strtoupper($isoCode);
    if (!$mysqli->query("UPDATE language SET name = '$languageName', iso_code = '$upperIsoCode' WHERE id = $languageId")) {
        $error = error($mysqli);
    }
    $mysqli->close();
    return $error;
}

function deleteLanguage($languageId)
{
    $mysqli = initConectionDB();

    $error = '';
    if (!$mysqli->query("DELETE FROM language WHERE id = $languageId")) {
        $error = error($mysqli);
    }
    $mysqli->close();
    return $error;
}


function getLanguageData($idlanguage)
{
    $mysqli = initConectionDB();

    $languageList = $mysqli->query("SELECT * FROM language WHERE id = $idlanguage");
    $languageObject = null;

    foreach ($languageList as $languageItem) {
        $languageObject = new Language($languageItem['id'], $languageItem['name'], $languageItem['iso_code']);
    }
    $mysqli->close();

    return $languageObject;
}


?>
