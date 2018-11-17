<?php
// Function to echo objects in readable format
function echoPre($obj)
{
    echo "<pre>";
    print_r($obj);
    echo "</pre>";
}

function cartItems()
{
    include 'connect.php';

    $sql = 'SELECT `sku`, `in_cart` FROM `cart`';
    $results = $pdo->query($sql);
    return $results->fetchAll(PDO::FETCH_ASSOC);
}

function addToCart($sku, $in_cart)
{
    include 'connect.php';

    $sql = 'INSERT INTO `cart` (`sku`, `in_cart`) 
    VALUES ( :sku, :in_cart )';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':sku', $sku);
    $stmt->bindParam(':in_cart', $in_cart);
    if ($stmt->execute()) {
        return 'added item!';
    } else {
        return false;
    }
}
function updateCart($sku, $quantity)
{
    include 'connect.php';

    $sql = 'SELECT sku, in_cart FROM cart
    WHERE `sku` = :sku';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':sku', $sku);
    $stmt->execute();
    if ($stmt->rowCount() == 1) {
        $query = 'UPDATE `cart` 
        SET `in_cart` = `in_cart` + :quantity
        WHERE `sku` = :sku';
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':sku', $sku);
        $stmt->execute();
        return true;
    } else {
        return false;
    }
}

// If exists
function inStock($sku)
{
    include 'connect.php';

    $sql = 'SELECT `in_stock` FROM `inventory`
    WHERE `sku` = :sku';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':sku', $sku);
    if ($stmt->execute()) {
        $row = $stmt->fetch(PDO::FETCH_NUM);
        return $row[0];
    } else {
        return false;
    }
}

// Update quantity of in stock when in cart
function updateStock($math, $quantity, $sku)
{
    include 'connect.php';

    $sql = 'UPDATE `inventory` 
    SET `in_stock` =';

    $where = ' ';
    switch ($math) {
        case 'add':
            $where = ' `in_stock` + :qty WHERE `inventory` . `sku` = :sku ';
            break;
        case 'subtract':
            $where = ' `in_stock` - :qty WHERE `inventory` . `sku` = :sku ';
            break;
        default:
            $where = ' `in_stock` WHERE `inventory` . `sku` = :sku ';
            break;
    }

    $stmt = $pdo->prepare($sql . $where);
    $stmt->bindParam(':qty', $quantity);
    $stmt->bindParam(':sku', $sku);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
