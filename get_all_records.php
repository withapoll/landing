<?php
session_start()
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Таблица</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <style>
        .container {
            padding: 20px;
        }
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .btn-container {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        .table-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .table thead th {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="form-container">
            <form action="get_all_records.php" method="post" class="row align-items-end">
                <?php
                if(!empty($_SESSION['day1']) and !empty($_SESSION['day2']) and !isset($_POST['sort'])) {
                    $day1_i = $_SESSION['day1'];
                    $day2_i = $_SESSION['day2'];
                }else {
                    $day1_i = $_POST['first'];
                    $day2_i = $_POST['second'];
                }
                ?>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="first" class="form-label">С</label>
                        <input type="date" class="form-control" id="first" name="first" value="<?php echo $day1_i; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="second" class="form-label">По</label>
                        <input type="date" class="form-control" id="second" name="second" value="<?php echo $day2_i; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary" name="sort">Сортировать</button>
                </div>
            </form>

            <div class="btn-container">
                <form action="createCsv.php" method="post">
                    <button type="submit" class="btn btn-success" name="CreateCSV">
                        <i class="bi bi-download"></i> Скачать данные
                    </button>
                </form>
                
                <form action="get_all_records.php" method="post">
                    <button type="submit" class="btn btn-danger" name="exit">
                        <i class="bi bi-box-arrow-right"></i> Выход
                    </button>
                </form>
            </div>
        </div>

        <div class="table-container">
            <table id="dtMaterialDesignExample" class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ИД</th>
                        <th scope="col">Дата добавления</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Почта</th>
                        <th scope="col">Номер телефона</th>
                    </tr>
                </thead>
                <tbody>
<?php
    if($_SESSION['auth']){
        $servername = 'localhost';
        $username = 'u2916584_server';
        $password = 'Q@q"KN5vi8-zxUk';
        $dbname = 'u2916584_applications';

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if(isset($_POST['sort'])){
            $day1 = $_POST['first'];
            $day2 = $_POST['second'];

            $_SESSION['day1'] = $day1;
            $_SESSION['day2'] = $day2;

            $day1_start = $day1 . " 00:00:00";
            $day2_end = $day2 . " 23:59:59";
            $sql = "SELECT * FROM user WHERE createdAt BETWEEN '{$day1_start}' AND '{$day2_end}' ORDER BY createdAt DESC";
        }
        else{
            $sql = "SELECT * FROM user WHERE createdAt BETWEEN NOW() - INTERVAL 30 DAY AND NOW()+1 ORDER BY createdAt DESC";
        }

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)>0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $time = strtotime($row["createdAt"]);
                $newformat = date('d.m.Y H:i',$time);
                echo "<tr><td>" . $row["id"]
                    . "</td><td>" . $newformat
                    . "</td><td>" . $row["name"]
                    . "</td><td>" . $row["email"]
                    . "</td><td>" . $row["phoneNumber"]
                    . "</td></tr>";
            }
        }
        else{ echo "0 results";}
        mysqli_close($conn);
        
        if(isset($_POST['exit'])){
            $_SESSION['auth'] = false;
            session_destroy();
            echo "<script type='text/javascript'>window.top.location='auth_students.php';</script>";
            exit();
        }
    }
    

?>
    </tbody>
</table>
</body>
</html>