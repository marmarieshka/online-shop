<?php

function validate(array $data): array {
    $errors = [];

    if (isset($data['name'])) {
        $name = $data['name'];
        if (strlen($name) < 5) {
            $errors['name'] = "Имя должно быть больше 5 символов";
        }
    } else {
        $errors['name'] = 'Имя должно быть заполнено';
    }

    if (isset($data['email'])) {
        $email = $data['email'];
        if (strlen($email) < 2) {
            $errors['email'] = "Email должен быть больше 2 символов";
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errors['email'] = "Некорректный формат email.";
        } else {
            $pdo = new PDO('pgsql:host=postgres;port=5432;dbname=postgres', 'dbuser', 'dbpwd');
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
            if ($stmt->execute([':email' => $email])) {
                $count = $stmt->fetchColumn();
                if ($count > 0) {
                    $errors['email'] = "Этот email уже зарегистрирован.";
                }
            } else {
                $errors['database'] = "Ошибка при выполнении запроса к базе данных.";
            }
        }
    } else {
        $errors['email'] = 'Email должен быть заполнен';
    }


    if (isset($data['psw'])) {
        $password = $data['psw'];
        if (strlen($password) < 3) {
            $errors['psw'] = "Пароль должен быть не менее 3 символов";
        }


        if (isset($data['psw-repeat'])) {
            $passwordRep = $data['psw-repeat'];
            if ($password !== $passwordRep) {
                $errors['psw-repeat'] = "Пароли не совпадают";
            }
        } else {
            $errors['psw-repeat'] = "Повтор пароля должен быть заполнен";
        }
    } else {
        $errors['psw'] = "Пароль должен быть заполнен";
    }

    return $errors;
}

$errors = validate($_POST);

if (empty($errors)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $psw = $_POST['psw'];
    $password = password_hash($psw, PASSWORD_DEFAULT);


    $pdo = new PDO('pgsql:host=postgres;port=5432;dbname=postgres', 'dbuser', 'dbpwd');
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    $stmt->execute([':name' => $name, ':email' => $email, ':password' => $password]);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);

    $result = $stmt->fetch();
}
    require_once './registration_form.php';

?>
//if (empty($errors)) {
    //Сохранение пользователя в бд
//} else {
    //print_r($errors);
//}




