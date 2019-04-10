<?php

function connectToBDD($dbname, $dbuser, $dbpass, $srvName) {
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_EMULATE_PREPARES => false];
    try {
        return new PDO('mysql:host=' . $srvName . ';dbname=' . $dbname . ';charset=utf8', $dbuser, $dbpass, $options);
    } catch (PDOException $e) {
        echo 'Connexion à la base de donnée impossible !';
    }
    return null;
}

$db = parse_ini_file("./inc/config.ini");
//parse_ini_file, recupere les infos d'un fichier .ini -> qui les met dans un tableau assoc
//on exploite directement les infos de ce tableau assoc //$db['name']// sans passer par les define,
$presta = connectToBDD($db['namePresta'], $db['userPresta'], $db['passPresta'], $db['serverName']); //connexion à presta
$mojp = connectToBDD($db['nameMOJP'], $db['userMOJP'], $db['passMOJP'], $db['serverName']); //connexion à mojp