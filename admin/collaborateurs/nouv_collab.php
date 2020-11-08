<?php
    # ajoute un responsable a un collaborateur
    # fonctionalité désactivée ;
    include '../../f_connect_db.php';
    include '../../head.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        $collab = $_GET["collab"] ;
        $respon = $_GET["respon"] ;

        if (intval($respon)) {
            
            if (intval($collab)) {
                $sql_update = "UPDATE agence.collaborateur
                               SET id_responsable = $respon
                               WHERE collaborateur.id = $collab;" ;
                $sql_update = mysqli_query($conn,$sql_update) ;
            }
            else {
               $sql_check_collab = "SELECT user.id FROM agence.user
                                    WHERE user.username = '$collab' ;" ;

               $id_user = mysqli_query($conn,$sql_check_collab) ;
               $id_user = mysqli_fetch_array($id_user) ;
               $id_user = intval($id_user['id']) ;

               $sql_update = "UPDATE agence.collaborateur
                              SET id_responsable = $respon
                              WHERE collaborateur.id_user = $id_user;" ;
               $sql_update = mysqli_query($conn,$sql_update) ;
            }
        }
        else {
            $sql_check_user = "SELECT user.id FROM agence.user
                                  WHERE user.username = '$respon' ;" ;
            
            $sql_check_user = mysqli_query($conn,$sql_check_user) ;
            $sql_check_user = mysqli_fetch_array($sql_check_user) ;
            $sql_check_user = intval($sql_check_user['id']) ;

            $id_respon = "SELECT responsable.id FROM agence.responsable
                          WHERE responsable.id_user = $sql_check_user;" ;
            $id_respon = mysqli_query($conn,$id_respon) ;
            $id_respon = mysqli_fetch_array($id_respon) ;
            $id_respon = intval($id_respon['id']) ;
            if (intval($collab)) {
                $sql_update = "UPDATE agence.collaborateur
                               SET id_responsable = $id_respon
                               WHERE collaborateur.id = $collab;" ;
                $sql_update = mysqli_query($conn,$sql_update) ;
            }
            else {
               $sql_check_collab = "SELECT user.id FROM agence.user
                                    WHERE user.username = '$collab' ;" ;
               $id_user = mysqli_query($conn,$sql_check_collab) ;
               $id_user = mysqli_fetch_array($id_user) ;
               $id_user = intval($id_user['id']) ;
               $sql_update = "UPDATE agence.collaborateur
                              SET id_responsable = $id_respon
                              WHERE collaborateur.id_user = $id_user;" ;
               $sql_update = mysqli_query($conn,$sql_update) ;
            }
        }
        
        header("refresh: 5") ;
    }

?>