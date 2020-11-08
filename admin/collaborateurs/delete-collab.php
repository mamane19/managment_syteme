<?php
    include '../../f_connect_db.php' ;
    # efface collaborateur et son contact ; 
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
       
        $id_collab = $_GET["collab"] ;

        #son contact
        $sql_check_contact = "SELECT client.id_contact FROM agence.client
                               WHERE client.id = $id ;";
        $sql_check_contact = mysqli_query($conn,$sql_check_contact) ;
        $id_contact = mysqli_fetch_array($sql_check_contact) ;
        $id_contact = intval($id_contact['id_contact']) ;

        $sql_delete_collab = "DELETE FROM agence.collaborateur 
                             WHERE collaborateur.id = $id_collab ;" ;
        mysqli_query($conn,$sql_delete_collab) ;
       
       
        
        $sql_delete_contact = "DELETE FROM agence.contact
                             WHERE contact.id = $id_contact;" ;
        mysqli_query($conn,$sql_delete_contact) ;
                   
        header("refresh: 5") ;
        
    }
?>