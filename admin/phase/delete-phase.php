<?php
    include '../../f_connect_db.php' ;
    
    # efface une phase et ses sous-phases(taches)
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
       
        $id_phase = $_GET["id"] ;

        $sql_delete_tache = "DELETE FROM agence.tache 
                             WHERE tache.id_phase = $id_phase ;" ;
        mysqli_query($conn,$sql_delete_tache) ;

        $sql_delete_phase = "DELETE FROM agence.phase
                             WHERE phase.id = $id_phase ;" ;
        mysqli_query($conn,$sql_delete_phase) ;
        
        header("refresh: 5") ;
        
    }
?>