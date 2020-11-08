<?php
    include '../../f_connect_db.php' ;
    # efface tache par son id ; 
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
       
        $id = $_GET["tache"] ;

        $sql_delete_tache = "DELETE FROM agence.tache 
                             WHERE tache.id = $id ;" ;
        mysqli_query($conn,$sql_delete_tache) ;
       
        header("refresh: 5") ;
        
    }
?>