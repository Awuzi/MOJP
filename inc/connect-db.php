<?php
/*$config = file_get_contents("inc/databaseConfig.csv");
$conf = explode(";", $config, strlen($config));
$name = $conf[0];
$log = $conf[1];
$pass = $conf[2];*/

$config_db = parse_ini_file("config.ini");
//parse_ini_file, recupere les infos d'un fichier .ini -> qui les met dans un tableau assoc

ini_set('display_errors', 1);
define('DB_NAME', $config_db['name']);
define('DB_DSN', 'mysql:host=localhost;dbname=' . $config_db['name'] . ';charset=utf8');
define('DB_USER', $config_db['user']);
define('DB_PASSWORD', $config_db['pass']);
define('DEBUG', false);

$dbError = '';

function connect() {
    $opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_EMULATE_PREPARES => false];
    try {
        return new PDO(DB_DSN, DB_USER, DB_PASSWORD, $opt);
    } catch (PDOException $e) {
        $dbError = 'Connexion à la base de donnée impossible !';
        if (DEBUG) {
            $dbError .= "<br/>" . $e->getMessage();
        }
    }
    return false;
}

$pdo = connect();

if ($dbError) {
    die('<div class="ui red inverted segment"> <p>'
        . $dbError
        . '</p></div></body></html>');
}
