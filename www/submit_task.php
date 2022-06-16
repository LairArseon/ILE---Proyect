<?php

session_start();

include 'includes/autoloader.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_SESSION['login']) && $_SESSION['login']) {
        if (isset($_SESSION['login']) && $_SESSION['role'] != 'student') {

            foreach ($_POST as $field => $value)
            {
                if ($field == "resource")
                    $idRecurso = $value;
                elseif ($field == "dueDate")
                    $dueDate = $value;
                elseif ($field == "group")
                    $group = $value;
                elseif ($field == "title")
                    $title = $value;
                else 
                    $questions[] = $value;
            }

            $questionsJSON = json_encode($questions);
            $insertdate = date("Y-m-d", strtotime($dueDate));

            Task::registerTask($title, $dueDate, $group, $idRecurso, $questionsJSON);

            $estructura = new Structure;

            header( "refresh:1;url=display_crud.php?header=Tareas" );

            $estructura->head('Crear Tarea');

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