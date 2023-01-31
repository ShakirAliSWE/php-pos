<?php
include_once __DIR__ . "/config.php";
include_once __DIR__ . "/common.php";
include_once __DIR__ . "/../classes/database.php";
include_once __DIR__ . "/../classes/formFields.php";
$objDatabase = new database(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
$objFormFields = new formFields();

session_start();
