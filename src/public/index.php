<?php

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri === '/registration') {
    if ($requestMethod === 'GET') {
        require_once './registration_form.php';
    } elseif ($requestMethod === 'POST') {
        require_once './handle_registration_form.php';
    } else {
        echo "$requestMethod для адреса $requestUri не поддерживается";
    }
} else if ($requestUri === '/login') {
    if ($requestMethod === 'GET') {
        require_once './login_form.php';
    }
} else if ($requestUri === '/registrate') {
    require_once './handle_registration_form.php';

} else if ($requestUri === '/add-product') {
    if ($requestMethod === 'GET') {
        require_once './add_product_form.php';
    }
} else if ($requestUri === '/catalog') {
        require_once './catalog_page.php';
} else {
    http_response_code(404);
    require_once './404.php';
}



//$pdo = new PDO('pgsql:host=postgres;port=5432;dbname=postgres', 'dbuser', 'dbpwd');


//$statement = $pdo->query("SELECT * FROM users");
//$data = $statement->fetchAll();

//echo "<pre>";
//print_r($data);
//echo "<pre>";