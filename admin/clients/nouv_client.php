<?php

    include '../../f_connect_db.php';
    include '../../head.php';
    #ajoute un nouveau client ;
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $nom_client = $_POST["nom_client"] ;
        $email_client = $_POST["email_client"] ;
        if (!empty($_POST["statut_client"])) {
            $statut_client  = $_POST["statut_client"];
        }
        if (!empty($_POST["tel_client"])) {
            $tel_client = $_POST["tel_client"] ;
        }

        if (isset($tel_client)) {
            $sql_insert_contact = "INSERT INTO agence.contact (tel,email)
                               VALUE ($tel_client,'$email_client');";
            $sql_insert_contact = mysqli_query($conn,$sql_insert_contact) ;
        }
        else {
            $sql_insert_contact = "INSERT INTO agence.contact (email)
                               VALUE ('$email_client');";
            $sql_insert_contact = mysqli_query($conn,$sql_insert_contact) ;
        }
        

        $id_contact = "SELECT contact.id FROM agence.contact 
                       WHERE contact.email = '$email_client'";
        $id_contact = mysqli_query($conn,$id_contact) ;
		$id_contact = mysqli_fetch_array($id_contact) ;
        $id_contact = intval($id_contact['id']) ;

        if(isset($statut_client)){
        
            $sql_insert_client = "INSERT INTO agence.client (nom,statut,id_contact)
                              VALUE ('$nom_client','$statut_client',$id_contact)";
        }
        else {
        $sql_insert_client = "INSERT INTO agence.client (nom,id_contact)
                              VALUE ('$nom_client',$id_contact)";
        }
        if (!mysqli_query($conn,$sql_insert_client)) {
            echo '<article class="tile box message is-danger">
                        <div class="message-header">
                            <p>Erreur</p>
                        </div>

                        <div class="message-body">
                            Erreur Insertion Client :"'. mysqli_error($conn).'
                        </div>
                   </article>';
        }
        else {
            header("Location://webapp/admin.php") ;
        }
    }
?>