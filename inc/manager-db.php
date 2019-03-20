<?php
require_once 'connect-db.php';
//$pdo -> presta
//$pdo2 -> mojp


function getOrders() {
    global $presta;
    return $presta->query("SELECT * FROM ps_orders LIMIT 100")->fetchAll();
}

function getTest() {
    global $mojp;
    return $mojp->query("SELECT * FROM testmojp")->fetchAll();
}