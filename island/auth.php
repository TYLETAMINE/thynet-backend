<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wrapper">
        <div class="right__block"></div>

        <?php
        require_once 'code/connect.php';
        session_start();

        if ($_SESSION['id']) {
            header('Location: reserv.php');
        }
        ?>

        <div class="left">
            <form method="post">
                <input type="text" name="name" placeholder="Имя" required>
                <input type="password" name="password" placeholder="Пароль" required>
                <input type="submit" value="Войти">
            </form>

            <a href="registration.php">Нет аккаунта?</a>

            <?php
            if (!empty($_POST['password']) and !empty($_POST['name'])) {
                $name = $_POST['name'];
                $password = $_POST['password'];

                $query = "SELECT * FROM users WHERE name='$name' AND password='$password'";
                $res = mysqli_query($conn, $query);
                $user = mysqli_fetch_assoc($res);

                if (!empty($user)) {
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['name'] = $user['name'];
                    header('Location: reserv.php');
                } else {
                    // Логика для случая, если пароль или логин не верные
                }
            }
            ?>
        </div>

    </div>
</body>

</html>