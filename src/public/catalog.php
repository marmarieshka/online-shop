<?php

session_start();

if (isset($_SESSION['user_id'])) {

    $pdo = new PDO('pgsql:host=postgres;port=5432;dbname=postgres', 'dbuser', 'dbpwd');
    $stmt = $pdo->query('SELECT * FROM products');
    $products = $stmt->fetchAll();

    require_once './catalog_page.php';
} else {
    header('Location: login.php');
}