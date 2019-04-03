<?php
session_start();
require_once 'header.php';
require_once 'inc/manager-db.php';
$getInfoOrders = selectInfoFromPresta();
$connexion = (connectToBDD($db['namePresta'], $db['userPresta'], $db['passPresta']) && connectToBDD($db['nameMOJP'], $db['userMOJP'], $db['passMOJP']) == true);
if (!isset($_SESSION["connect"])) { header("location: login.php", true, 302); }
?>
<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>MOJP</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap-4.2.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/library/datatables.min.css">
    <script src="assets/library/jquery-3.1.1.js"></script>
    <script src="assets/library/tables.js"></script>
    <script src="assets/library/bootstrap.min.js"></script>
</head>
<body class="d-flex flex-column h-100">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top rounded-bottom" style="background: #0f6ab4;">
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
                </ul>
            </div>
        </nav>
    </header>
