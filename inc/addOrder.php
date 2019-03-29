<?php
/**
 * Created by PhpStorm.
 * User: Diyar
 * Date: 29/03/2019
 * Time: 14:06
 */
require_once 'manager-db.php';

function addOrders() {
    global $presta;
    global $mojp;

    $result = $presta->prepare("SELECT `address1`, `city` FROM ps_address WHERE id_customer = :id_customer");
    $result->bindValue(':id_customer', $idCustomer, PDO::PARAM_STR);
    $result->execute();
    $result->fetch();
}