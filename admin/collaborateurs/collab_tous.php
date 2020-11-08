<?php 
    //debut de la session
    session_start();
    if (!isset($_SESSION["admin"]["id"])) {
       header("location: ../../index.php");
       exit ;
    }
    
 ?>
<!DOCTYPE html>
<html lang="en">
<?php include '../../head.php'; ?>
<body>
    <div class="tile is-ancestor ">
        <?php 
            include '../../f_connect_db.php';
            include '../nav_bar.php';
        ?>
        <div class="tile is-vertical is-parent">
            
            <?php include '../header.php';?>
            <main class="tile is-child " id="main">
                <section class="box is-child message">
                    <div class="message-header has-text-centered menu-label">
                        <p>TOUS NOS COLLABORATEURS</p>
                        <?php
                            # compte tous les collaborateurs de la société
                            $sql_count = "SELECT COUNT(collaborateur.id) FROM agence.collaborateur
                                           WHERE collaborateur.id <> 5000 ;" ; // ce collaborateur est sans nom, il exite par défaut.
                            $sql_count = mysqli_query($conn,$sql_count) ;
                            $sql_count= mysqli_fetch_array($sql_count) ;
                            $nb = intval($sql_count['COUNT(collaborateur.id)']) ;
                            echo $nb ;
                        ?>
                        collaborateur(s) au total
                        <i class="fas fa-user-cog"></i>
                    </div>
                </section>
                    <div class="row">
                        <?php
                            # tous les collaborateurs ainsi que leur contact ;
                            $sql_collab = "SELECT * FROM agence.collaborateur
                                            WHERE collaborateur.id <> 5000 ;";
                            $sql_collab = mysqli_query($conn,$sql_collab) ;
                            
                            while ($collab = mysqli_fetch_array($sql_collab,MYSQLI_ASSOC)) {
                                
                                #contact du collab
                                $id_user = $collab['id_user'] ;
                                $sql_contact = "SELECT * FROM agence.contact WHERE contact.id IN
                                            (SELECT user.id_contact FROM agence.user
                                                WHERE user.id = $id_user) ;" ;
                                $sql_contact = mysqli_query($conn,$sql_contact) ;
                                $contact = mysqli_fetch_array($sql_contact, MYSQLI_ASSOC) ;
                                
                                #taches du collaborateur
                                $id_collab = $collab['id'] ;
                                $sql_tache = "SELECT * FROM agence.tache
                                             WHERE tache.id_collaborateur = $id_collab;";
                                $etat_tache = mysqli_query($conn,$sql_tache) ;
                                

                                $etat = false ;
                                while ($tache_statut = mysqli_fetch_array($etat_tache, MYSQLI_ASSOC)) {
                                    if ($tache_statut['etat']=="en_cours") {
                                        $etat = true ;
                                        break ;
                                    }
                                }
                        ?> 
                                <!-- loop -->
                            <div class="col-4">
                                <div class="tile is-vertical is-parent">
                                    <article class="tile is-child box message">
                                        <div class="message-header">
                                            <p class="has-text-centered is-uppercase"><?php echo $collab['prenom'].'&nbsp;'.$collab['nom'] ; ?></p>
                                            <i class="fas fa-user-cog"></i>
                                            <!-- $etat = true s’il est en activité ;  -->
                                            <?php if ($etat) {?>
                                                <a data-toggle="tooltip" data-placement="top" title="Supprimer" data-izimodal-open="#not-delete-collab" data-iziModal-transitionOut="fadeOutDown" data-izimodal-transitionin="fadeInDown">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            <?php } 
                                            else {?>
                                                <a data-id="<?php echo $collab['id'] ; ?>" onclick="getId(this)" data-toggle="tooltip" data-placement="top" title="Supprimer" data-izimodal-open="#delete-collab" data-iziModal-transitionOut="fadeOutDown" data-izimodal-transitionin="fadeInDown">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            <?php }?>
                                        </div>
                                        <div class="message-body">
                                            <table>
                                                <tr>
                                                    <span class="menu-label"><?php echo !empty($collab['specialite']); ?></span>
                                                    <!-- <td class="menu-label">25/09/2020 -</td>
                                                    <td class="menu-label">25/10/2020</td> -->
                                                </tr> <br>
                                                <tr>
                                                    Tel: <?php echo $contact['tel'].'';?> <br>
                                                
                                                    Email: <?php echo $contact['email'];?>
                                                </tr>
                                            </table>
                                        </div>
                                    </article>
                                </div>
                            </div>
                        <?php }?>
                    </div>
            </main>
        </div>
    </div>
     <?php 
        include '../../modals.php'; 
        include '../../script-js.php';
    ?>
</body>
</html>