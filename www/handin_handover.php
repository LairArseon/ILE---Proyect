<?php

session_start();

include 'includes/autoloader.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_SESSION['login']) && $_SESSION['login']) {


        $nota = 0;
        foreach ($_POST as $name => $content)
        {
            if ($name != 'id' && $name != 'nPreguntas')
                $nota ++;
        }

        $nota = $nota/$_POST['nPreguntas'] * 10;

        if (Task::updateHandover($_POST['id'], $nota))
            header( "refresh:1;url=display_crud.php?header=Entregas" );
        else 
            header( "refresh:1;url=mark_task.php?id=$_POST[id]" );


        $estructura = new Structure;

        // var_dump($_POST);


        $estructura->head('Generar Corrección');

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