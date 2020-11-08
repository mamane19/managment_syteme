<?php
    include '../../f_connect_db.php' ;
    #décrire une tâche ;
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        
        $id_tache = $_GET["tache"] ;
        $description = $_GET["comment"] ;
        
        $sql_update_tache = "UPDATE agence.tache 
                            SET explication = '$description' 
                            WHERE tache.id = $id_tache ;" ;
      
        
        mysqli_query($conn,$sql_update_tache) ;
        
        header("refresh: 5") ;
        
    }
?>