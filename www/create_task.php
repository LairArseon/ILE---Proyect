<?php

session_start();

include 'includes/autoloader.inc.php';

if (isset($_SESSION['login']) && $_SESSION['login']) {
    if (isset($_SESSION['login']) && $_SESSION['role'] != 'student') {

        $estructura = new Structure;

        $estructura->head('Crear Tarea');




    }
}
else
    header('location: index.php');
