<?php

session_start();

include 'includes/autoloader.inc.php';

if (isset($_SESSION['login']) && $_SESSION['login']) {
    if (isset($_SESSION['login']) && $_SESSION['role'] != 'student') {

        $estructura = new Structure;

        $estructura->head('Crear Grupo', ['./css/side.style.css']);

        $estructura->paint_sidebar($_SESSION['role']);

        
        $estructura->paint_group_creator();


        $estructura->paint_footer();

        $estructura->close_plus_js(['./js/scripts.js', './js/task_creator.js']);
    }
}
else
    header('location: index.php');
