<?php

session_start();

include 'includes/autoloader.inc.php';

$estructura = new Structure;

$estructura->head('Tarea');

$estructura->paint_task('video', 'https://www.youtube.com/embed/Ijz1mXQm7KU', ['Pregunta 1', 'Pregunta 2']);

$estructura->paint_footer();

$estructura->close_plus_js(['./js/tasks.js']);

