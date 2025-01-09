<?php
session_start();
if($_SESSION['auth']) {
    $servername = 'localhost';
    $username = 'u2916584_server';
    $password = 'Q@q"KN5vi8-zxUk';
    $dbname = 'u2916584_applications';

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!empty($_SESSION['day1']) and !empty($_SESSION['day2'])){
        $day1 = $_SESSION['day1'];
        $day2 = $_SESSION['day2'];

        $day1_start = $day1 . " 00:00:00";
        $day2_end = $day2 . " 23:59:59";

        $sql = "SELECT * FROM user WHERE createdAt BETWEEN '{$day1_start}' AND '{$day2_end}' ORDER BY createdAt DESC";
    }else{
        $sql = "SELECT * FROM user WHERE createdAt BETWEEN NOW() - INTERVAL 30 DAY AND NOW()+1 ORDER BY createdAt DESC";
    }

    $result = mysqli_query($conn, $sql);
    if (isset($_POST["CreateCSV"])) {

        $fh = fopen("php://output", "w");
        ob_start();

        $headers = array('ИД', 'Дата добавления', 'Имя', 'Почта', 'Номер телефона');
        fputcsv($fh, $headers);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $time = strtotime($row["createdAt"]);
                $newformat = date('d.m.Y H:i', $time);
                $line = array($row['id'], $newformat, $row['name'], $row['email'], $row['phoneNumber']);
                fputcsv($fh, $line);
            }
        }
        $string = ob_get_clean();

        $filename = 'my_csv_' . date('Ymd') . '-' . date('His');

        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private', false);
        header('Content-Type: application/octet-stream;');
        header('Content-Disposition: attachment; filename="' . $filename . '.csv";');
        header('Content-Transfer-Encoding: utf-8');

        exit($string);
    }
    mysqli_close($conn);
}