<?php
    #inscription ;
    include 'f_connect_db.php' ;

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        
		
        $statut = $_POST["statut"] ;
        $nom = $_POST["nom"] ;
        $prenom = $_POST["prenom"] ;
        $tel = $_POST["tel"] ;
        $email = $_POST["email"] ;
        $username = $_POST["username"] ;
        $password = $_POST["pwd"] ;
        
        $sql_insert_contact = "INSERT INTO agence.contact (tel,email)
                                VALUE ($tel,'$email')";
        $sql_insert_contact = mysqli_query($conn,$sql_insert_contact) ;

        $id_contact = "SELECT contact.id FROM agence.contact WHERE contact.email = '$email'";
        $id_contact = mysqli_query($conn,$id_contact) ;
		$id_contact = mysqli_fetch_array($id_contact) ;
        $id_contact = intval($id_contact['id']) ;
		$sql_insert_user = "INSERT INTO agence.user (username,password,statut,id_contact)
                            VALUE ('$username','$password','$statut',$id_contact)" ;
        $sql_insert_user = mysqli_query($conn,$sql_insert_user);
        $id_user = "SELECT user.id FROM agence.user WHERE user.username = '$username'";
        $id_user = mysqli_query($conn,$id_user) ;
        $id_user = mysqli_fetch_array($id_user) ;
        $id_user = intval($id_user['id']) ;

        
        if ($statut =="collaborateur") {
            $sql_insert_collab = "INSERT INTO agence.collaborateur (nom,prenom,id_user)
                                    VALUE ('$nom','$prenom',$id_user)";
			if(!mysqli_query($conn,$sql_insert_collab)){
                echo '<article class="tile box message is-danger">
                        <div class="message-header">
                            <p>Erreur</p>
                        </div>

                        <div class="message-body">
                            Erreur Insertion Collaborateur :"'. mysqli_error($conn).'
                        </div>
                        </article>';
            }
        }
        else {
            $sql_insert_admin = "INSERT INTO agence.responsable (nom,prenom,id_user)
                                    VALUE ('$nom','$prenom',$id_user)";
            if(!mysqli_query($conn,$sql_insert_admin)){
                echo '<article class="tile box message is-danger">
                        <div class="message-header">
                            <p>Erreur</p>
                        </div>

                        <div class="message-body">
                            Erreur Insertion Admin :"'. mysqli_error($conn).'
                        </div>
                        </article>';
            }

        }
    //back to login.php; 
    header("Location:index.php") or die("Connexion Impossible, Réessayez");

    }

?>