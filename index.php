<?php
require_once 'header.php';
require_once 'inc/manager-db.php';
if (isset($_POST['editNote'])) UpdateNote($_POST['editID'], $_POST['note']);
?>
<main role="main" class="flex-shrink-0 col-md-12">
    <main role="main" class="flex-shrink-0 ">
        <div>
            <h1>MOJP SIO12</h1>
            <?php if ($connexion) { ?>
                <div class="mt-4">
                    <table class="table border" id="table">
                        <thead class="thead <?php echo $themeMode; ?>" style="text-align: center; background : royalblue; color: white;">
                            <th scope="col">Id</th>
                            <th scope="col">Email</th>
                            <th scope="col">Name</th>
                            <th scope="col">Adress</th>
                            <th scope="col">Reference</th>
                            <th scope="col">Date</th>
                            <th scope="col">Total</th>
                            <th scope="col">Carrier</th>
                            <th scope="col">Items</th>
                            <th scope="col">Note</th>
                            <th scope="col">Action</th>
                        </thead>
                        <tbody style="text-align: center;">
                        <?php foreach ($getInfoOrders as $element) {
                            $idCustomer = $element->id_customer;
                            $idOrder = $element->id_order;
                            $idCarrier = $element->id_carrier;
                            $date = $element->date_add;

                            $note = selectNote($idOrder);
                            $selectCustomer = selectCustomer($idCustomer);
                            $selectCustomerAdress = selectCustomerAdress($idCustomer);
                            $selectOrderItem = selectOrderItem($idOrder, $element->reference);
                            $selectCarrier = selectCarrier($idCarrier);
                            $email = $selectCustomer->email;

                            if (endsWith($email, "marketplace.amazon.co.uk")) $email = "AZ"; ?>
                            <tr class="<?php echo $themeMode; ?>">
                                <td><?php echo $idOrder; ?></td>
                                <td><?php echo $email . "\n"; ?></td>
                                <td><?php echo $selectCustomer->firstname . " " . $selectCustomer->lastname . "\n"; ?></td>
                                <td><?php echo $selectCustomerAdress->address1 . ", " . $selectCustomerAdress->city . "\n"; ?></td>
                                <td><?php echo $element->reference; ?></td>
                                <td><?php echo $date; ?></td>
                                <td><?php echo round($element->total_paid, 1) . " $" . "\n"; ?></td>
                                <td><?php echo $selectCarrier->name; ?></td>
                                <td><?php
                                    foreach ($selectOrderItem as $item) {
                                        echo $item->product_quantity . "x " . $item->product_name . " (" . $item->product_reference . ")<br>";
                                    }
                                    ?>
                                </td>
                                <style>

                                    #act {
                                        background-color: ;
                                    }
                                </style>
                                <td>
                                    <a href="?OrderId=<?php echo $element->id_order; ?>">
                                        <button type="button" class="btn <?php echo $outline;?>">
                                            <?php if ($note != null) { ?>
                                                <i class="fas fa-pen"></i>
                                            <?php } else { ?>
                                                <i class="fas fa-plus-square"></i>
                                            <?php } ?>
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <label for="act"></label>
                                    <select class="form-control form-control-sm" id="act">
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
                <?php if (isset($_GET['OrderId'])) include('inc/modal.php'); ?>
            <?php } else { ?>
                <div class="alert alert-danger m-auto col-md-6" style="text-align: center;">
                    connexion au deux bases de donnée impossible !
                </div>
            <?php } ?>
        </div>
    </main>
</main>
<?php require_once 'footer.php'; ?>
