<?php
    include '../../f_connect_db.php' ;
    # ajoute une tache à une phase d’un projet ; 
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        
        $nom_tache = $_GET["nom_tache"] ;
        $id_phase = $_GET["phase_tache"] ;
        $collab = $_GET["collab_tache"] ;
        
        $sql_insert_tache = "INSERT INTO agence.tache (nom, id_phase,id_collaborateur)
                             VALUE ('$nom_tache',$id_phase,$collab);" ;
      
        
        mysqli_query($conn,$sql_insert_tache) ;
        
        header("refresh: 5") ;
        
    }
?>