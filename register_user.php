<?php
    include_once 'config/db.php';

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $email = $_POST['email'];

    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email';";
    $result = pg_query($connection, $sql);
    if(pg_num_rows($result) > 0){
        echo "Пользователь с таким именем или почтой уже существует!";
    } else {
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email');";
        if(pg_query($connection, $sql)){
            sleep(2);
            header("Location: login.php");
            exit();
        } else {
            echo "Ошибка регистрации, попробуйте снова";
        }
    }
?>
