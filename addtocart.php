<?php
$pageTitle = "Shopping Cart";
$page = null;
$errorMessage = '';

// Define variables and initialize with empty values
$quantity = $sku = "";
$quantity_err = $sku_err = "";

// Processing form data when form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Validate sku
    $input_sku = trim($_POST['sku']);
    if (empty($input_sku)) {
        $sku_err = "No sku provided";
        header('location: error.php');
        exit;
    } else {
        $sku = $input_sku;
    }

    // Validate quantity
    $input_quantity = trim($_POST['quantity']);
    if (empty($input_quantity)) {
        $quantity_err = "Please enter a quantity";
        header('location: error.php');
        exit;
    } else {
        $quantity = $input_quantity;
    }

    // Check input errors before inserting in database
    if (empty($sku_err) && empty($quantity_err)) {

        // Include connect file
        require_once 'inc/connect.php';

         // Prepare an insert statement
        $sql = "INSERT INTO cart (sku, in_cart) VALUES (:sku, :in_cart)
        ON DUPLICATE KEY UPDATE
        in_cart = in_cart + :in_cart";

        if ($stmt = $pdo->prepare($sql)) {

            // Bind variables to the preapred statement as parameters
            $stmt->bindParam(":sku", $sku, PDO::PARAM_STR);
            $stmt->bindParam(":in_cart", $quantity, PDO::PARAM_INT);

            // Attempt to execute prepared statement
            if ($stmt->execute()) {
                // Item added to cart
                header('location: cart.php');
                exit;
            } else {
                echo 'Something went wrong. Please try again later';
            }

            // close statement
            unset($stmt);
        }
        // Close connection
        unset($pdo);

    }
}
