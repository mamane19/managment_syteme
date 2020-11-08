<?php

    include '../../f_connect_db.php' ;

    # met un projet dans les projets en cours ;
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        $projet_start = $_GET["id"] ;

        $sql_start_proj = "UPDATE agence.projet SET projet.etat = 'en_cours'
                           WHERE projet.id = $projet_start;";
        mysqli_query($conn,$sql_start_proj) ;
        header("refresh: 5") ;
    }

?>