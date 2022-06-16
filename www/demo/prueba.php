<?php

include 'includes/autoloader.inc.php';

$name = "Usuarios";
$table = Crud::getNameTable($name);

$crud = new Crud($name, $table);


