<?php
require_once "inc/connect-db.php";

$dbuser = $db['userMOJP'];
$dbpass = $db['passMOJP'];
$srvName = $db['serverName'];
$fileInstall = 'install.php';
if ($presta && $mojp) {
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_EMULATE_PREPARES => false];
    try {
        $initializeDB = new PDO("mysql:host=$srvName", $dbuser, $dbpass, $options);
        $initializeDB->exec("CREATE DATABASE IF NOT EXISTS projet_mojp;");
        $initializeDB->exec("USE projet_mojp;");
        $initializeDB->exec(file_get_contents("./inc/createDatabase.sql"));
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    unlink($fileInstall);
    header('location:index.php', true, 302);
} else {
    echo "connexion a la base impossible ! ";
}
