<?php
session_start();

include 'includes/autoloader.inc.php';

if (isset($_SESSION['login']) && $_SESSION['login']){
        
    isset($_GET['header']) ? $cname = $_GET['header'] : $cname = '';
    $ctable = Crud::getNameTable($cname);

    $estructura = new Structure;

    $estructura->head($cname, ['./css/crud.style.css', './css/side.style.css']);

    $estructura->paint_sidebar($_SESSION['role']);

    $estructura->paint_crud($cname, $ctable);

    $estructura->paint_footer();

    $estructura->close_plus_js(['./js/scripts.js']);
}
else header('location: index.php');