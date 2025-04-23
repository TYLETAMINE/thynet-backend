<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Origin: http://localhost:8080');

require_once __DIR__ . '/../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $slug = $data['slug'];
    $token = $data['token'];

    $res = $pdo->query("SELECT * FROM users WHERE token = '$token'");
    $user = $res->fetch();

    // уменшить!!!
    if ($slug == $user['login']) {
        $res = $pdo->prepare("SELECT * FROM posts WHERE author = :login ORDER BY id DESC");
        $res->execute([':login' => $user['login']]);
        $posts = $res->fetchAll();

        $imageUrl = "http://localhost:3000/uploads/" . $user['icon_path'];
        $backgroundUrl = "http://localhost:3000/uploads/" . $user['bg_path'];

        echo json_encode([
            'user' => $user,
            'posts' => $posts,
            'imageUrl' => $imageUrl,
            'backgroundUrl' => $backgroundUrl
        ]);
    } else {
        $res = $pdo->prepare("SELECT * FROM users WHERE login = :slug");
        $res->execute([':slug' => $slug]);
        $user = $res->fetch();

        $res = $pdo->prepare("SELECT * FROM posts WHERE author = :login ORDER BY id DESC");
        $res->execute([':login' => $user['login']]);
        $posts = $res->fetchAll();

        $imageUrl = "http://localhost:3000/uploads/" . $user['icon_path'];
        $backgroundUrl = "http://localhost:3000/uploads/" . $user['bg_path'];

        echo json_encode([
            'user' => $user,
            'posts' => $posts,
            'imageUrl' => $imageUrl,
            'backgroundUrl' => $backgroundUrl
        ]);
    }
}
    // $res = $pdo->query("SELECT token FROM users WHERE login = '$slug'");
    // $userToken = $res->fetch();
    // $userToken = $userToken['token'];

    // if ($token == $userToken) {
    //     $stmt = $pdo->prepare("SELECT * FROM users WHERE token = :token");
    //     $stmt->execute([':token' => $token]);
    //     $user = $stmt->fetch();

    //     $stmt = $pdo->prepare("SELECT * FROM posts WHERE author = :login ORDER BY id DESC");
    //     $stmt->execute([':login' => $user['login']]);
    //     $posts = $stmt->fetchAll();

    //     $imageUrl = "http://localhost:3000/uploads/" . $user['icon_path'];
    //     $backgroundUrl = "http://localhost:3000/uploads/" . $user['bg_path'];

    //     echo json_encode([
    //         'user' => $user,
    //         'posts' => $posts,
    //         'imageUrl' => $imageUrl,
    //         'backgroundUrl' => $backgroundUrl
    //     ]);
    // }

//     $stmt = $pdo->prepare("SELECT * FROM users WHERE token = :token");
//     $stmt->execute([':token' => $userToken]);
//     $user = $stmt->fetch();

//     $stmt = $pdo->prepare("SELECT * FROM posts WHERE author = :login ORDER BY id DESC");
//     $stmt->execute([':login' => $user['login']]);
//     $posts = $stmt->fetchAll();

//     $imageUrl = "http://localhost:3000/uploads/" . $user['icon_path'];
//     $backgroundUrl = "http://localhost:3000/uploads/" . $user['bg_path'];

//     echo json_encode([
//         'user' => $user,
//         'posts' => $posts,
//         'imageUrl' => $imageUrl,
//         'backgroundUrl' => $backgroundUrl
//     ]);
// }
