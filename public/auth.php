<?php
session_start();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../api/config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $login = $data['login'] ?? '';
    $password = $data['password'] ?? '';

    $res = $pdo->query("SELECT * FROM users WHERE login = '$login' AND password = '$password'");
    $user = $res->fetch();

    if (!empty($user)) {
        $_SESSION['auth'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['login'] = $user['login'];
        $_SESSION['status'] = $user['status'];

        echo json_encode(['session' => $_SESSION['auth']]);
    } else {
        echo json_encode(['session' => false]);
    }
}
