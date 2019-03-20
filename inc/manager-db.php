<?php
require_once 'connect-db.php';
//$pdo -> presta
//$pdo2 -> mojp


function getOrders() {
    global $pdo;
    return $pdo->query("SELECT * FROM ps_orders LIMIT 100")->fetchAll();
}

function getTest() {
    global $pdo2;
    return $pdo2->query("SELECT * FROM testmojp")->fetchAll();
}