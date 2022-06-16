<?php

session_start();

include 'includes/autoloader.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_SESSION['login']) && $_SESSION['login']) {
        if (isset($_SESSION['login']) && $_SESSION['role'] != 'student' && $_SESSION['role'] != 'teacher') {

            $estructura = new Structure;
            $estructura->head('Crear Usuario', ['./css/crud.style.css', './css/side.style.css']);

            $estructura->paint_sidebar($_SESSION['role']);

            User::newUser();

            $estructura->paint_footer();

            $estructura->close_plus_js(['./js/scripts.js']);
        }
    }
    else
        header('location: index.php');
}
else
    header('location: index.php');