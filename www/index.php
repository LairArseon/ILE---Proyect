<?php
session_start();

include 'includes/autoloader.inc.php';

$estructura = new Structure;

$estructura->head('ILE - Bienvenida', ['./css/styles.css']);

if (isset($_SESSION['login']) && $_SESSION['login'])
    $estructura->paint_header_l();
else
    $estructura->paint_header_nl();

include_once './templates/index.template.php';

$estructura->paint_footer();

$estructura->close_plus_js(['./js/scripts.js']);