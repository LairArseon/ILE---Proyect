<?php

$dsn = 'mysql:host=localhost;port=8383;dbname=ILE_DB';
$username = 'root';
$password = 'root';

try {
    $PDO = new PDO($dsn, $username, $password); // PDO Driver DSN. Throws A PDOException.
    echo "Conexion a la base de datos con exito";
}
catch( PDOException $Exception ) {
    // PHP Fatal Error. Second Argument Has To Be An Integer, But PDOException::getCode Returns A
    // String.
    throw new Exception( $Exception->getMessage( ) , $Exception->getCode( ) );
}