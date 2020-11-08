<?php
    include '../../f_connect_db.php' ;
    
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
       
        $id = $_GET["client"] ;
        
        #cherche contact client
        $sql_check_contact = "SELECT client.id_contact FROM agence.client
                               WHERE client.id = $id ;";
        $sql_check_contact = mysqli_query($conn,$sql_check_contact) ;
        $id_contact = mysqli_fetch_array($sql_check_contact) ;
        $id_contact = intval($id_contact['id_contact']) ;

        #supprime client
        $sql_delete_client = "DELETE FROM agence.client
                             WHERE client.id = $id;" ;
        
        mysqli_query($conn,$sql_delete_client) ;
           
        #supprime contact du client supprimé ;
        $sql_delete_contact = "DELETE FROM agence.contact
                             WHERE contact.id = $id_contact;" ;
        mysqli_query($conn,$sql_delete_contact) ;

        header("refresh: 5") ;
        
    }
?>