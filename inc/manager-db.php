<?php
require_once 'connect-db.php';
function selectInfoFromPresta() {
    global $presta;
    return $presta->query("SELECT `id_customer`,`id_address_delivery`,`id_order`,`reference`,`id_carrier`,`date_add`,`id_cart`,`total_paid`,`shipping_number`,`gift_message` FROM ps_orders LIMIT 100")->fetchAll();
}

function selectInfoFromPrestaById($idOrder) {
    global $presta;
    $result = $presta->query("SELECT `id_customer`,`id_address_delivery`,`id_order`,`reference`,`id_carrier`,`date_add`,`id_cart`,`total_paid`,`shipping_number`,`gift_message` FROM ps_orders WHERE id_order = :idOrder")->fetchAll();
    $result->bindValue(':idOrder', $idOrder, PDO::PARAM_STR);
    return $result->fetch();
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
function selectOrderItem($idOrder, $reference) {
    global $presta;
    $result = $presta->prepare("SELECT reference, product_name, product_quantity FROM ps_orders, ps_order_detail WHERE ps_order_detail.id_order = :id_order AND ps_orders.reference = :reference;");
    $result->bindValue(':id_order', $idOrder, PDO::PARAM_STR);
    $result->bindValue(':reference', $reference, PDO::PARAM_STR);
    $result->execute();
    return $result->fetchAll();
}

function selectCarrier($idCarrier) {
    global $presta;
    $result = $presta->prepare("SELECT reference, ps_carrier.name FROM ps_orders, ps_carrier WHERE ps_carrier.id_carrier = :id_carrier;");
    $result->bindValue(":id_carrier", $idCarrier, PDO::PARAM_STR);
    $result->execute();
    return $result->fetch();
}

function quiPrendTout($idOrder) {
    global $mojp;

    $result = $mojp->prepare("SELECT * FROM ldb_orders WHERE idOrder = :idOrder");
    $result->bindValue(":idOrder", 1, PDO::PARAM_STR);
    $result->execute();
    if ($result->rowCount() == 0) {
        $selectInfoFromPresta = selectInfoFromPrestaById($idOrder);

        $date = $selectInfoFromPresta->date_add;
        $shipping = $selectInfoFromPresta->shipping_number;

        $idCustomer = $selectInfoFromPresta->id_customer;
        $selectCustomer = selectCustomer($idCustomer);

        $email = $selectCustomer->email;
        $prenom = $selectCustomer->firstname;
        $nom = $selectCustomer->lastname;

        $selectCustomerAdress = selectCustomerAdress($idCustomer);

        $adresse1 = $selectCustomerAdress->address1;
        $city = $selectCustomerAdress->city;
        $reference = $selectInfoFromPresta->reference;

        $selectOrderItem = selectOrderItem($idOrder, $reference);

        $items = array();

        foreach ($selectOrderItem as $item) {
            array_push($items, $item->product_quantity . "x " . $item->product_name . " (" . $item->reference . ")<br>");
        }
        $idCarrier = $selectInfoFromPresta->id_carrier;

        $selectCarrier = selectCarrier($idCarrier);
        $carrier = $selectCarrier->name;
        AjoutOrder($idOrder, $email, $nom . " " . $prenom, $adresse1 . " " . $city, $date, $items, $carrier, $shipping, $reference);

        return true;
    }
    return false;
}

function AjoutOrder($idOrder, $email, $name, $adress, $date, $items, $carrier, $shipping, $reference) {
    global $mojp;

    $result = $mojp->prepare("INSERT INTO ldb_orders VALUES ('', ':idOrder', ':Mail',':Name',':Adress',':date',':DS',':Item',':carrier',':shipping',':ref','','');");
        $result->bindValue(":idOrder", $idOrder);
        $result->bindValue(":Mail", $email);
        $result->bindValue(":Name", $name);
        $result->bindValue(":Adress", $adress);
        $result->bindValue(":date", $date);
        $result->bindValue(":Item", $items);
        $result->bindValue(":carrier", $carrier);
        $result->bindValue(":shipping", $shipping);
        $result->bindValue(":ref", $reference);
        return true;
}