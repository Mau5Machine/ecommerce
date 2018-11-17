<?php
$pageTitle = "Shopping Cart";
$page = null;
$errorMessage = '';
include 'inc/functions.php';
require_once 'inc/connect.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Validate the input
    if (isset($_POST['sku']) && !empty($_POST['sku'])) {
        $sku = $_POST['sku'];
    } else {
        header('location:index.php?error=error');
    }
    // Validate the input
    if (isset($_POST['quantity']) && !empty($_POST['quantity']) && $_POST['quantity'] > 0) {
        $quantity = $_POST['quantity'];
    } else {
        header('location:index.php?error=error');
    }
    // Check the stock of the item
    $in_stock = inStock($sku);
    // Update the stock of the item
    if ($in_stock) {
        if ($quantity < $in_stock) {
            updateStock('subtract', $quantity, $sku);
            header('location:cart.php?action=updated');
        }
    } else {
        header('location:index.php?error=error');
    }
    // if item is already in cart, update cart
    $item_exists = updateCart($sku, $quantity);
    if ($item_exists == false) {
        // if item is not in cart, add it to cart
        if (addToCart($sku, $quantity)) {
            header('location:cart.php?action=added');
        } else {
            header('location:index.php?error=error');
        }
    }
} else {
    echo "Nothing here!";
}
