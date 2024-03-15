<?php
$host = "pgsql";
$port = "5432";
$dbname = "amave";
$user = "postgres";
$password = "postgres"; 
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string);

ob_start();

if(isset($_POST['submit'])&&!empty($_POST['submit'])){
    
    $hashpassword = md5($_POST['pwd']);
    $sql ="select *from public.user where username = '".pg_escape_string($_POST['username'])."' and password ='".$hashpassword."'";
    $data = pg_query($dbconn,$sql); 
    $login_check = pg_num_rows($data);
    if($login_check > 0){ 
        
        echo "Успешная авторизация";    
	header('Location: '.'/page.html');
    }else{
        
        echo "Проверьте правильность введенных данных";
    }
ob_end_flush();

}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <title> Авторизация </title>
  <meta name="keywords" content="PHP,PostgreSQL,Insert,Login">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2>Авторизация </h2>
  <form method="post">
  
     
    <div class="form-group">
      <label for="name">Имя пользователя:</label>
      <input type="username" class="form-control" id="username" placeholder="Введите имя пользователя" name="username">
    </div>
    
     
    <div class="form-group">
      <label for="pwd">Пароль:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Введите пароль" name="pwd">
    </div>
     
    <input type="submit" name="submit" class="btn btn-primary" value="Авторизоваться">
  </form>
</div>
</body>
</html>