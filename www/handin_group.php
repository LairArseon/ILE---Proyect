<?php

session_start();

include 'includes/autoloader.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_SESSION['login']) && $_SESSION['login']) {

        // var_dump($_POST);
        header( "refresh:1;url=display_crud.php?header=Grupos" );

        User::registerGroup($_POST['group'], $_POST['subject'], $_POST['handle'], $_POST['student']);


        $estructura = new Structure;
        $estructura->head('Crear Grupo');

        ?>

        <div class="text-center mt-auto">
        <div class="spinner-border spinner-grow-xl" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        </div>


        <?php

        $estructura->paint_footer();
        $estructura->close_plus_js(['./js/scripts.js']);


    }
    else
        header('location: index.php');
}
else
    header('location: index.php');