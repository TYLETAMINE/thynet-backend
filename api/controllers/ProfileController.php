<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

require_once __DIR__ . '/../config/config.php';
session_start();

$res = $pdo->query("SELECT * FROM users WHERE id = 1");
$user = $res->fetch();

$res = $pdo->query("SELECT * FROM posts ORDER BY id DESC");
$posts = $res->fetchAll();

$imageUrl = "http://localhost:3000/uploads/" . $user['icon_path'];
$backgroundUrl = "http://localhost:3000/uploads/" . $user['bg_path'];

$session_status = $_SESSION['id'];

echo json_encode([
    'user' => $user,
    'posts' => $posts,
    'imageUrl' => $imageUrl,
    'backgroundUrl' => $backgroundUrl,
    'session_status' => $session_status
]);
