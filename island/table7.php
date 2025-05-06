<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Бронирование стола 7</title>
</head>

<body>
    <form method="POST">
        <input type="date" name="date">
        <input type="submit" value="Забронировать">
    </form>

    <?php
    require_once 'code/connect.php';
    session_start();

    if (!empty($_POST['date'])) {
        $date = $_POST['date'];
        $table = 7;

        $id = $_SESSION['id'];

        $query = "UPDATE users SET rent_table='$table', date='$date' WHERE id = $id";
        mysqli_query($conn, $query);

        header('Location: reserv.php');
    }
    ?>
</body>

</html>