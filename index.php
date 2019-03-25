<?php
include "header.php";
?>
<main role="main" class="flex-shrink-0 container">
    <div class="container">
        <h1>MOJP SIO12</h1>
        <?php if ($connexion) { ?>
            <div class="alert alert-success m-auto col-md-6" style="text-align: center;">
                connexion au deux bases de donnée reussie !
            </div>
            <h4>Test de connexion à prestashopBdd</h4>
                <div class="container mt-2 rounded">
                    <table class="table" id="table">
                        <thead class="thead-dark" style="text-align: center; border: 1px solid #32383e;">
                        <th scope="col">ref produit</th>
                        <th scope="col">moyen de pay</th>
                        <th scope="col">total commande</th>
                        <th scope="col">derniere maj</th>
                        </thead>
                        <tbody style="text-align: center;">
                        <?php foreach ($getOrders as $element) { ?>
                            <tr>
                                <td><?php echo $element->reference . "\n"; ?></td>
                                <td><?php echo $element->payment . "\n"; ?></td>
                                <td><?php echo round($element->total_paid, 1) . " $" . "\n"; ?></td>
                                <td><?php echo $element->date_upd . "\n"; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            <h4>Test de connexion à mojp</h4>
                <div class="container mt-2 rounded">
                    <table class="table" id="table">
                        <thead class="thead-dark" style="text-align: center; border: 1px solid #32383e;">
                        <th scope="col">test</th>
                        <th scope="col">test</th>
                        </thead>
                        <tbody style="text-align: center;">
                        <?php foreach ($getTest as $element) { ?>
                            <tr>
                                <td><?php echo $element->test . "\n"; ?></td>
                                <td><?php echo $element->test1 . "\n"; ?></td>
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
