<?php
session_start();
$_SESSION['auth'] = false
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .auth-container {
            max-width: 400px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .error-message {
            color: #dc3545;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body class="bg-light">
    <div class="d-flex align-items-center justify-content-center min-vh-100">
        <div class="auth-container">
            <form action="auth_students.php" method="post">
                <h4 class="mb-4 text-center">Введите код авторизации</h4>
                <div class="mb-3">
                    <input id="pass" name="pass" type="password" class="form-control" placeholder="Введите пароль">
                </div>
                <div class="d-grid">
                    <button type="submit" name="submit" class="btn btn-primary">Вход</button>
                </div>
                <?php
                if(isset($_POST["submit"])){
                    if ($_POST["pass"] == "123"){
                        $_SESSION['auth'] = true;
                        $_SESSION['day1'] = date('Y-m-d', strtotime('-1 month'));
                        $_SESSION['day2'] = date('Y-m-d');
                        echo "<script type='text/javascript'>window.top.location='get_all_records.php';</script>";
                        exit;
                    } else {
                        echo "<div class='error-message text-center'>Вы ввели неправильный пароль</div>";
                    }
                }
                ?>
            </form>
        </div>
    </div>
</body>
</html>