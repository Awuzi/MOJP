<?php
// Sécurisation du site
header("Content-Security-Policy: default-src 'none'; style-src 'self' 'unsafe-inline' https://use.fontawesome.com/; frame-src 'self' https://www.google.com/; frame-ancestors 'self'; font-src 'self' https://use.fontawesome.com/; img-src 'self'; object-src 'none'; script-src 'self' 'sha256-/ZnxtfuNEMTjflL4lc92o/C7MitnIqHQZko8BtiwXG8='; base-uri 'self'; form-action 'self';");
header("X-XSS-Protection: 1; mode=block");
header("X-Frame-Options: SAMEORIGIN");
header("X-Content-Type-Options: nosniff");
header("Strict-Transport-Security: max-age=63072000");
header('Access-Control-Allow-Origin: *');
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
session_start();
//file_exists('install.php') ? header('location:install.php',true, 302) :null; //TODO décommenter à la fin du projet !!!!!!
require_once 'inc/manager-db.php';
$getInfoOrders = selectInfoFromPresta();
$connexion = ($presta && $mojp == true);
if (!isset($_SESSION["connect"])) {
    header("location: login.php", true, 302);
}
if (isset($_GET['light'])) {
    $_COOKIE['light'] = $_GET['light'];
    if ($_COOKIE['light'] == 'off') {
        $themeMode = "bg-dark";
    } else {
        $themeMode = "";
    }
}
?>
<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>MOJP</title>
    <link href="assets/bootstrap-4.2.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/library/datatables.min.css">
    <script src="assets/library/jquery-3.1.1.js"></script>
    <script src="assets/library/tables.js"></script>
    <script src="assets/library/bootstrap.min.js"></script>
</head>
<body class="d-flex flex-column h-100">
<header>
    <nav class="navbar navbar-expand-md navbar-dark <?php echo $themeMode; ?> fixed-top rounded-bottom" style="background: #0f6ab4;">
        <a class="navbar-brand" href="index.php">MOJP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php?logout">Logout</a>
                </li>
                <li class="nav-item">
                    <?php if (isset($_COOKIE['light']) && ($_COOKIE['light'] == "on")) { ?>
                        <a class="nav-link" href="?light=off"><i class="fas fa-moon" style="color: gray;"></i></a>
                    <?php } elseif (isset($_COOKIE['light']) && ($_COOKIE['light'] == "off")) { ?>
                        <a class="nav-link" href="?light=on"><i class="fas fa-sun" style="color: yellow;"></i></a>
                    <?php } else setcookie("light", "on"); ?>
                </li>
            </ul>
        </div>
    </nav>
</header>