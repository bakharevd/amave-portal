<?php
$host = "pgsql";
$db = "amave";
$user = "postgres";
$pass = "postgres";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
    
function isUsernameUnique($username) {
    global $conn;
    
    $sql = "SELECT username FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    
    return $stmt->num_rows === 0;
}

function isEmailUnique($email) {
    global $conn;
    
    $sql = "SELECT email FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    
    return $stmt->num_rows === 0;
}

function registerUser($username, $email, $password) {
    global $conn;

    // Password hashing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $username, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "Пользователь успешно зарегистрирован";
    } else {
        echo "Ошибка: " . $stmt->error;
    }
}

function loginUser($username, $password) {
    global $conn;
    
    $sql = "SELECT password FROM users WHERE username = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($passwordHashed);
    $stmt->fetch();

    if (password_verify($password, $passwordHashed)) {
        $_SESSION['username'] = $username;  // start the session
        echo 'Успешная авторизация';
    } else {
        echo 'Не верный пароль';
    }
}

// Example of registration
$new_username = 'test_username';
$new_email = 'test_email@example.com';
$new_password = 'test_password';

if (isUsernameUnique($new_username) && isEmailUnique($new_email)) {
    registerUser($new_username, $new_email, $new_password);
} else {
    echo 'Username or email already exists';
}

// Example of login
$username = 'test_username';
$password = 'test_password';

if (!isUsernameUnique($username)) {
    loginUser($username, $password);
} else {
    echo 'Username does not exist';
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <title>Авторизация </title>
  <meta name="keywords" content="PHP,PostgreSQL,Insert,Login">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2>Авторизация</h2>
  <form method="post">
  
    <div class="form-group">
      <label for="username">Имя пользователя:</label>
      <input type="text" class="form-control" id="username" placeholder="Введите имя пользователя" name="username" requuired>
    </div>
    
    <div class="form-group">
      <label for="pwd">Пароль:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Введите пароль" name="pwd">
    </div>
     
    <input type="submit" name="submit" class="btn btn-primary" value="Войти">
    <input type="submit" name="registration" class="btn btn-primary" value="Регистрация">
  </form>
</div>
</body>
</html>