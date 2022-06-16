<?php

session_start();

include 'includes/autoloader.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_SESSION['login']) && $_SESSION['login']) {


        foreach ($_POST as $name => $content)
        {
            if (preg_match('/^pregunta/', $name))
                $preguntas[] = $content;
            elseif (preg_match('/^respuesta/', $name))
                $respuestas[] = $content;
        }

        // var_dump($_POST);
        // echo "<hr>";
        // var_dump($preguntas);
        // echo "<hr>";
        // var_dump($respuestas);
        // echo "<hr>";

        $preguntasJSON = json_encode($preguntas);
        $respuestasJSON = json_encode($respuestas);

        // var_dump($preguntasJSON);
        // echo "<hr>";
        // var_dump($respuestasJSON);
        // echo "<hr>";

        $content = implode('/', [$preguntasJSON, $respuestasJSON]);
        // var_dump($content);
        // echo "<hr>";

        // $preres = explode('/', $content);
        // var_dump($preres);
        // echo "<hr>";

        if (Task::registerHandover($_SESSION['id'], $_POST['id'], $content) == true){
        header( "refresh:1;url=display_crud.php?header=Tareas" );
        echo '<script>alert(Entrega Realizada);</script>';
        }

        $estructura = new Structure;

        $estructura->head('Entregar Tarea');

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