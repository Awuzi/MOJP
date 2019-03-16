<?php
require_once 'header.php';
require_once 'inc/manager-db.php';
$getEmployee = getEmployee();
$getOrders = getOrders();
?>

<main role="main" class="flex-shrink-0 container">
    <div class="container">
        <h1>MOJP SIO12</h1>
        <?php if (connectToBDD($db['namePresta'], $db['userPresta'], $db['passPresta']) && connectToBDD($db['nameMOJP'], $db['userMOJP'], $db['passMOJP'])) { ?>
            <div class="alert alert-success m-auto col-md-6" style="text-align: center;">
                connexion au deux bases de donnée reussie !
            </div>
        <?php } ?>
        <h4>Test de connexion à prestashopBdd</h4>
        <div class="container mt-2" style="background: lightgrey;">
            <table class="table">
                <th>nom</th>
                <th>prenom</th>
                <?php foreach ($getEmployee as $item) { ?>
                    <tr>
                        <td><?php echo "$item->lastname" . "\n"; ?></td>
                        <td><?php echo "$item->firstname" . "\n"; ?></td>
                    </tr>
                <?php } ?>
            </table>
            <table class="table">
                <th>ref produit</th>
                <th>moyen de pay</th>
                <th>total commande</th>
                <th>derniere maj</th>
                <?php foreach ($getOrders as $element) { ?>
                    <tr>
                        <td><?php echo $element->reference . "\n"; ?></td>
                        <td><?php echo $element->payment . "\n"; ?></td>
                        <td><?php echo round($element->total_paid, 2) . " $" . "\n"; ?></td>
                        <td><?php echo $element->date_upd . "\n"; ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</main>

<?php
require_once 'javascripts.php';
require_once 'footer.php';
?>
