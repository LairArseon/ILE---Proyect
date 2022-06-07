<?php
session_start();

include 'includes/autoloader.inc.php';

$estructura = new Structure;

$estructura->head('Login', ['./css/login.style.css']);

include_once './templates/login.template.php';

$estructura->paint_footer();

$estructura->close_plus_js();