<?php

include 'includes/autoloader.inc.php';

$estructura = new Structure;

$estructura->head('Usuarios', ['./css/crud.style.css']);

$estructura->paint_crud('Usuarios','tUser', ['user_id', 'user_name', 'user_details']);

$estructura->paint_footer();

$estructura->close_plus_js(['./js/scripts.js']);