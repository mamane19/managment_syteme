<?php
    include '../../f_connect_db.php' ;

    # change le délai d’un projet
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        $projet_delai = $_GET["id"] ;
        $delai = $_GET["delai"] ;
        
        $sql_set_delai = "UPDATE agence.projet SET projet.delai = '$delai'
                           WHERE projet.id = $projet_delai;";
        mysqli_query($conn,$sql_set_delai) ;
        header("refresh: 5") ;
    }
?>