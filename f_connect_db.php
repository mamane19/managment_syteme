<?php
/* fichier de connexion à la base de donnée
    sera inclu dans tous les ficher en cas de besoin
*/
// connexion base de donnée

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name = "agence";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    function close_connexion($conn){
        mysqli_close($conn);
    }

?>