<?php
include 'inc/functions.php';
include 'inc/connect.php';

$query = 'DELETE FROM cart';

foreach (cartItems() as $item => $qty) {
    $sku = $qty['sku'];
    $qty = $qty['in_cart'];
    updateStock('add', $qty, $sku);
}

if ($pdo->query($query)) {
    header('location:index.php');
}

