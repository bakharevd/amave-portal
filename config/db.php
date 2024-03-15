<?php
    $host = "pgsql";
    $user = "postgres";
    $pass = "postgres";
    $db = "amave";

    $connection = pg_connect("host=$host dbname=$db user=$user password=$pass")
    or die('Невозможно подключиться к базе данных: ' . pg_last_error());



    function generateBlueNotification ($text) {
        $html = '<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">';
        $html .= '<div class="toast-header">';
        $html .= '<img src="https://img.icons8.com/ios-filled/50/FA5252/cancel.png" class="rounded me-2" height="22" width="22">';
        $html .= '<strong class="me-auto">Amave Portal</strong>';
        $html .= '<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>';
        $html .= '</div>';
        $html .= '<div class="toast-body">';
        $html .= $text;
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
?>
