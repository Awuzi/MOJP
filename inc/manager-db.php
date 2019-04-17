<?php
require_once 'connect-db.php';

//Cette fonction récupère les données de la base de données de Prestashop et de les retourner dans un tableau associatif.
/**
 * @return array
 */
function selectInfoFromPresta() {
    global $presta;
    return $presta->query("SELECT * FROM ps_orders LIMIT 100")->fetchAll();
}

//On récupère toutes les informations en fonction de l'id fourni à la fonction .
function selectInfoFromPrestaById($idOrder) {
    global $presta;
    $result = $presta->prepare("SELECT * FROM ps_orders WHERE id_order = :idOrder");
    $result->bindValue(':idOrder', $idOrder);
    $result->execute();
    return $result->fetch();
}

//Sélectionne et renvoie les informations concernant un client.
/**
 * @param $idCustomer
 * @return array
 */
function selectCustomer($idCustomer) {
    global $presta;
    $result = $presta->prepare("SELECT `firstname`, `lastname`,`email` FROM ps_customer WHERE id_customer = :id_customer");
    $result->bindValue(':id_customer', $idCustomer, PDO::PARAM_STR);
    $result->execute();
    return $result->fetch();
}

//Récupère l'adresse d'un client.
/**
 * @param $idCustomer
 * @return array
 */
function selectCustomerAdress($idCustomer) {
    global $presta;
    $result = $presta->prepare("SELECT `address1`, `city` FROM ps_address WHERE id_customer = :id_customer");
    $result->bindValue(':id_customer', $idCustomer, PDO::PARAM_STR);
    $result->execute();
    return $result->fetch();
}


/**
 * @param $email
 * @param $endString
 * @return bool
 */
function endsWith($email, $endString) {
    $endString === '' ? TRUE : FALSE;
    $diff = strlen($email) - strlen($endString);
    return $diff >= 0 && strpos($email, $endString, $diff) !== FALSE;
}


//Récupérer les produits du panier d'un client.
/**
 * @param $idOrder
 * @param $reference
 * @return array
 */
function selectOrderItem($idOrder, $reference) {
    global $presta;
    $result = $presta->prepare("SELECT reference, product_name, product_quantity, product_reference FROM ps_orders, ps_order_detail WHERE ps_order_detail.id_order = :id_order AND ps_orders.reference = :reference;");
    $result->bindValue(':id_order', $idOrder, PDO::PARAM_STR);
    $result->bindValue(':reference', $reference, PDO::PARAM_STR);
    $result->execute();
    return $result->fetchAll();
}

//Récupère le transporteur attribué à une commande.
/**
 * @param $idCarrier
 * @return array
 */
function selectCarrier($idCarrier) {
    global $presta;
    $result = $presta->prepare("SELECT reference, ps_carrier.name FROM ps_orders, ps_carrier WHERE ps_carrier.id_carrier = :id_carrier");
    $result->bindValue(":id_carrier", $idCarrier, PDO::PARAM_STR);
    $result->execute();
    return $result->fetch();
}

//Sélectionne la note en fonction de l'id.
/**
 * @param $idOrder
 * @return int|0
 */
function selectNote($idOrder) {
    global $mojp;
    $result = $mojp->prepare("SELECT idOrderPresta, Note, Actions 
                            FROM ldb_orders WHERE idOrderPresta = :idOrder");
    $result->bindValue(":idOrder", $idOrder, PDO::PARAM_STR);
    $result->execute();
    $resultat = $result->fetch();
    return $result != null ? $resultat : 0;
}

//Permet d'ajouter une commande récupérée depuis la base de données de Prestashop.
/**
 * @param $idOrder
 * @param $dateOrder
 * @param $tracking
 * @param $reference
 * @param $note
 * @return bool
 */
function AjoutOrder($idOrder, $dateOrder, $tracking, $reference, $note) {
    global $mojp;
    $result = $mojp->prepare("INSERT INTO ldb_orders VALUES ('', :idOrderPresta, :dateOrder, :tracking, :ref, :note, '')");
    $result->bindValue(":idOrderPresta", $idOrder);
    $result->bindValue(":dateOrder", $dateOrder);
    $result->bindValue(":tracking", $tracking);
    $result->bindValue(":ref", $reference);
    $result->bindValue(":note", $note);
    $result->execute();
    return true;
}

//On édite la note.
/**
 * @param $idOrder
 * @param $note
 */
function UpdateNote($idOrder, $note) {
    global $mojp;
    $verifOrderExist = $mojp->prepare("SELECT COUNT(*) as commandExist FROM ldb_orders WHERE idOrderPresta = :idOrderPresta");
    $verifOrderExist->bindValue(":idOrderPresta", $idOrder, PDO::PARAM_INT);
    $verifOrderExist->execute();
    $countOrderExists = $verifOrderExist->fetch();

    if ($countOrderExists->commandExist != 0) {
        if ($note != null) {
            $result = $mojp->prepare("UPDATE ldb_orders SET Note = :note WHERE idOrderPresta = :idOrderPresta");
            $result->bindValue(":note", $note, PDO::PARAM_STR);
        } else {
            $result = $mojp->prepare("DELETE FROM ldb_orders WHERE idOrderPresta = :idOrderPresta");
        }
        $result->bindValue(":idOrderPresta", $idOrder, PDO::PARAM_INT);
        $result->execute();
    } else {
        $prestaOrder = selectInfoFromPrestaById($idOrder);
        print_r($prestaOrder);
        $dateOrder = $prestaOrder->date_add;
        $tracking = $prestaOrder->shipping_number;
        $reference = $prestaOrder->reference;
        AjoutOrder($idOrder, $dateOrder, $tracking, $reference, $note);
    }
    header("location: index.php", true, 302);
}