<?php
$host = "localhost";
$port = "5432";
$dbname = "amave";
$user = "postgres";
$password = "postgres"; 
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string);

ob_start();

if(isset($_POST['submit'])&&!empty($_POST['submit'])){

    $sql = "insert into public.user(username,email,password)values('".$_POST['username']."','".$_POST['email']."','".md5($_POST['pwd'])."')";
    $ret = pg_query($dbconn, $sql);
    if($ret){
      echo "Авторизация прошла успешно";
	    header('Location: '.'/login.php');
	    die();

    } else {
      echo "Введенные данные не корректны";
    }

ob_end_flush();

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Регистрация </title>
  <meta name="keywords" content="PHP,PostgreSQL,Insert,Login">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2>Регистрация</h2>
  <form method="post">
  
    <div class="form-group">
      <label for="username">Имя пользователя:</label>
      <input type="text" class="form-control" id="username" placeholder="Введите имя пользователя" name="username" requuired>
    </div>
    
    <div class="form-group">
      <label for="email">Почта:</label>
      <input type="email" class="form-control" id="email" placeholder="Введите почту" name="email">
    </div>
    
    <div class="form-group">
      <label for="pwd">Пароль:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Введите пароль" name="pwd">
    </div>
     
    <input type="submit" name="submit" class="btn btn-primary" value="Зарегистрироваться">
  </form>
</div>
</body>
</html>