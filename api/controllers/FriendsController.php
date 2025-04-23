<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Origin: http://localhost:8080');

require_once __DIR__ . '/../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $token = $data['token'] ?? '';

    $res = $pdo->prepare("SELECT id FROM users WHERE token = :token");
    $res->execute([':token' => $token]);
    $user = $res->fetch();

    $id = $user['id'];

    // $res = $pdo->prepare("SELECT id1, id2 FROM friends WHERE id1 = :userId");
    // $res->execute([':userId' => $id]);
    // $friend_ids = $res->fetchAll();

    $res = $pdo->query("SELECT id1, id2 FROM friends WHERE id1 = $id OR id2 = $id");
    $friend_ids = $res->fetchAll();
    
    $friends = [];
    foreach ($friend_ids as $friend_id) {
        if ($friend_id['id1'] == $id) {
            $friends[] = $friend_id['id2'];
        } else {
            $friends[] = $friend_id['id1'];
        }
    }

    if (!empty($friends)) {
        $placeholders = implode(',', array_fill(0, count($friends), '?'));
        $res = $pdo->prepare("SELECT * FROM users WHERE id IN ($placeholders)");
        $res->execute($friends);
        $friends_data = $res->fetchAll();

        $imageUrl = "http://localhost:3000/uploads/" . $friends_data['icon_path'];
    } else {
        $friends_data = [];
    }

    echo json_encode([
        'success' => true,
        'friends' => $friends_data
    ]);
}
