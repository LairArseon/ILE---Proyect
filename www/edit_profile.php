<?php

session_start();

if (isset($_SESSION['login']) && $_SESSION['login']){
    if (isset($_SESSION['login']) && $_SESSION['role'] != 'student') {

    include 'includes/autoloader.inc.php';

    $estructura = new Structure;

    $estructura->head('Profile', ['./css/crud.style.css', './css/side.style.css']);

    if (isset($_POST['edit']))
    {
        User::modifyProfile([
            'user_name' => $_POST['nombre'], 
            'user_last_name' => $_POST['apellidos'], 
            'user_phone' => $_POST['telefono'], 
            'user_address' => $_POST['direccion'], 
            'user_post_code' => $_POST['ccpp'],
            'user_mail' => $_POST['email'],
            'user_details' => $_POST['detalles'],
            'user_pw' => $_POST['password'],
            'user_role' => $_POST['rol'],
            'user_id' => $_POST['id']
        ]);
    }

    $estructura->paint_sidebar($_SESSION['role']);

    if (isset($_GET['id']))
        $estructura->profile_card($_GET['id']);

    $estructura->paint_footer();

    $estructura->close_plus_js(['./js/scripts.js']);

    }
    else header('location: ./');
}
else header('location: ./');