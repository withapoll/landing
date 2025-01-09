<?php
session_start();
$_SESSION['auth'] = false
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
</head>
<body>
<div style="display: flex; align-items: center; justify-content: center; height: 100vh" >
<form action="auth_students.php" method="post">
    <p>Введите код авторизации</p>
    <input id="pass" name="pass" type="password">
    <br>
    <input type="submit" name="submit" value="Вход">
    <?php
    if(isset($_POST["submit"])){
        if ($_POST["pass"] == "123"){
            $_SESSION['auth'] = true;
            $_SESSION['day1'] = date('Y-m-d', strtotime('-1 month'));
            $_SESSION['day2'] = date('Y-m-d');
            echo "<script type='text/javascript'>window.top.location='get_all_records.php';</script>";
            exit;
        }else{
            echo "<br>Вы ввели неправильный пароль";
        }}
    ?>
</form>
</div>
</body>
</html>
