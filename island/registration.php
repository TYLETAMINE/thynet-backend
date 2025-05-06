<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="wrapper">
        <div class="right">
            <form method="POST">
                <input name="name" placeholder="Имя">
                <input name="subname" placeholder="Фамилия">
                <input name="password" type="password" placeholder="Пароль">
                <input type="submit" value="Зарегистрироваться">
            </form>

            <?php
            require_once 'code/connect.php';
            session_start();

            if ($_SESSION['id']) {
                header('Location: reserv.php');
            }

            if (!empty($_POST['name']) and !empty($_POST['password'])) {
                $name = $_POST['name'];
                $subname = $_POST['subname'];
                $password = $_POST['password'];

                $query = "INSERT INTO users SET name='$name', subname = '$subname', password='$password'";
                mysqli_query($conn, $query);

                header('Location: auth.php');
            }
            ?>
        </div>

        <div class="left__block"></div>
    </div>
</body>

</html>