<?php
require_once 'header.php';
require_once 'inc/manager-db.php';
?>
<main role="main" class="flex-shrink-0 col-md-12">
    <div class="">
        <main role="main" class="flex-shrink-0 ">
            <div class="">
                <h1>MOJP SIO12</h1>
                <?php if ($connexion) { ?>
                    <span class="alert alert-success">connexion au deux bases de donnée reussie !</span>
                    <div class=" mt-4 rounded">
                        <table class="table border" id="table">
                            <thead class="thead" style="text-align: center; background : royalblue; color: white;">
                            <th scope="col">Email</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Adressse</th>
                            <th scope="col">ref produit</th>
                            <th scope="col">id order</th>
                            <th scope="col">total commande</th>
                            <th scope="col">derniere maj</th>
                            </thead>
                            <tbody style="text-align: center;">
                            <?php foreach ($getInfoOrders as $element) {
                                $idCustomer = $element->id_customer;
                                $selectCustomer = selectCustomer($idCustomer);
                                $selectCustomerAdress = selectCustomerAdress($idCustomer);
                                ?>
                                <tr>
                                    <td><?php echo $selectCustomer->email . "\n"; ?></td>
                                    <td><?php echo $selectCustomer->firstname . " " . $selectCustomer->lastname . "\n"; ?></td>
                                    <td><?php echo $selectCustomerAdress->address1 . ", " . $selectCustomerAdress->city . "\n"; ?></td>
                                    <td><?php echo $element->reference . "\n"; ?></td>
                                    <td><?php echo $element->id_order . "\n"; ?></td>
                                    <td><?php echo round($element->total_paid, 1) . " $" . "\n"; ?></td>
                                    <td><?php echo $element->invoice_date . "\n"; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-danger m-auto col-md-6" style="text-align: center;">
                        connexion au deux bases de donnée impossible !
                    </div>
                <?php } ?>
            </div>
        </main>
<?php require_once 'footer.php'; ?>
