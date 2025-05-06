<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Забронировать</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    session_start();
    require_once 'code/connect.php';
    ?>
    <div class="reserv__page">
        <div class="title">Здравствйте, <?= $_SESSION['name'] ?></div>
        <a href="code/logout.php">Выйти</a>

        <ul class="table__list">

            <?php
            $query = "SELECT * FROM users WHERE rent_table = 1";
            $res = mysqli_query($conn, $query);
            $table = mysqli_fetch_assoc($res);
            if (!$table):?>
            <a href="table1.php">
                <li class="table">1</li>
            </a>
            <?php endif; ?>

            <?php
            $query = "SELECT * FROM users WHERE rent_table = 2";
            $res = mysqli_query($conn, $query);
            $table = mysqli_fetch_assoc($res);
            if (!$table):?>
            <a href="table3.php">
                <li class="table">2</li>
            </a>
            <?php endif; ?>

            <?php
            $query = "SELECT * FROM users WHERE rent_table = 3";
            $res = mysqli_query($conn, $query);
            $table = mysqli_fetch_assoc($res);
            if (!$table):?>
            <a href="table3.php">
                <li class="table">3</li>
            </a>
            <?php endif; ?>

            <?php
            $query = "SELECT * FROM users WHERE rent_table = 4";
            $res = mysqli_query($conn, $query);
            $table = mysqli_fetch_assoc($res);
            if (!$table):?>
            <a href="table4.php">
                <li class="table">4</li>
            </a>
            <?php endif; ?>

            <?php
            $query = "SELECT * FROM users WHERE rent_table = 5";
            $res = mysqli_query($conn, $query);
            $table = mysqli_fetch_assoc($res);
            if (!$table):?>
            <a href="table5.php">
                <li class="table">5</li>
            </a>
            <?php endif; ?>

            <?php
            $query = "SELECT * FROM users WHERE rent_table = 6";
            $res = mysqli_query($conn, $query);
            $table = mysqli_fetch_assoc($res);
            if (!$table):?>
            <a href="table6.php">
                <li class="table">6</li>
            </a>
            <?php endif; ?>

            <a href="table7.php">
            <?php
            $query = "SELECT * FROM users WHERE rent_table = 7";
            $res = mysqli_query($conn, $query);
            $table = mysqli_fetch_assoc($res);
            if (!$table):?>
            <a href="table7.php">
                <li class="table">7</li>
            </a>
            <?php endif; ?>

            <?php
            $query = "SELECT * FROM users WHERE rent_table = 8";
            $res = mysqli_query($conn, $query);
            $table = mysqli_fetch_assoc($res);
            if (!$table):?>
            <a href="table8.php">
                <li class="table">8</li>
            </a>
            <?php endif; ?>
        </ul>
    </div>
</body>

</html>