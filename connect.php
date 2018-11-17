<?php

    try {
        $pdo = new PDO("mysql:host=gator3112.hostgator.com;dbname=mau5mach_ecommerce", "mau5machine", "Random12134$$");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        "There was an error with your connection: " . $e->getMessage();
    }
