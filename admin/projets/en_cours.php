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
            include '../../f_connect_db.php' ;
            include '../nav_bar.php';
        ?>
        <div class="tile is-vertical is-parent">
            
            <?php include '../header.php';?>
            <main class="tile is-child " id="main">
                <section class="box is-child message is-warning">
                    <div class="message-header menu-label">
                        <p>EN COURS</p>

                        <?php
                            
                            # cherche tous les projets en cours de l’admin connecté ;
                            $sql_count = "SELECT COUNT(projet.id) FROM agence.projet
                                          WHERE projet.etat = 'en_cours'
                                          AND projet.id_responsable = $id_responsable ;" ;
                            $sql_count = mysqli_query($conn,$sql_count) ;
                            $sql_count= mysqli_fetch_array($sql_count) ;
                            $nb = intval($sql_count['COUNT(projet.id)']) ;
                            echo $nb ;
                        ?>
                        projet(s) <!--< nombre de projets en cours par l’admin connecté ; >-->
                        <i class="button is-loading is-warning"></i>

                    </div>
                </section>
                
                <section class="tile is-ancestor">
                    <div class="tile is-vertical is-parent">
                        <?php

                            $proj = "SELECT * FROM agence.projet WHERE projet.etat = 'en_cours'
                                    AND projet.id_responsable = $id_responsable ;" ;
                            

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
                            <article class="tile is-child box message is-warning">
                                <div class="message-header">
                                    <p class="has-text-right is-uppercase">
                                        <?php echo $row['nom'].' &bull; '.$row['type']; ?>
                                    </p>
                                    <a data-id="<?php echo $row['id'] ; ?>" onclick="getId(this)" data-izimodal-open="#nouv-phase" data-iziModal-transitionOut="fadeOutDown" data-izimodal-transitionin="fadeInDown">
                                        <i class="fab fa-buffer"></i>
                                    </a>
                                    <!-- <a data-id=" //echo $row['id'] ; ?>" onclick="getId(this)" data-izimodal-open="#nouv-tache" data-iziModal-transitionOut="fadeOutDown" data-izimodal-transitionin="fadeInDown">
                                        <i class="fas fa-tasks"></i>
                                    </a> -->
                                    <a data-id="<?php echo $row['id'] ; ?>" onclick="getId(this)" data-toggle="tooltip" data-placement="top" title="Reprogrammer" data-izimodal-open="#program" data-iziModal-transitionOut="fadeOutDown" data-izimodal-transitionin="fadeInDown">
                                        <i class="fas fa-business-time"></i>
                                    </a>
                                    <a data-id="<?php echo $row['id'] ; ?>" onclick="getId(this)" data-toggle="tooltip" data-placement="top" title="Terminer" data-izimodal-open="#end" data-iziModal-transitionOut="fadeOutDown" data-izimodal-transitionin="fadeInDown">
                                        <i class="fas fa-hourglass-end"></i>
                                    </a>
                                    <a data-id="<?php echo $row['id'] ; ?>" onclick="getId(this)" data-toggle="tooltip" data-placement="top" title="Supprimer" data-izimodal-open="#delete" data-iziModal-transitionOut="fadeOutDown" data-izimodal-transitionin="fadeInDown">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    
                                </div>
                                <div class="message-body">
                                    <center>
                                        <span class="is-uppercase">
                                            Maitre d’ouvrage &nbsp; : &nbsp;  <?php echo  $nom_client.' &bull; id : '.$row['id_client']; ?>
                                        </span>
                                        <p class="menu-label">
                                            delai : <?php echo $row['delai']; ?>
                                            <a data-id="<?php echo $row['id'] ; ?>" onclick="getId(this)" style="display: inline-block;" data-toggle="tooltip" data-placement="top" title="Changer" data-izimodal-open="#delai" data-iziModal-transitionOut="fadeOutDown" data-izimodal-transitionin="fadeInDown">
                                                    <i class="fas fa-calendar-plus"></i>
                                            </a>
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
                                                        <th scope="col">
                                                            <a data-id="<?php echo $phase_proj['id'] ; ?>" onclick="getId(this)" data-toggle="tooltip" data-placement="top" title="Ajouter une t&acirc;he" data-izimodal-open="#nouv-tache" data-iziModal-transitionOut="fadeOutDown" style="display: inline-block;">
                                                                <i class="fas fa-tasks"></i>
                                                            </a>
                                                            <?php echo $phase_proj['nom']; ?>
                                                        </th>
                                                        <th scope="col">
                                                            <a data-id="<?php echo $phase_proj['id'] ; ?>" onclick="getId(this)" data-toggle="tooltip" data-placement="top" title="Supprimer" data-izimodal-open="#delete-phase" data-iziModal-transitionOut="fadeOutDown" style="display: inline-block; float:right;">
                                                                <i class="fas fa-times"></i>
                                                            </a>
                                                        </th>
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
                                                            <th scope="row"><?php echo $i++ ; ?></th>
                                                            <!-- affiche les tâche selon leur etat d’exécution, seulement dans les projets en cours ; -->
                                                            <?php if ($tache_phase['etat']=="en_attente" && empty($tache_phase['observation']) ) {?>        
                                                                <td class="has-text-info">
                                                                    <?php echo $tache_phase['nom'] ; ?>
                                                                </td>
                                                            <?php } ?>
                                                            <?php if ($tache_phase['etat']=="en_cours" && empty($tache_phase['observation']) ) {?>        
                                                                <td class="has-text-warning">
                                                                    <?php echo $tache_phase['nom'] ; ?>
                                                                </td>
                                                            <?php } ?>
                                                            <?php if ($tache_phase['etat']=="termine" && empty($tache_phase['observation']) ) {?>        
                                                                <td class="has-text-success">
                                                                    <?php echo $tache_phase['nom'] ; ?>
                                                                </td>
                                                            <?php } ?>
                                                            <?php if (!empty($tache_phase['observation']) ) {?>        
                                                                <td class="has-text-danger">
                                                                    <div class="dropdown is-hoverable is-up"style="color:red; float:left;">
                                                                        <div class="dropdown-trigger">
                                                                            <a aria-haspopup="true" aria-controls="dropdown-menu4">                                                                                                                                        
                                                                                <i class="fas fa-bullhorn" aria-hidden="true"></i>                                                                    
                                                                            </a>
                                                                        </div>
                                                                        <div class="dropdown-menu" id="dropdown-menu4" role="menu">
                                                                            <div class="dropdown-content">
                                                                                <div class=" box has-background-danger-light has-text-danger" style="font-size:0.8vw;">
                                                                                    <?php echo $tache_phase['observation']; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>    
                                                                    <?php echo $tache_phase['nom'] ; ?>
                                                                </td>
                                                            <?php } ?>
                                                            <td><?php echo $collab_tache['prenom'].'&nbsp;'.$collab_tache['nom'] ; ?></td>
                                                            <td>
                                                                <a data-id="<?php echo $tache_phase['id'] ; ?>" onclick="getId(this)" data-toggle="tooltip" data-placement="top" title="Modifier" data-izimodal-open="#manage-tache" data-iziModal-transitionOut="fadeOutDown" style="display: inline-block;">
                                                                    <i class="fas fa-tags"></i>
                                                                </a>
                                                            </td>
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