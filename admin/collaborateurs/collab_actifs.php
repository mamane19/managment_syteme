<?php 
    //debut de la session
    session_start();
    if (!isset($_SESSION["admin"]["id"])) {
       header("location: ../../index.php");
       exit ;
    }
    else {
        $id_responsable = $_SESSION["admin"]["id"] ;
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
                <section class="box is-child message is-warning">
                    <div class="message-header has-text-centered menu-label">
                        <p>COLLABORATEURS EN ACTIVIT&Eacute;</p>
                        <?php
                            
                            # compte les collaborateurs actifs, quelque soit le projet ; 
                            $sql_count = "SELECT COUNT(DISTINCT tache.id_collaborateur) FROM agence.tache
                                          WHERE tache.etat = 'en_cours';" ;
                            $sql_count = mysqli_query($conn,$sql_count) ;
                            $sql_count= mysqli_fetch_array($sql_count) ;
                            $nb = intval($sql_count['COUNT(DISTINCT tache.id_collaborateur)']) ;
                            echo $nb ;
                        ?>
                        collaborateur(s)
                        <i class="fas fa-user-cog"></i>
                    </div>
                </section>
                    <div class="row">
                        <?php
                            
                            $sql_collab = "SELECT * FROM agence.collaborateur
                                           WHERE collaborateur.id IN
                                           (SELECT tache.id_collaborateur FROM agence.tache
                                            WHERE tache.etat='en_cours');";
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
                                              WHERE tache.id_collaborateur = $id_collab
                                              AND tache.etat='en_cours';";
                                $list_tache = mysqli_query($conn,$sql_tache) ;
                                                               
                        ?> 
                                <!-- loop -->
                            <div class="col-4">
                                <div class="tile is-vertical is-parent">
                                    <article class="tile is-child box message is-warning">
                                        <div class="message-header">
                                            <p class="has-text-centered is-uppercase"><?php echo $collab['prenom'].'&nbsp;'.$collab['nom'] ; ?></p>
                                            <i class="fas fa-user-cog"></i>
                                            <i class="button is-small is-loading is-warning"></i>
                                        </div>
                                        <div class="message-body">
                                            <table>
                                                <tr>
                                                    <span class="menu-label"><?php echo !empty($collab['specialite']); ?></span>                                                
                                                </tr> <br>
                                                <tr>
                                                    Tel: <?php echo $contact['tel'].'';?> <br>
                                                
                                                    Email: <?php echo $contact['email'];?>
                                                </tr>
                                            </table>
                                            <table class="table table-borderless table-hover">
                                                <thead>
                                                    <th scope="col"class="table-warning">T&acirc;che</th>
                                                    <th class="table-warning"></th>
                                                </thead>
                                                <tbody>
                                                     <?php
                                                    
                                                    while ($tache = mysqli_fetch_array($list_tache, MYSQLI_ASSOC)) {
                                                    ?>
                                                    <tr>
                                                        <td class="table-warning">
                                                            <!--< vérifie si il a signalé un problème ou pas >-->
                                                            <?php if (!empty($tache['observation'])) {?>                                                            
                                                            <div class="dropdown is-hoverable is-up"style="color:red; float:left;">
                                                                <div class="dropdown-trigger">
                                                                    <a aria-haspopup="true" aria-controls="dropdown-menu4">                                                                                                                                        
                                                                        <i class="fas fa-bullhorn" aria-hidden="true"></i>                                                                    
                                                                    </a>
                                                                </div>
                                                                <div class="dropdown-menu" id="dropdown-menu4" role="menu">
                                                                    <div class="dropdown-content">
                                                                        <div class=" box has-background-danger-light has-text-danger" style="font-size:0.8vw;">
                                                                            <?php echo $tache['observation']; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php } 
                                                                else {?>
                                                                    <i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top" title="Aucun probl&egrave;me" style="float: left; color:green;"></i>
                                                            <?php }?>
                                                        </td>
                                                        <td class="table-warning is-uppercase" data-id="<?php echo $tache["id"]; ?>" data-iziModal-open="#manage-tache" onclick="getId(this)"><?php echo $tache['nom']; ?></td>                                                        
                                                    </tr>
                                                    <?php }?>
                                                </tbody>
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