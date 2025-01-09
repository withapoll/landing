<?php
session_start()
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Таблица</title>
    <link href="css/mdb.min.css" rel="stylesheet">
    <script type="text/javascript" src="js/mdb.es.min.js"></script>
</head>
<body>
<div>
    <form action="get_all_records.php" method="post">
        <?php
        if(!empty($_SESSION['day1']) and !empty($_SESSION['day2']) and !isset($_POST['sort'])) {
            $day1_i = $_SESSION['day1'];
            $day2_i = $_SESSION['day2'];
        }else {
            $day1_i = $_POST['first'];
            $day2_i = $_POST['second'];
        }
        echo "С <input type='date' id='first' name='first' value='{$day1_i}'>";
        echo "По <input type='date' id='second' name='second' value='{$day2_i}'>";
        ?>
        <input type="submit" value="Сортировать" name="sort">
    </form>

    <form action="createCsv.php" method="post">
        <input type="submit" name="CreateCSV" value="Скачать данные">
    </form>
    
    <form action="get_all_records.php" method="post">
        <input type="submit" name="exit" value="Выход">
    </form>
</div>
<table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th class="th-sm">ИД</th>
        <th class="th-sm">Дата добавления</th>
        <th class="th-sm">Имя</th>
        <th class="th-sm">Почта</th>
        <th class="th-sm">Номер телефона</th>
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