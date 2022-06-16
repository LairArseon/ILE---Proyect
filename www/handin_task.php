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
        
        var_dump($_POST);
        echo "<hr>";
        var_dump($preguntas);
        echo "<hr>";
        var_dump($respuestas);
        echo "<hr>";


    }
    else
        header('location: index.php');
}
else
    header('location: index.php');