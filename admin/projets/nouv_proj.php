<?php
    //debut de la session
    session_start();
    $resp_proj = $_SESSION["user"]["id"] ;
    include '../../f_connect_db.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){

       $type = $_POST["type_projet"] ;
       $nom_projet = $_POST["nom_projet"] ;
       $etat_projet = $_POST["etat_projet"] ;
       $delai = $_POST["delai"] ;
       $client_proj = $_POST["m_ouvrage"] ;
       
       $sql_insert_proj = "INSERT INTO agence.projet (nom,delai,etat,type,id_client,id_responsable)
                               VALUE ('$nom_projet','$delai','$etat_projet','$type',$client_proj,$resp_proj);" ;
       mysqli_query($conn,$sql_insert_proj) ;
           
       header("refresh: 5");

    }
?>