<?php
//проверка существования пользователя(получаем айди юзера)

$pdo = new PDO('pgsql:host=postgres;port=5432;dbname=postgres', 'dbuser', 'dbpwd');

$username = isset($_POST['username']) ? $_POST['username'] : '';

if ($username === '') {
    echo "Пользователь не указан";
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);

$user = $stmt->fetch();

if ($user) {
    $userId = $user['id'];
    echo "Пользователь найден, ID = " . $userId;
} else {
    echo "Пользователь найден";
}


//достать информацию с таблицы user_products(достаем те продукты по фильтрации user_id)