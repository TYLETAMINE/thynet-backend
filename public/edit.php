<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../api/config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $content = $data['content'] ?? '';
    $id = $data['post_id'] ?? '';

    $res = $pdo->query("UPDATE posts SET content='$content' WHERE id='$id'");
}

$response = [
    'status' => 'success',
    'content' => $content,
    'post_id' => $post_id
];
