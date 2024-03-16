<?php
/* require 'config/db.php';

// Проверяем отправлен ли запрос методом POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $date = $_POST['date'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Подготавливаем SQL-запрос
    $sql = "INSERT INTO newsfeed (date, subject, message) VALUES ($1, $2, $3)";

    // Подготавливаем привязку параметра
    $result = pg_prepare($connection, "my_query", $sql);

    // Выполняем SQL-запрос
    $result = pg_execute($connection, "my_query", array($date, $subject, $message));
    echo "<a href=\"javascript:history.go(-1)\">GO BACK</a>";

} */

require 'config/db.php';

// Проверяем отправлен ли запрос методом POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $date = date('Y-m-d'); // текущая дата
    $time = date('H:i'); // текущее время
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Подготавливаем SQL-запрос
    $sql = "INSERT INTO newsfeed (date, time, subject, message) VALUES ($1, $2, $3, $4)";

    // Подготавливаем привязку параметра
    $result = pg_prepare($connection, "my_query", $sql);

    // Выполняем SQL-запрос
    $result = pg_execute($connection, "my_query", array($date, $time, $subject, $message));

    if(!$result) {
        echo "An error occurred.\n";
        exit;
    }

    echo "<a href=\"javascript:history.go(-1)\">GO BACK</a>";
}
?>