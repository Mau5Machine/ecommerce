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
        $sku = $_GET['sku'];
        $stmt->bindParam(":sku", $sku);

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
    header("location: index.php?error=error");
    exit();
}
?>

<?php
include_once 'inc/header.php';
// use PHP expressions in the html to show the data
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h1>Item #
                    <?= $sku ?>
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
                    $
                    <?= $price ?>
                </p>
            </div>
            <div class="form-group">
            <input type="hidden" name="stock" id="stock" value="<?= $stock ?>">
                <label>In Stock</label>
                <p class="form-control-static">
                    <?= $stock ?>
                </p>
            </div>
            <form id="quantity-form" method="post" action="addtocart.php">

                <input type="hidden" name="sku" value="<?= $sku ?>" id="sku">
                

                <p>Quantity: <input type="number" name="quantity" id="quantity" value=1><br>

                <input type="submit" id="submit" class="btn btn-secondary mt-3" value="Add To Cart"></p>
            </form>
            <p>
                <a href="index.php" class="btn btn-primary">Keep Shopping</a>
                <a href="cart.php" class="btn btn-warning">View Cart</a>
            </p>
        </div>
    </div>
</div>
<script>
    var inStock = document.getElementById('stock');
    var qty = document.getElementById('quantity');
    var submit = document.getElementById('submit');
    var actionAlert = document.getElementById('action');

    if (inStock.value == 0) {
        submit.setAttribute('disabled', 'true');
        submit.value = 'Out of Stock';
        submit.style.backgroundColor = 'red';
        submit.style.color = 'black';
    }
     submit.addEventListener('click', function () {
        var quantity = parseInt(qty.value, 10);
        var stock = parseInt(inStock.value, 10);
        if (quantity <= 0) {
            event.preventDefault();
            alert("Please enter a quantity!");
        }
        if (quantity > stock) {
            event.preventDefault();
            alert('Not enough of this item in stock!');
        }
    });
</script>
<?php
include_once 'inc/footer.php';
?>