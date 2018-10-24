<?php
$pageTitle = "Remove Item?";
$page = null;

// Process delete operation after confirmation
if (isset($_POST['sku']) && !empty($_POST['sku'])) {

    // include connect file
    require_once 'inc/connect.php';

    // Prepare a sql statement
    $sql = "DELETE FROM cart WHERE sku = :sku";

    if ($stmt = $pdo->prepare($sql)) {

        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":sku", $param_sku);

        // Set parameters
        $param_sku = trim($_POST['sku']);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Item successfully removed from cart
            header("location: cart.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later";
        }
    }

    // Close statement
    unset($stmt);

    // Close connection
    unset($pdo);
} else {

    // Check existence of sku parameter
    if (empty(trim($_GET['sku']))) {
        
        // URL doesn't contain sku parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<?php
include_once 'inc/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h3>Item # <?= $_GET['sku'] ?></h3>
            </div>
            <form action="" method="post">
                <div class="alert alert-danger fade in">
                    <input type="hidden" name="sku" value="<?= trim($_GET['sku']) ?>"/>
                    <p>Are you sure you want to remove this item from the cart?</p><br>
                    <p>
                        <input type="submit" value="Yes" class="btn btn-danger">
                        <a href="cart.php" class="btn btn-default">No</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
include_once 'inc/footer.php';
?>