<?php
require_once 'connect-db.php';
function selectInfoFromPresta() {
    global $presta;
    return $presta->query("SELECT `id_customer`,`id_address_delivery`,`id_order`,`reference`,`id_carrier`,`date_add`,`id_cart`,`total_paid`,`shipping_number`,`gift_message` FROM ps_orders LIMIT 100")->fetchAll();
}

function selectInfoFromPrestaById($idOrder) {
    global $presta;
    $result = $presta->prepare("SELECT * FROM ps_orders WHERE id_order = :idOrder");
    $result->bindValue(':idOrder', $idOrder);
    $result->execute();
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
    $result = $presta->prepare("SELECT reference, ps_carrier.name FROM ps_orders, ps_carrier WHERE ps_carrier.id_carrier = :id_carrier");
    $result->bindValue(":id_carrier", $idCarrier, PDO::PARAM_STR);
    $result->execute();
    return $result->fetch();
}

function selectNote($idOrder) {
    global $mojp;
    $result = $mojp->prepare("SELECT idOrder,Note,Actions FROM ldb_orders WHERE idOrder = :idOrder");
    $result->bindValue(":idOrder", $idOrder, PDO::PARAM_STR);
    $result->execute();
    return $result->fetch();
}

function quiPrendTout() {
    global $mojp;
    global $presta;

    $result = $presta->prepare("SELECT id_order,date_add FROM ps_orders ORDER BY id_order DESC LIMIT 0,1");
    $result->execute();
    $orders = $result->fetch();
    $toAddList = array();
    $nb = $orders->id_order;
    $ship = $orders->date_add;

    $verifTable = $mojp->prepare("SELECT * FROM ldb_orders");
    $verifTable->bindValue(":idOrder", $nb, PDO::PARAM_STR);
    $verifTable->execute();
    $countTable = $verifTable->rowCount();
    $counter = 0;
    $isAllTable = false;
    if ($countTable != 0) {
        while ($counter == 0 && $nb != 0) {
            $result = $mojp->prepare("SELECT * FROM ldb_orders WHERE idOrder = :idOrder");
            $result->bindValue(":idOrder", $nb, PDO::PARAM_STR);
            $result->execute();
            $counter = $result->rowCount();
            if ($counter == 0) {
                $toAddList[] = $nb;
            }
            $nb--;
        };

    }else {
        $AllOrders = $presta->prepare("SELECT id_order FROM ps_orders ORDER BY id_order");
        $AllOrders->execute();
        $AllOrderss = $AllOrders->fetchAll();
        foreach ($AllOrderss as $list => $key) {
            $toAddList[] = $key;
        }
        $isAllTable = true;
    }

    if ($toAddList != null) {
        if ($isAllTable == false) {
            krsort($toAddList);
        }

        foreach ($toAddList as $idOrd) {
            if ($isAllTable) {
                $selectInfoFromPresta = selectInfoFromPrestaById($idOrd->id_order);
                $id = $idOrd->id_order;
            }else {
                $selectInfoFromPresta = selectInfoFromPrestaById($idOrd);
                $id = $idOrd;
            }
            $tracking = $selectInfoFromPresta->shipping_number;

            $reference = $selectInfoFromPresta->reference;

            AjoutOrder($id, $ship, $tracking, $reference);
        }
    }
    return false;
}

function AjoutOrder($idOrder, $ship, $tracking, $reference) {
    global $mojp;
    $result = $mojp->prepare("INSERT INTO ldb_orders VALUES ('', :idOrder, :ship, :tracking, :ref, '', '')");
        $result->bindValue(":idOrder", $idOrder);
        $result->bindValue(":ship", $ship);
        $result->bindValue(":tracking", $tracking);
        $result->bindValue(":ref", $reference);
        $result->execute();
        return true;
}