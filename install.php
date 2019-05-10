<?php
require_once "inc/connect-db.php";

$dbuser = $db['userMOJP'];
$dbpass = $db['passMOJP'];
$dbName = $db['nameMOJP'];
$srvName = $db['serverName'];
$fileInstall = 'install.php';
if ($presta && $mojp) {
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_EMULATE_PREPARES => false];
    try {
        $initializeDB = new PDO("mysql:host=$srvName", $dbuser, $dbpass, $options);
        $initializeDB->exec("CREATE DATABASE IF NOT EXISTS $dbName;");
        $initializeDB->exec("USE $dbName;");
        $initializeDB->exec(file_get_contents("./inc/createDatabase.sql"));
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    unlink($fileInstall);
    header('location:index.php', true, 302);
} else {
    $db = parse_ini_file("./inc/config.ini");
    if (isset($_POST['save'])) {
        $iniConfig =
            "namePresta = ".$_POST['namePresta'].PHP_EOL.
            "userPresta = ".$_POST['userPresta'].PHP_EOL.
            "passPresta = ".$_POST['passPresta'].PHP_EOL.
            "nameMOJP = ".$_POST['nameMojp'].PHP_EOL.
            "userMOJP = ".$_POST['userMojp'].PHP_EOL.
            "passMOJP = ".$_POST['passMojp'].PHP_EOL.
            "InterfacePass = ".$_POST['InterfacePass'].PHP_EOL.
            "serverName = ".$_POST['host'];
        file_put_contents("./inc/config.ini",$iniConfig);
    }
}
$db = parse_ini_file("./inc/config.ini");
?>

<html lang="en">
<head>
    <title>Installation</title>
    <meta charset="utf8" />
</head>
<body style="width: 100%; padding: 0; margin: 0;">
<form method="POST" style="position: relative; margin-left: auto; margin-right: auto; width: 25%;">
    <table>
        <tr>
            <td style="text-align: center;" colspan="2"><b>Database PRESTASHOP</b></td>
        </tr>
        <tr>
            <td>Host</td>
            <td><input type="text" name="host" value="<?php echo $db['serverName']; ?>"/></td>
        </tr>
        <tr>
            <td>Database name</td>
            <td><input type="text" name="namePresta" value="<?php echo $db['namePresta']; ?>" /></td>
        </tr>
        <tr>
            <td>Username</td>
            <td><input type="text" name="userPresta" value="<?php echo $db['userPresta']; ?>" /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="text" name="passPresta" value="<?php echo $db['passPresta']; ?>"/></td>
        </tr>
        <tr>
            <td style="text-align: center;" colspan="2"><b>Database MOJP</b></td>
        </tr>
        <tr>
            <td>Database name</td>
            <td><input type="text" name="nameMojp" value="<?php echo $db['nameMOJP']; ?>"/></td>
        </tr>
        <tr>
            <td>Username</td>
            <td><input type="text" name="userMojp" value="<?php echo $db['userMOJP']; ?>"/></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="text" name="passMojp" value="<?php echo $db['passMOJP']; ?>"/></td>
        </tr>
        <tr>
            <td>Interface Pass</td>
            <td><input type="text" name="InterfacePass" value="<?php echo $db['InterfacePass']; ?>"/></td>
        </tr>
        <tr>
            <td style="text-align: center;" colspan="2"><br /><input type="submit" name="save" value="Save"/> </td>
        </tr>
    </table>
</form>
</body>
</html>
