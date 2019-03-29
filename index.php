<?php
require_once 'header.php';
require_once 'inc/manager-db.php';
quiPrendTout();
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
                            <th scope="col">id</th>
                            <th scope="col">Email</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Adressse</th>
                            <th scope="col">reference</th>
                            <th scope="col">date</th>
                            <th scope="col">total commande</th>
                            <th scope="col">Transporter</th>
                            <th scope="col">note</th>
                            <th scope="col">Action</th>
                            </thead>
                            <tbody style="text-align: center;">
                            <?php foreach ($getInfoOrders as $element) {
                                $idCustomer = $element->id_customer;
                                $idOrder = $element->id_order;
                                $idCarrier = $element->id_carrier;
                                $date = $element->date_add;
                                $selectCustomer = selectCustomer($idCustomer);
                                $selectCustomerAdress = selectCustomerAdress($idCustomer);
                                $selectOrderItem = selectOrderItem($idOrder, $element->reference);
                                $selectCarrier = selectCarrier($idCarrier);
                                ?>
                                <tr>
                                    <td><?php echo $idOrder;?></td>
                                    <td><?php echo $selectCustomer->email . "\n"; ?></td>
                                    <td><?php echo $selectCustomer->firstname . " " . $selectCustomer->lastname . "\n"; ?></td>
                                    <td><?php echo $selectCustomerAdress->address1 . ", " . $selectCustomerAdress->city . "\n"; ?></td>
                                    <td><?php
                                        foreach ($selectOrderItem as $item) {
                                            echo $item->product_quantity . "x " . $item->product_name . " (" . $item->reference . ")<br>";
                                        }
                                        ?></td>
                                    <td><?php echo $date; ?></td>
                                    <td><?php echo round($element->total_paid, 1) . " $" . "\n"; ?></td>
                                    <td><?php echo $selectCarrier->name;?></td>

                                    <td> <button class="btn btn-outline-primary"> <i class="fas fa-pen"></i></button> </td>
                                    <td>
                                        <select class="form-control form-control-sm">
                                            <option value="paiement" style="color: blue;">Paiement accepté</option>
                                            <option value="en_cours" style="color: sandybrown;">En cours de livraison</option>
                                            <option value="livree" style="color: green;">Livré</option>
                                        </select>
                                    </td>
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
