<?php

if (gethostname() == "DESKTOP-AQI4339" || gethostname() == "LAPTOP-SR75OTDR") {
    // Create a new pdo connection to the database
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=ecommerce", "root", "root");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        "There was an error with your connection: " . $e->getMessage();
    }
} else {
    try {
        $pdo = new PDO("mysql:host=gator3112.hostgator.com;dbname=mau5mach_ecommerce", "mau5machine", "Random12134$$");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        "There was an error with your connection: " . $e->getMessage();
    }
}
