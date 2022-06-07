<?php
session_start();

if (isset($_SESSION['login']) && $_SESSION['login']){

    include 'includes/autoloader.inc.php';

    $estructura = new Structure;

    $estructura->head('Usuarios', ['./css/crud.style.css', './css/side.style.css']);

    $estructura->paint_sidebar($_SESSION['role']);

    $estructura->paint_crud();

    $estructura->paint_footer();

    $estructura->close_plus_js(['./js/scripts.js']);
}
else header('location: index.php');