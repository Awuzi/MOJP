<?php
require_once 'header.php';
require_once 'inc/manager-db.php';
?>
<main role="main" class="flex-shrink-0 col-md-12">
    <div class="">
<main role="main" class="flex-shrink-0 container">
    <div class="container">
        <h1>MOJP SIO12</h1>
        <?php if ($connexion) { ?>
            <div class="alert alert-success m-auto col" style="text-align: center;">
                connexion au deux bases de donnée reussie !
            </div>
            <h4>Test de connexion à prestashopBdd</h4>
                <!--<div class="mt-2 rounded" style="background: gainsboro;">
                    <table class="table">
                        <th>Email</th>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>derniere maj</th>
                        <?php /*foreach ($getInfoOrders as $element) {
                            $idCustomer = $element->id_customer;
                            $selectCustomer = selectCustomer($idCustomer);
                            $selectCustomerAdress = selectCustomerAdress($idCustomer);
                            */?>
                            <tr>
                                <td><?php /*echo $selectCustomer->email . "\n"; */?></td>
                                <td><?php /*echo $selectCustomer->firstname ." ". $selectCustomer->lastname . "\n"; */?></td>
                                <td><?php /*echo $selectCustomerAdress->address1 .", ".$selectCustomerAdress->city. "\n"; */?></td>
                                <td><?php /*echo $element->invoice_date . "\n"; */?></td>
                                <td><?php /*echo $element->id_order . "\n"; */?></td>
                                <td><?php /*echo $element->id_carrier . "\n"; */?></td>
                <div class="container mt-2 rounded">-->
                    <table class="table" id="table">
                        <thead class="thead-dark" style="text-align: center; border: 1px solid #32383e;">
                        <th scope="col">ref produit</th>
                        <th scope="col">gift message</th>
                        <th scope="col">total commande</th>
                        <th scope="col">derniere maj</th>
                        </thead>
                        <tbody style="text-align: center;">
                        <?php foreach ($getInfoOrders as $element) { ?>
                            <tr>
                                <td><?php echo $element->reference . "\n"; ?></td>
                                <td><?php echo $element-> gift_message . "\n"; ?></td>
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
