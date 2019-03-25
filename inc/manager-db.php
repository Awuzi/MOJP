<?php
require_once 'connect-db.php';
function selectInfoFromPresta() {
    global $presta;
    return $presta->query("SELECT `id_customer`,`id_address_delivery`,`id_order`,`reference`,`id_carrier`,`invoice_date`,`id_cart`,`total_paid`,`shipping_number`,`gift_message` FROM ps_orders LIMIT 100")->fetchAll();
}

function selectCustomer($idCustomer) {
    global $presta;
    $result = $presta->prepare("SELECT `firstname`, `lastname`,`email` FROM ps_customer WHERE id_customer = :id_customer");
    $result->bindValue(':id_customer', $idCustomer, PDO::PARAM_STR);
    $result->execute();
    return $result->fetch();
}

function selectCustomerAdress($idCustomer) {
    global $presta;
    $result = $presta->prepare("SELECT `address1`, `city` FROM ps_address WHERE id_customer = :id_customer");
    $result->bindValue(':id_customer', $idCustomer, PDO::PARAM_STR);
    $result->execute();
    return $result->fetch();
}

function endsWith($haystack, $needle) {
    $needle === '' ? TRUE : FALSE ;
    $diff = strlen($haystack) - strlen($needle);
    return $diff >= 0 && strpos($haystack, $needle, $diff) !== FALSE;
}


// TODO: trouver la jointure pour selectionne les elements du panier du client
function selectCustomerItem($idCustomer) {
    global $presta;
    $result = $presta->prepare("SELECT ``,``,`` FROM ps_product WHERE id_customer = :");
}










/*
$selectInfoFromPresta = selectInfoFromPresta(); // à mettre dans l'index

function insertInfoInMOJP($selectInfoFromPresta) {
    global $mojp;
    $result = $mojp->prepare("INSERT INTO ldb_orders VALUES ('',':Mail',':Name',':Adress',':D/O',':D/S',':Item',':Ship',':RR_JP',':Order',':Note',':Action');");
    foreach ($selectInfoFromPresta as $value) {
        $result->bindValue(":Mail", $value->Mail);
        $result->bindValue(":Mail", $value->Adress);
        $result->bindValue(":Mail", $value->D0);
        $result->bindValue(":Mail", $value->Mail);
        $result->bindValue(":Mail", $value->Mail);
        $result->bindValue(":Mail", $value->Mail);
        $result->bindValue(":Mail", $value->Mail);
        $result->bindValue(":Mail", $value->Mail);
             }
}*/