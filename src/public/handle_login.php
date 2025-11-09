<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

$username = $_POST['Username'];
$password = $_POST['password'];

$pdo = new PDO('pgsql:host=postgres;port=5432;dbname=postgres', 'dbuser', 'dbpwd');

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute([':email' => $username]);

$user = $stmt->fetch();

$errors = [];
if ($user === false) {
    $errors['username'] = "Username or password is incorrect";
} else {
    $passwordDb = $user['password'];
    if (password_verify($password, $passwordDb)) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['username'] = $user['name'];

        echo "Редирект на каталог...";
        header('Location: catalog.php');
        exit;
    } else {
        $errors['username'] = "Username or password is incorrect";
    }
}

require_once './login_form.php';


