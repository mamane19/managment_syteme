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
                <section class="box is-child message is-success">
                    <div class="message-header menu-label">
                        <p>TERMIN&Eacute;(S)</p>
                        <?php
                            # cherche tous les projets terminés de l’admin connecté
                            
                            $sql_count = "SELECT COUNT(projet.id) FROM agence.projet
                                          WHERE projet.etat = 'termine'
                                          AND projet.id_responsable = $id_responsable;" ;
                            $sql_count = mysqli_query($conn,$sql_count) ;
                            $sql_count= mysqli_fetch_array($sql_count) ;
                            $nb = intval($sql_count['COUNT(projet.id)']) ;
                            echo $nb ;
                        ?>
                        projet(s) <!--< nombre de projets terminés par l’admin connecté ; >-->
                        <i class="fas fa-check-double"></i>
                    </div>
                </section>
                <section class="tile is-ancestor">
                    <div class="tile is-vertical is-parent">
                        <?php

                            $proj = "SELECT * FROM agence.projet WHERE projet.etat = 'termine'
                                     AND projet.id_responsable = $id_responsable;" ;
                            

                            $proj = mysqli_query($conn,$proj) ;

                            while ($row = mysqli_fetch_array($proj, MYSQLI_ASSOC)){
                                
                                #client du projet
                                $id_client = $row['id_client'] ;
                                $sql_nom_client = "SELECT client.nom FROM agence.client
                                                WHERE client.id = $id_client";
                                $nom_client = mysqli_query($conn,$sql_nom_client) ;
                                $nom_client = mysqli_fetch_array($nom_client) ;
                                $nom_client = strval($nom_client['nom']) ;

                                #phase(s) du projet
                                $id_projet = $row['id'] ;
                                $sql_phase_proj = "SELECT * FROM agence.phase 
                                                   WHERE phase.id_projet = $id_projet;" ;
                                $sql_phase_proj = mysqli_query($conn,$sql_phase_proj) ;
          
                                        
                        ?>
                            <article class="tile is-child box message is-success">
                                <div class="message-header">
                                    <p class="has-text-right is-uppercase">
                                        <?php echo $row['nom'].' &bull; '.$row['type']; ?>
                                    </p>
                                    
                                    <a data-id="<?php echo $row['id'] ; ?>" onclick="getId(this)" data-toggle="tooltip" data-placement="top" title="Red&eacute;marrer" data-izimodal-open="#start" data-iziModal-transitionOut="fadeOutDown" data-izimodal-transitionin="fadeInDown">
                                        <i class="fas fa-hourglass-start"></i>
                                    </a>
                                    <a data-id="<?php echo $row['id'] ; ?>" onclick="getId(this)" data-toggle="tooltip" data-placement="top" title="Reprogrammer" data-izimodal-open="#program" data-iziModal-transitionOut="fadeOutDown" data-izimodal-transitionin="fadeInDown">
                                        <i class="fas fa-business-time"></i>
                                    </a>
                                    
                                </div>
                                <div class="message-body">
                                    <center>
                                        <span class="is-uppercase">
                                            Maitre d’ouvrage &nbsp; : &nbsp;  <?php echo  $nom_client.' &bull; id : '.$row['id_client']; ?>
                                        </span>
                                        <p class="menu-label">
                                            delai : <?php echo $row['delai']; ?>
                                        </p>
                                    </center>
                                    <div class="row">
                                        <?php

                                            while ($phase_proj = mysqli_fetch_array($sql_phase_proj, MYSQLI_ASSOC)){
                                            
                                                #tache(s) de la phase
                                                $id_phase = $phase_proj['id'] ;
                                                $sql_tache_phase = "SELECT * FROM agence.tache 
                                                                    WHERE tache.id_phase = $id_phase ;" ;
                                                $sql_tache_phase = mysqli_query($conn,$sql_tache_phase) ;
                                        
                                        ?>
                                            <table class="col-3 table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col"><?php echo $phase_proj['nom']; ?></th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                    $i = 1 ;
                                                    while ($tache_phase = mysqli_fetch_array($sql_tache_phase, MYSQLI_ASSOC)){
                                        
                                                        #collaborateur de la tache
                                                        $id_collab = $tache_phase['id_collaborateur'] ;
                                                        $sql_collab_tache = "SELECT collaborateur.nom, collaborateur.prenom 
                                                                            FROM agence.collaborateur WHERE collaborateur.id = $id_collab ;" ;
                                                        $sql_collab_tache = mysqli_query($conn,$sql_collab_tache) ;
                                                        $collab_tache = mysqli_fetch_array($sql_collab_tache, MYSQLI_ASSOC) ;
                                                
                                                ?>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row"><?php echo $i++ ;?></th>
                                                            <td><?php echo $tache_phase['nom'] ; ?></td>
                                                            <td><?php echo $collab_tache['prenom'].'&nbsp;'.$collab_tache['nom'] ; ?></td>
                                                        </tr>
                                                    </tbody>
                                                <?php } ?>
                                            </table>
                                        <?php } ?>
                                    </div>
                                </div>
                            </article>
                        <?php } ?>
                    </div>
                </section>
            </main>
        </div>
    </div>
    
    <?php 
        include '../../modals.php';
        include '../../script-js.php';
     ?>

</body>
</html>