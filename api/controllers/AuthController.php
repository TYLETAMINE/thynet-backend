<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Origin: http://localhost:8080');

require_once __DIR__ . '/../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $login = $data['login'] ?? '';
    $password = $data['password'] ?? '';

    $res = $pdo->query("SELECT * FROM users WHERE login = '$login' AND password = '$password'");
    $user = $res->fetch();

    $userId = $user['id'];

    if (!empty($user)) {
        echo json_encode([
            'success' => true,
            'userId' => $userId,
            'userLogin' => $login
    ]);
    } else {
        echo json_encode(['session' => false]);
    }
}
