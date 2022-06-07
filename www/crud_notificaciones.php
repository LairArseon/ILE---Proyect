<?php

session_start();

include 'includes/autoloader.inc.php';

$estructura = new Structure;

$estructura->head('Usuarios', ['./css/crud.style.css', './css/side.style.css']);

$estructura->paint_sidebar($_SESSION['role']);

$estructura->paint_crud('Notificaciones', 'tNotif', ['notif_id', 'notif_type', 'notif_content']);

$estructura->paint_footer();

$estructura->close_plus_js(['./js/scripts.js']);