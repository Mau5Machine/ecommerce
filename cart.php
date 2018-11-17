<?php
$pageTitle = "Shopping Cart";
$page = null;
$errorMessage = '';
include 'inc/functions.php';

// prepare a sql statement
$sql = "SELECT inventory.sku, inventory.title, inventory.unit_price, cart.in_cart
FROM
cart
LEFT JOIN inventory ON (
cart.sku = inventory.sku)";
?>



<?php
include 'inc/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header clearfix">
                <h2 class="pull-left">Your Cart</h2>
            </div>
            
            <?php
                if (isset($_GET['action']) && $_GET['action'] == 'updated') {
                    echo "<h3 class='alert alert-warning animated 1 fadeOutUp delay-3s' id='action'>";
                    echo "Updated Quantity";
                    echo "</h3>";
                } elseif (isset($_GET['action']) && $_GET['action'] == 'added') {
                    echo "<h3 class='alert alert-success animated 1 fadeOutUp delay-3s' id='action'>";
                    echo "Added Item To Your Cart!";
                    echo "</h3>";
                } elseif (isset($_GET['action']) && $_GET['action'] == 'deleted') {
                    echo "<h3 class='alert alert-danger animated 1 fadeOutUp delay-3s' id='action'>";
                    echo "Item Was Removed From Cart!";
                    echo "</h3>";
                }
                
                ?>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Include the connection file
                    require_once 'inc/connect.php';

                        // Attempt select query execution
                    if ($results = $pdo->query($sql)) {
                        if ($results->rowCount() <= 0) {
                            echo "<h3 class='alert alert-danger animated 1 fadeOutUp delay-3s'>";
                            echo "This shopping cart is empty!";
                            echo "</h3>";
                        } else {
                            while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . $row['title'] . "</td>";
                                echo "<td>$" . $row['unit_price'] . "</td>";
                                echo "<td>" . $row['in_cart'] . "</td>";
                                echo "<td>";
                                echo "<a href='details.php?sku=" . $row['sku'] . "' title='View Details' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                echo "<a href='delete.php?sku=" . $row['sku'] . "&qty=" . $row['in_cart'] . "' title='Delete Item' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } ?>

                </tbody>
            </table>
            <?php
                            // unset results set
            unset($results);
                    } else {
                        echo "ERROR: Something wrong with your SQL statement";
                    }

        unset($pdo);
        ?>
        </div>
    </div>
    <a href="index.php" class="btn btn-primary">Back To Shopping</a>
    <a href="clearcart.php" class="btn btn-danger">Clear Cart</a>
</div>

<?php
include 'inc/footer.php';
?>