<!DOCTYPE html>
<html>
<head>
<title>Регистрация</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
        <div class="container">
            <h2>Amave</h2>
            <h3>Регистрация</h3>
            <form action="register_user.php" method="post">

                <label class="sr-only" for="username"></label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Имя пользователя</div>
                    </div>
                    <input type="text" class="form-control" name="username" placeholder="Имя пользователя">
                </div>

                <label class="sr-only" for="email"></label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Почта</div>
                    </div>
                    <input type="email" class="form-control" name="email" placeholder="Почта">
                </div>

                <label class="sr-only" for="password"></label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Пароль          </div>
                    </div>
                    <input type="password" class="form-control" name="password" placeholder="Пароль">
                </div>

                <input type="submit" class="btn btn-primary" value="Регистрация">
            </form>
    </div>
</body>
</html>