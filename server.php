<?php
$postdata = file_get_contents('php://input');
$data = json_decode($postdata, true);

$servername = 'localhost';
$username = 'u2916584_server';
$password = 'Q@q"KN5vi8-zxUk';
$dbname = 'u2916584_applications';
$sendEmail = 'privetmgok@mgok.su';
if($postdata) {
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    $name = mysqli_real_escape_string($conn, $data['name']) ;
    $phoneNumber = mysqli_real_escape_string($conn, $data['phoneNumber']) ;
    $email = mysqli_real_escape_string($conn, $data['email']);
    $datetime = date('d.m.Y H:i');

    $sql = "INSERT INTO `user` (`name`, `phoneNumber`, `email`) 
            VALUES ('{$name}', '{$phoneNumber}', '{$email}');";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo 'Record created';
        mail($email,
            "Заявка принята",
            "{$name}, спасибо что выбрали наш колледж!");
    }else{
        echo mysqli_error($conn);
    }

    mysqli_close($conn);
}