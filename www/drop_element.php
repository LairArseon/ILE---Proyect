<?php

session_start();

include 'includes/autoloader.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_SESSION['login']) && $_SESSION['login']) {

        if (isset($_SESSION['login']) && $_SESSION['role'] != 'student') {

            $estructura = new Structure;

            if (Crud::dropElement($_GET['tName'], $_GET['elId']))
                header( "refresh:1;url=display_crud.php?header=$_GET[header]" );

            else
                echo "<script>alert('Error de proceso')</script>";
                header( "refresh:3;url=display_crud.php?header=$_GET[header]" );

            $estructura->head('Eliminar Elemento');

            ?>

            <div class="text-center mt-auto">
            <div class="spinner-border spinner-grow-xl" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            </div>

            <?php


            


            $estructura->paint_footer();

        }
    }
    else
        header('location: index.php');
}
else
    header('location: index.php');