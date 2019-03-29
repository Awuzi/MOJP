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
    $needle === '' ? TRUE : FALSE;
    $diff = strlen($haystack) - strlen($needle);
    return $diff >= 0 && strpos($haystack, $needle, $diff) !== FALSE;
}


// TODO: trouver la jointure pour selectionne les elements du panier du client
function selectOrderItem($idOrder) {
    global $presta;
    $result = $presta->prepare("SELECT reference, product_name, product_quantity FROM ps_orders, ps_order_detail WHERE ps_order_detail.id_order = :id_order;");
    $result->bindValue(':id_order', $idOrder, PDO::PARAM_STR);
    $result->execute();
    return $result->fetchAll();
}

function selectCarrier($idCarrier){
    global $presta;
    $result = $presta->prepare("SELECT reference, ps_carrier.name FROM ps_orders, ps_carrier WHERE ps_carrier.id_carrier = :id_carrier;");
    $result->bindValue(":id_carrier", $idCarrier, PDO::PARAM_STR);
    $result->execute();
    return $result->fetch();
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