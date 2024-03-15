<?php
require 'config/db.php';

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

}
?>