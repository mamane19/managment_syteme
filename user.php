<?php
   //debut de la session
    session_start();
    
    include 'f_connect_db.php' ;
    #connexion
    $user_a = $user_c = " " ;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $pwd = $_POST["pwd"];
        
        $sql_connect = "SELECT user.password FROM agence.user 
                        WHERE user.username = '$username';";
        $sql_statut = "SELECT user.statut FROM agence.user
                        WHERE user.username = '$username';";
        $sql_connect = mysqli_query($conn,$sql_connect) ;
        $sql_statut = mysqli_query($conn,$sql_statut);
        $row = mysqli_fetch_array($sql_statut) ;
        $statut = strval($row['statut']) ;

        $connex = mysqli_fetch_array($sql_connect) ;
        $connect = strval($connex['password']) ;
        
        # si ($username and $pwd) = true ;
        if ($connect==$pwd) {
            
            if ($statut=="admin") {
                #cherche identité admin
                $sql_user = "SELECT * FROM agence.responsable
                        WHERE responsable.id_user IN 
                        (SELECT user.id FROM agence.user
                         WHERE user.username = '$username') ;";
                $sql_user = mysqli_query($conn,$sql_user) ;
                $user_a = mysqli_fetch_array($sql_user, MYSQLI_ASSOC) ;

                $_SESSION["admin"] = $user_a; // stocke les informations pour la session admin ;
                
                header("location: ./admin/admin.php") ;
                exit ;
            }
            else {
                #sinon cherche identité collaborateur
                $sql_user = "SELECT * FROM agence.collaborateur
                        WHERE collaborateur.id_user IN 
                        (SELECT user.id FROM agence.user
                         WHERE user.username = '$username') ;";
                $sql_user = mysqli_query($conn,$sql_user) ;
                $user_c = mysqli_fetch_array($sql_user, MYSQLI_ASSOC) ;
                $_SESSION["collab"] = $user_c ; // stocke les informations pour la session collab ;
                header("location: ./collab/collab.php") ;
                exit;
            }
        }
        else {
            header("location: index.php") ;
        }
    }
?>