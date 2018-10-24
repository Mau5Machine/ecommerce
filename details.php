<?php
$pageTitle = "Item Details";
$page = null;

// Check if the URL has the sku in the $_GET
if (isset($_GET['sku']) && !empty(trim($_GET['sku']))) {
    
    // include the connect file
    require_once 'inc/connect.php';

    // Prepare the select statement
    $sql = "SELECT * FROM inventory WHERE sku = :sku";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind values to the prepared statement as parameters
        $stmt->bindParam(":sku", $param_sku);

        // Set parameters
        $param_sku = $_GET['sku'];

        // Attempt to execute the statement
        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                // Fetch the result as an associative array
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Retrieve field values
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['unit_price'];
                $stock = $row['in_stock'];
            } else {
                // URL doesn't contain valid parameter, redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    unset($stmt);

    // Close connection
    unset($pdo);
} else {
    // URL contain parameter, redirect to error page
    header("location: error.php");
    exit();
}
?>

<?php
include_once 'inc/header.php';
// use PHP expressions in the html to show the data
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 details-box">

            <div class="page-header">
                <h1>Item #
                    <?= $param_sku ?>
                </h1>
            </div>

            <div class="form-group">
                <label>Title</label>
                <p class="form-control-static">
                    <?= $title ?>
                </p>
            </div>

            <div class="form-group">
                <label>Description</label>
                <p class="form-control-static">
                    <?= $description ?>
                </p>
            </div>

            <div class="form-group">
                <label>Price</label>
                <p class="form-control-static">
                    $ <?= $price ?>
                </p>
            </div>

            <div class="form-group">
                <label>In Stock</label>
                <p class="form-control-static">
                    <?= $stock ?>
                </p>
            </div>

            <form action="addtocart.php" method="post" id="quantity-form">

                <input type="hidden" name="sku" value="<?= $param_sku ?>">

                <!-- TODO: LIMIT THE INPUT TO THE AMOUNT IN STOCK -->
                <p>Quantity: <input type="number" name="quantity" id="quantity" value=1><br>

                    <input type="submit" class="btn btn-secondary mt-3" value="Add To Cart"></p>
            </form>
            <p><a href="index.php" class="btn btn-primary">Back</a></p>
        </div>
        
    </div>
</div>

<?php
include_once 'inc/footer.php';
?>