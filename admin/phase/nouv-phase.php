<?php
    include '../../f_connect_db.php' ;
    
    # ajoute une phase à un projet ;
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        $nom_phase = $_GET["nom"] ;
        $id_projet = $_GET["id"] ;

        $sql_insert_phase = "INSERT INTO agence.phase (nom, id_projet)
                             VALUE ('$nom_phase',$id_projet) ;" ;
        mysqli_query($conn,$sql_insert_phase) ;
        
        header("refresh: 3") ;
       
    }
?>