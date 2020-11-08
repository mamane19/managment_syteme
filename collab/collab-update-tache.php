<?php
    include '../f_connect_db.php' ;
    
    /* collaborateur modifie l’état d’une tâche (en cours, terminée, à venir) 
    et son observation remise à NULL ; */
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        
        $id_tache = $_GET["tache"] ;
        $etat = $_GET["etat"] ;
        
        $sql_update_tache = "UPDATE agence.tache 
                            SET etat = '$etat', observation = NULL 
                            WHERE tache.id = $id_tache ;" ;
      
        
        mysqli_query($conn,$sql_update_tache) ;
        
        header("refresh: 5") ;
        
    }
?>