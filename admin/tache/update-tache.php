<?php
    include '../../f_connect_db.php' ;
    # change collaborateur d’une tache ; 
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        
        $id_tache = $_GET["tache"] ;
        $collab = $_GET["collab"] ;
        
        $sql_update_tache = "UPDATE agence.tache 
                            SET id_collaborateur = $collab, observation = NULL 
                            WHERE tache.id = $id_tache ;" ;
      
        
        mysqli_query($conn,$sql_update_tache) ;
        
        header("refresh: 5") ;
        
    }
?>