<?php
$pageTitle = "eCommerce Home";
$page = null;

include 'inc/header.php';
include 'inc/functions.php'; 

if (isset($_GET['error']) && $_GET['error'] == 'quantity_err') {
        echo "<h3 class='alert alert-warning'>";
        echo "Please Enter a Valid Quantity";
        echo "</h3>";
} elseif (isset($_GET['error']) && $_GET['error'] == 'stock_err') {
        echo "<h3 class='alert alert-warning'>";
        echo "Not enough of that item in stock at the moment";
        echo "</h3>";
} elseif (isset($_GET['error']) && $_GET['error'] == 'error') {
        echo "<h3 class='alert alert-warning'>";
        echo "Something went wrong! Please try again later!";
        echo "</h3>";
}
?>
<?php
include 'inventory.php';
?>



<?php include 'inc/footer.php'; ?>
