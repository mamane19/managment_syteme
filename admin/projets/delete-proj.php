<?php
    include '../../f_connect_db.php' ;

    # efface le projet de l’id soummis ;
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        $projet_delete = $_GET["id"] ;
        
        $sql_start_proj = "DELETE FROM agence.projet 
                           WHERE projet.id = $projet_delete;";
        mysqli_query($conn,$sql_start_proj) ;
        header("refresh: 1");
    }
?>