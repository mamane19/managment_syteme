<?php
    include '../../f_connect_db.php' ;

    # met un projet dans les projets à venir
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        $projet_prog = $_GET["id"] ;

        $sql_prog_proj = "UPDATE agence.projet SET projet.etat = 'a_venir'
                           WHERE projet.id = $projet_prog;";
        mysqli_query($conn,$sql_prog_proj) ;
        header("refresh: 5") ;
    }
?>