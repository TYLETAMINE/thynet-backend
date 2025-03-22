<?php
session_start();

date_default_timezone_set('Europe/Samara');

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once __DIR__ . '/../api/config/config.php';

$res = $pdo->query("SELECT * FROM users WHERE id = 1");
$user = $res->fetch();

$login = $user['login'];

$res = $pdo->query("SELECT * FROM posts ORDER BY id DESC");
$posts = $res->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $content = $data['content'] ?? '';

    $time_on_post = [
        'января',
        'февраля',
        'марта',
        'апреля',
        'мая',
        'июня',
        'июля',
        'августа',
        'сентября',
        'октября',
        'ноября',
        'декабря'
    ];

    $month = date('n') - 1;
    $post_time = date('d') . ' ' . $time_on_post[$month] . ', ' . date('g:i a');

    $res = $pdo->query("INSERT INTO posts SET author = '$login', content = '$content',
    time_post = '$post_time'");
}

$response = [
    'status' => 'success',
    'content' => $content
];

$imageUrl = "http://localhost:3000/uploads/" . $user['icon_path'];
$backgroundUrl = "http://localhost:3000/uploads/" . $user['bg_path'];

$res = $pdo->query("SELECT * FROM friends WHERE id1 = 1 OR id2 = 1");
$friend_ids = $res->fetchAll();
$friends = [];

foreach ($friend_ids as $friend_id) {
    if ($friend_id['id1'] == 1) {
        $friends[] = $friend_id['id2'];
    } elseif ($friend_id['id2'] == 1) {
        $friends[] = $friend_id['id1'];
    }
}

$friends_data = [];

foreach ($friends as $friend_id) {
    $res = $pdo->query("SELECT * FROM users WHERE id = $friend_id");
    $friend = $res->fetch();
    if ($friend) {
        $friends_data[] = $friend;
    }
}

echo json_encode([
    'user' => $user,
    'posts' => $posts,
    $response,
    'imageUrl' => $imageUrl,
    'backgroundUrl' => $backgroundUrl,
    'friends' => $friends_data,
]);
