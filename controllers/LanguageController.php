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

    $languageCreated = false;

    $upperIsoCode = strtoupper($isoCode);
    if ($mysqli->query("INSERT INTO language (name, iso_code) VALUES('$languageName', '$upperIsoCode')")) {
        $languageCreated = true;
    }
    $mysqli->close();
    return $languageCreated;
}

function updateLanguage($languageId, $languageName, $isoCode)
{
    $mysqli = initConectionDB();

    $languageEdited = false;

    $upperIsoCode = strtoupper($isoCode);
    if ($mysqli->query("UPDATE language SET name = '$languageName', iso_code = '$upperIsoCode' WHERE id = $languageId")) {
        $languageEdited = true;
    }
    $mysqli->close();
    return $languageEdited;
}

function deleteLanguage($languageId)
{
    $mysqli = initConectionDB();

    $languageDeleted = false;
    if ($mysqli->query("DELETE FROM language WHERE id = $languageId")) {
        $languageDeleted = true;
    }
    $mysqli->close();
    return $languageDeleted;
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
