<?php
$pageTitle = "Shopping Cart";
$page = null;
$errorMessage = '';
$counter = $qty = 0;

// prepare a sql statement
$sql = "SELECT inventory.sku, inventory.title, inventory.unit_price, cart.in_cart
FROM
cart
LEFT JOIN inventory ON (
cart.sku = inventory.sku)
ORDER BY inventory.title DESC";
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
                            // Display a message if empty cart
                            echo "<h3 class='alert alert-danger'>";
                            echo "This shopping cart is empty!";
                            echo "</h3>";
                        } else {
                            // Loop through items in the cart to display
                            while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . $row['title'] . "</td>";
                                echo "<td>$";
                                echo $row['unit_price'] * $row['in_cart'] . "</td>";
                                echo "<td>" . $row['in_cart'] . "</td>";
                                echo "<td>";
                                echo "<a href='details.php?sku=" . $row['sku'] . "' title='View Details' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                echo "<a href='delete.php?sku=" . $row['sku'] . "' title='Delete Item' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                echo "</td>";
                                echo "</tr>";

                                // Counter for total
                                $counter += $row['unit_price'] * $row['in_cart'];
                                // Counter for quantity
                                $qty += $row['in_cart'];
                            } ?>
                    <tr>
                        <td class="bg-primary bg-dark text-right"><strong>Total</strong></td>
                        <td colspan="3" class="bg-primary bg-dark">
                        
                            <?php
                            // Print the counter variable for the grand total
                            echo "$ " . $counter;
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php

        } ?>


            <?php
            // unset results set
            unset($results);
        } else {
            echo "ERROR: Something wrong with your SQL statement";
        }
        
        // unset the connection
        unset($pdo);
        ?>
        </div>
    </div>
    <a href="index.php" class="btn btn-primary">Back To Shopping</a>
</div>


<?php
include 'inc/footer.php';
?>