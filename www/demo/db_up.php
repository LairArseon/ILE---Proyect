<?php

try {
    $conn = mysqli_connect('db', 'root', 'root', 'ILE_DB');
    echo "OK"; echo "<br>";
}catch(Exception $e)
{
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

$query = "SELECT * from tUser";
echo '<table>';
try {
    $result = mysqli_query($conn, $query);
    while($value = $result->fetch_array(MYSQLI_ASSOC)){
        echo '<tr>';
        echo '<td><a href="#"><span class="glyphicon glyphicon-search"></span></a></td>';
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

