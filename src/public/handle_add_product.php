<?php
//проверка существования пользователя
//валидация
//сохранение информации в бд в таблицу user_products

session_start();

if (isset($_SESSION['user_id'])) {
    echo "Ошибка: пользователь не авторизован";
    exit;
}
$userId = $_SESSION['user_id'];

    $pdo = new PDO('pgsql:host=postgres;port=5432;dbname=postgres', 'dbuser', 'dbpwd');

    $productId = isset($_POST['product_id']) ? $_POST['product_id'] : '';
    $amount = isset($_POST['amount']) ? $_POST['amount'] : '';

    //валидация
    function is_digits($str) {
        if ($str === '') return false;
        for ($i = 0; $i < strlen($str); $i++) {
            if ($str[$i] < '0' || $str[$i] > '9') return false;
        }
        return true;
    }
//проверяем product_id
    if (!is_digits($productId)) {
        echo "Некорректный ID продукта";
        exit;
    }
//проверяем что amount положительное число
    if (!is_digits($amount)) {
        echo "Количество должно быть положительным числом";
        exit;
    }
    //проверяем что amount не равен нулю
if ($amount === '0') {
    echo "Количество должно быть положительным числом";
    exit;
}
//проверяем что продукт сущетсвует
$stmt = $pdo->prepare("SELECT id FROM products WHERE id = :product_id");
$stmt->execute([':product_id' => $productId]);
if (!$stmt->fetch()) {
    echo "Продукт не найден";
    exit;
}

//прлверяем что пользователь существует
$stmt = $pdo->prepare("SELECT id FROM users WHERE id = :user_id");
$stmt->execute([':user_id' => $userId]);
if (!$stmt->fetch()) {
    echo "Пользователь не найден";
    exit;
}
//проверяем есть ли уже запись с этим продуктом у данного пользователя
$stmt = $pdo->prepare("SELECT id, amount FROM user_products WHERE user_id = :userId AND product_id");
$stmt->execute([
    'user_id' => $userId,
    'product_id' => $productId,
    ]);
$existing = $stmt->fetch();

if ($existing) { //обнрвляем количество товара увеличивая amount вместо добавления новой записи
    $newAmount = $existing['amount'] + $amount;
    $stmt = $pdo->prepare("UPDATE user_products SET amount = :amount WHERE id = :id");
    $stmt->execute([':amount' => $newAmount, ':id' => $existing['id']]);
} else { // если записи нет то создается новая
    $stmt = $pdo->prepare("INSERT INTO user_products (user_id, product_id, amount) VALUES (:user_id, :product_id, :amount)"); // есои товара нет, то вставляем новую строку в юзерпродуктс
    $stmt->execute([':user_id' => $userId, ':product_id' => $productId, ':amount' => $amount]);
}

echo "Товар успешно добавлен в корзину";






