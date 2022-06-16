<?php

session_start();

include 'includes/autoloader.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_SESSION['login']) && $_SESSION['login']) {
        if (isset($_SESSION['login']) && $_SESSION['role'] != 'student') {



            var_dump($_POST);










        }
    }
    else
        header('location: index.php');
}
else
    header('location: index.php');