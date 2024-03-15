<?php
 // Начинаем сессию
session_start();

// Удаляем все переменные сессии.
session_unset();

// Завершаем сессию
session_destroy();

// Перенаправляем пользователя обратно на страницу входа.
header("Location: login.php");
exit();
?>