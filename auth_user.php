<?php
include_once 'config/db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$username';";
$result = pg_query($connection, $sql);
if (pg_num_rows($result) > 0) {
    $user = pg_fetch_assoc($result);
    if (password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['userid'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: portal.php"); // Успешно
        exit();
    } else {
        header("Location: login.php"); //не верный пароль
        exit();
    }
} else {
    header("Location: login.php"); // не верный логин
    exit();

}
?>