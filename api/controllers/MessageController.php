<?php
session_start();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../config/config.php';

$res = $pdo->query("SELECT * FROM messages WHERE sender = 1");
$messages = $res->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $content = $data['content'] ?? '';

    $res = $pdo->query("INSERT INTO messages SET dialog_id = '0', sender = 1,
    content = '$content'");

    // $res = $pdo->query("SELECT * FROM messages WHERE sender = 1");
    // $messages = $res->fetchAll();
}

echo json_encode([
    'messages' => $messages
]);
