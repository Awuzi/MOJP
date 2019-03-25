<?php
require_once 'header.php';
require_once 'inc/manager-db.php';
$getInfoOrders = selectInfoFromPresta();
$connexion = (connectToBDD($db['namePresta'], $db['userPresta'], $db['passPresta']) && connectToBDD($db['nameMOJP'], $db['userMOJP'], $db['passMOJP']) == true);
?>

<main role="main" class="flex-shrink-0 col-md-12">
    <div class="">
        <h1>MOJP SIO12</h1>
        <?php if ($connexion) { ?>
            <div class="alert alert-success m-auto col" style="text-align: center;">
                connexion au deux bases de donnée reussie !
            </div>
            <h4>Test de connexion à prestashopBdd</h4>
                <div class="mt-2 rounded" style="background: gainsboro;">
                    <table class="table">
                        <th>Email</th>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>derniere maj</th>
                        <?php foreach ($getInfoOrders as $element) {
                            $idCustomer = $element->id_customer;
                            $selectCustomer = selectCustomer($idCustomer);
                            $selectCustomerAdress = selectCustomerAdress($idCustomer);
                            ?>
                            <tr>
                                <td><?php echo $selectCustomer->email . "\n"; ?></td>
                                <td><?php echo $selectCustomer->firstname ." ". $selectCustomer->lastname . "\n"; ?></td>
                                <td><?php echo $selectCustomerAdress->address1 .", ".$selectCustomerAdress->city. "\n"; ?></td>
                                <td><?php echo $element->invoice_date . "\n"; ?></td>
                                <td><?php echo $element->id_order . "\n"; ?></td>
                                <td><?php echo $element->id_carrier . "\n"; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
        <?php } else { ?>
            <div class="alert alert-danger m-auto col-md-6" style="text-align: center;">
                connexion au deux bases de donnée impossible !
            </div>
        <?php } ?>
    </div>
</main>

<?php
require_once 'javascripts.php';
require_once 'footer.php';
?>
