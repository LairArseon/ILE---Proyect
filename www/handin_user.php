<?php

session_start();

include 'includes/autoloader.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_SESSION['login']) && $_SESSION['login']) {

        header( "refresh:1;url=display_crud.php?header=Alumnos" );

        $estructura = new Structure;

        $estructura->head('Crear Usuario');

        $name = $_POST['nombre'];
        $surname = $_POST['apellidos'];
        $mail = $_POST['email'];
        $pw = $_POST['password'];
        $address = $_POST['direccion'];
        $ccpp = $_POST['ccpp'];
        $phone = $_POST['telefono'];
        $details = $_POST['detalles'];
        $role = $_POST['rol'];


        User::registerUser($name, $surname, $mail, $pw, $address, $ccpp, $phone, $details, $role);

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