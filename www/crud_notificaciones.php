<?php

include 'includes/autoloader.inc.php';

$estructura = new Structure;

$estructura->head('Usuarios', ['./css/crud.style.css']);

$estructura->paint_crud('Notificaciones', 'tNotif', ['notif_id', 'notif_type', 'notif_content']);

$estructura->paint_footer();

$estructura->close_plus_js(['./js/scripts.js']);