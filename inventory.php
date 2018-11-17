<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header clearfix">
                <h2 class="pull-left">Inventory</h2>
            </div>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>In Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Include the connection file
                    require_once 'inc/connect.php';

                        // Attempt select query execution
                    $sql = "SELECT sku, title, description, unit_price, in_stock FROM inventory";
                    if ($results = $pdo->query($sql)) {
                        while ($row = $results->fetch()) {
                            echo "<tr>";
                            echo "<td>";
                            echo "<a href='details.php?sku=" . $row['sku'] . "'>";
                            echo $row['title'] . "</a></td>";
                            echo "<td>$" . $row['unit_price'] . "</td>";
                            echo "<td>" . $row['in_stock'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                            // unset results set
                        unset($results);
                    } else {
                        echo "ERROR: Something wrong with your SQL statement";
                    }

                    unset($pdo);
                    ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col--md-4 col-sm-12">
    <a href="cart.php">Go To Cart</a>
    </div>
</div>