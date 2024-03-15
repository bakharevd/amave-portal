<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
} else {
    $username = $_SESSION['username'];
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
                                <img src="images/s.bakharev.jpg" alt="hugenerd" width="30" height="30"
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
                    <li><a href="portal.php"><span class="fa fa-home mr-3"></span> Домашнаяя страница
                        </a></li>
                    <li><a href="#"><span class="fa fa-user mr-3"></span> Личный кабинет </a></li>
                    <li class="active"><a href="calendar.php"><span class="fa fa-briefcase mr-3"></span> Календарь </a></li>
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
            <h2 class="mb-4">Домашняя страница</h2>
            <section class="ftco-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center mb-5">
                            <h2 class="heading-section">Календарь</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="calendar-section">
                                <div class="row no-gutters">
                                    <div class="col-md-6">

                                        <div class="calendar calendar-first" id="calendar_first">
                                            <div class="calendar_header">
                                                <button class="switch-month switch-left">
                                                    <i class="fa fa-chevron-left"></i>
                                                </button>
                                                <h2></h2>
                                                <button class="switch-month switch-right">
                                                    <i class="fa fa-chevron-right"></i>
                                                </button>
                                            </div>
                                            <div class="calendar_weekdays"></div>
                                            <div class="calendar_content"></div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="calendar calendar-second" id="calendar_second">
                                            <div class="calendar_header">
                                                <button class="switch-month switch-left">
                                                    <i class="fa fa-chevron-left"></i>
                                                </button>
                                                <h2></h2>
                                                <button class="switch-month switch-right">
                                                    <i class="fa fa-chevron-right"></i>
                                                </button>
                                            </div>
                                            <div class="calendar_weekdays"></div>
                                            <div class="calendar_content"></div>
                                        </div>

                                    </div>

                                </div> <!-- End Row -->

                            </div> <!-- End Calendar -->
                        </div>
                    </div>
                </div>
            </section>




            <p>Какой то крутой текст</p>
            <p>Умри</p>





        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js" defer></script>
</body>

</html>