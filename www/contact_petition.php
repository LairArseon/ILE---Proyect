<?php

include "includes/autoloader.inc.php";

if (isset($_POST['email']) && !empty(($_POST['email'])))
{
    $db = new ConnectorSQL;
    // $pubCon = $db->getPubCon();
    $pubCon = $db->getCon();

    // prepare and bind
    $stmt = $pubCon->prepare("INSERT INTO tNotif (notif_type, notif_content) VALUES (?, ?)");
    $stmt->bind_param("ss", $tipo, $email);
    
    // set parameters and execute
    $tipo = "solicitud";
    $email = $_POST['email'];
    $stmt->execute();
    
    $message = 'Solicitud Enviada';
    
    echo "<script type='text/javascript'>
    alert('$message');
    window.location.replace('../');
    </script>";
}
else
header('location: ../');



