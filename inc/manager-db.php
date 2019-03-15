<?php
require_once 'connect-db.php';

function getEmployee() {
    global $pdo;
    return $pdo->query("SELECT * FROM ps_employee")->fetchAll();
}

function getOrders(){
    global $pdo;
    return $pdo->query("SELECT * FROM ps_orders LIMIT 100")->fetchAll();
}
