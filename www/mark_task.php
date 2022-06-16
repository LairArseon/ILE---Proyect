<?php

session_start();

include 'includes/autoloader.inc.php';



if (isset($_SESSION['login']) && $_SESSION['login']) {
    if (isset($_SESSION['login']) && $_SESSION['role'] != 'student') {


        $estructura = new Structure;

        $estructura->head('Evaluar Tarea', ['./css/side.style.css']);

        $estructura->paint_sidebar($_SESSION['role']);
        
        if (isset($_GET['id']))
            $estructura->paint_task_supervisor($_GET['id']);

        $estructura->paint_footer();

        $estructura->close_plus_js(['./js/scripts.js', './js/task_supervisor.js']);
    }
}
else
    header('location: index.php');
