<?php
    include '../f_connect_db.php' ;
   
    # envoie le problème d’une tâche, signalé par un collaborateur 
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        
        $id_tache = $_GET["tache"] ;
        $comment = $_GET["comment"] ;
        
        $sql_update_tache = "UPDATE agence.tache 
                            SET observation = '$comment' 
                            WHERE tache.id = $id_tache ;" ;
      
        
        mysqli_query($conn,$sql_update_tache) ;
        
        header("refresh: 5") ;
        
    }
?>