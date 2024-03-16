<?php
include_once 'config/db.php';
session_start();
date_default_timezone_set('Asia/Novosibirsk');
if (!isset ($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
} else {
    $username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
}
try {
    // Запрос SQL
    $sql_feed = "SELECT * FROM newsfeed ORDER BY date DESC";

    // Подготовка запроса
    $result_feed = pg_prepare($connection, "get_news", $sql_feed);

    // Выполнение запроса
    $res_feed = pg_execute($connection, "get_news", []);

    //Получение результатов
    $news = pg_fetch_all($res_feed, PGSQL_ASSOC);

    $sql_image = "SELECT image FROM users WHERE id = $1";

    $result_image = pg_prepare($connection, "get_image", $sql_image);

    $res_image = pg_execute($connection, "get_image", array($userid));

    $user = pg_fetch_array($res_image);

    $fileExtesions = ["jpg", "jpeg", "png"];

    foreach ($fileExtesions as $ext) {

        $imagePath = "images/users/{$username}.{$ext}";

        if (file_exists($imagePath)) {
            break;
        }

    }

    if (!file_exists($imagePath)) {
        $imagePath = "images/users/default.png";
    }

    foreach ($news as $item) {
        $color = 'black'; // цвет по умолчанию

        if ($item['subject'] == 'Green') {
            $color = 'green';
        } else if ($item['subject'] == 'Red') {
            $color = 'red';
        } else if ($item['subject'] == 'Neutral') {
            $color = 'gray';
        }
    }

} catch (Exception $e) {

    echo $e->getMessage();

}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Amave Portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>


    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>

    <!-- ################ Левое меню навигации ################ -->

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="active">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Меню</span>
                </button>
            </div>
            <div class="p-4">
                <h1><a href="index.html" class="logo">Amave</a></h1>
                <ul class="list-unstyled components mb-5">
                    <li>
                        <div class="dropdown pb-4">
                            <a href="#"
                                class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">


                                <img src='<?php echo $imagePath; ?>' alt="sad" width="30" height="30"
                                    class="rounded-circle">
                                <span class="d-none d-sm-inline mx-1">
                                    <?php echo $username; ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                <li><a class="dropdown-item text-black-50 p-3" href="settings.php"> Настройки </a></li>
                                <li><a class="dropdown-item text-black-50 p-3" href="#"> Профиль </a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-black p-3" onclick="location.href='logout.php'"
                                        href="#">Выйти</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="active"><a href="portal.php"><span class="fa fa-home mr-3"></span> Домашнаяя страница
                        </a></li>
                    <li><a href="#"><span class="fa fa-user mr-3"></span> Личный кабинет </a></li>
                    <li><a href="calendar.php"><span class="fa fa-briefcase mr-3"></span> Календарь </a></li>
                    <li><a href="#"><span class="fa fa-sticky-note mr-3"></span> Новости </a></li>
                    <li><a href="#"><span class="fa fa-paper-plane mr-3"></span> DayOff </a></li>
                </ul>

                <div class="mb-5">
                    <!-- <h3 class="h6 mb-3">Subscribe for newsletter</h3>
                    <form action="#" class="subscribe-form">
                        <div class="form-group d-flex">
                            <div class="icon"><span class="icon-paper-plane"></span></div>
                            <input type="text" class="form-control" placeholder="Enter Email Address">
                        </div>
                    </form> -->
                </div>
                <div class="footer">
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0.
                        Copyright &copy;
                        <script>document.write(new Date().getFullYear());</script> All rights reserved | This template
                        is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
                            target="_blank">Colorlib.com</a>
                         Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>

            </div>
        </nav>

        <!-- ################ Содержимое страницы ################ -->

        <div id="content" class="p-4 p-md-5 pt-5">
            <h2 class="mb-4">Новостная лента</h2>
            <ul>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-4 m-3">
                            <div class="row block-panel shadow" style="height: 50%;">
                                <div class="col-lg-12 col-md-12 col-sm-12 sidebar-page-container">
                                    <div class="sidebar">
                                        <div class="sidebar-widget sidebar-post">
                                            <div class="widget-title" style="height: 50%;">
                                                <h3>Лента</h3>
                                            </div>
                                            <div class="post-inner">
                                                <div class="carousel-inner-data">
                                                    <ul>
                                                        <?php
                                                        foreach ($news as $item) {
                                                            echo "<li>";
                                                            echo "<div class=\"post\">";
                                                            echo "<div class=\"file-box\"><i class=\"far fa-folder-open\"></i><p>" . htmlspecialchars($item['subject']) . " - <span class=\"time\">" . date('H:i', strtotime(htmlspecialchars($item['time']))) . "</span></p></div>";
                                                            echo "<div class=\"post-date\"><p>" . htmlspecialchars(date('d', strtotime($item['date']))) . "</p><span>" . htmlspecialchars(date('M', strtotime($item['date']))) . "</span></div>";
                                                            echo "<h5><p>" . htmlspecialchars($item['message']) . "</p></h5>";
                                                            echo "</div>";
                                                            echo "</li>";
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col m-3 block-panel shadow" style="text-align: center;">
                                    <p>
                                        <img src='<?php echo $imagePath; ?>' alt="sad" width="75%" height="75%"
                                            class="rounded">
                                    </p>
                                    <p>
                                        У
                                        <?php echo $username ?> день рождения!
                                    </p>
                                    <p>
                                        Насри ему на стул, пусть он обрадуется!
                                    </p>
                                </div>

                                <div class="col m-3 block-panel shadow">
                                    <p>Это вторая мини-плитка второй колонки первой строки</p>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col m-3 block-panel shadow">
                                    <p>Это первая мини-плитка второй колонки второй строки</p>
                                </div>
                                <div class="col m-3 block-panel shadow">
                                    <p>Это вторая мини-плитка второй колонки второй строки</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </ul>
        </div>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.0-beta3/js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js" defer></script>
</body>

</html>