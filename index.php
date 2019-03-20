<?php
require_once 'header.php';
require_once 'inc/manager-db.php';
$getOrders = getOrders();
$getTest = getTest();
$connexion = (connectToBDD($db['namePresta'], $db['userPresta'], $db['passPresta']) && connectToBDD($db['nameMOJP'], $db['userMOJP'], $db['passMOJP']) == true);
?>

<main role="main" class="flex-shrink-0 container">
    <div class="container">
        <h1>MOJP SIO12</h1>
        <?php if ($connexion) { ?>
            <div class="alert alert-success m-auto col-md-6" style="text-align: center;">
                connexion au deux bases de donnée reussie !
            </div>
            <h4>Test de connexion à prestashopBdd</h4>
                <div class="container mt-2 rounded" style="background: gainsboro;">
                    <table class="table">
                        <th>ref produit</th>
                        <th>moyen de pay</th>
                        <th>total commande</th>
                        <th>derniere maj</th>
                        <?php foreach ($getOrders as $element) { ?>
                            <tr>
                                <td><?php echo $element->reference . "\n"; ?></td>
                                <td><?php echo $element->payment . "\n"; ?></td>
                                <td><?php echo round($element->total_paid, 1) . " $" . "\n"; ?></td>
                                <td><?php echo $element->date_upd . "\n"; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            <h4>Test de connexion à mojp</h4>
                <div class="container mt-2 rounded" style="background: gainsboro;">
                    <table class="table ">
                        <th>test</th>
                        <th>test</th>
                        <?php foreach ($getTest as $element) { ?>
                            <tr>
                                <td><?php echo $element->test . "\n"; ?></td>
                                <td><?php echo $element->test1 . "\n"; ?></td>
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
