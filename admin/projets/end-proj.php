<?php
    include '../../f_connect_db.php' ;

    # met un projet dans les projets terminés ;
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        $projet_end = $_GET["id"] ;

        $sql_end_proj = "UPDATE agence.projet SET projet.etat = 'termine'
                           WHERE projet.id = $projet_end;";
        mysqli_query($conn,$sql_end_proj)  ;
        header("refresh: 5") ;
    }
?>