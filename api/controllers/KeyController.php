<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Origin: http://localhost:8080');

require_once __DIR__ . '/../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    
    $token = $data['token'] ?? '';
    $login = $data['login'] ?? '';

    $pdo->query("UPDATE users SET token = '$token' WHERE login = '$login'");
}

echo json_encode([
    'success' => true,
    'token' => $token
]);
