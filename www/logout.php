<?php
//Al hacer logout destruiremos la sesion, sus variables y nos redirigiremos al inicio, si no hacemos click en el enlace
//El refresh nos llevará alli a los 3 segundos

header('Refresh: 2; URL = login.php');
session_start();
unset($_SESSION["user"]);
unset($_SESSION["role"]);
unset($_SESSION["login"]);
unset($_SESSION["id"]);


session_destroy();

include 'includes/autoloader.inc.php';

$estructura = new Structure;

$estructura->head('Logout');

?>

<div class="text-center mt-auto">
  <div class="spinner-border spinner-grow-xl" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>


<?php

$estructura->paint_footer();

$estructura->close_plus_js(['./js/scripts.js']);