<?php

include 'includes/autoloader.inc.php';


$db = new ConnectorSQL;
// $conn = $db->getPubCon();
$conn = $db->getCon();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

try {
$query = "INSERT INTO `tNotif` (`notif_id`, `notif_type`, `notif_content`) VALUES (NULL, 'solicitud', 'exe@gmail.com') ";
$result = mysqli_query($conn, $query);


  
  // prepare and bind
  $stmt = $conn->prepare("INSERT INTO tNotif (notif_type, notif_content) VALUES (?, ?)");
  $stmt->bind_param("ss", $tipo, $email);
  
  // set parameters and execute
  $tipo = "solicitud";
  $email = "john@example.com";
  $stmt->execute();
}
catch(Exception $e)
{
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

$conn = $db->getCon();
$query = "SELECT * from tNotif";

echo '<table>';
try {
    $result = mysqli_query($conn, $query);
    while($value = $result->fetch_array(MYSQLI_ASSOC)){
        echo '<tr>';
        foreach($value as $element){
            echo '<td>' . $element . '</td>';
        }
        echo '</tr>';
    }
echo '</table>';
}catch(Exception $e)
{
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Loader</title>
</head>
<body>

    
</body>
</html>