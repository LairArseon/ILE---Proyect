<?php

session_start();

include 'includes/autoloader.inc.php';

if (isset($_SESSION['login']) && $_SESSION['login'] && isset($_GET['id']) && $_GET['id']) {

    $estructura = new Structure;

    $estructura->head('Tarea');

    $estructura->paint_task($_GET['id']);

    $estructura->paint_footer();

    $estructura->close_plus_js(['./js/tasks.js']);

}
else
    header('location: index.php');
