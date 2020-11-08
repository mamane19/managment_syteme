<?php 
    //debut de la session
    session_start();
    if (!isset($_SESSION["collab"]["id"])) {
       header("location: ../index.php");
       exit ;
    }
    else {
        $id_collab = $_SESSION["collab"]["id"] ;
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<?php
include '../head.php'; ?>
<body>
    <div class="tile is-ancestor ">
        <?php 
            include '../f_connect_db.php';
            include 'nav_bar_collab.php';
        ?>
        <div class="tile is-vertical is-parent">
            
            <?php include 'header.php';?>
            <main class="" id="main">
                <section class="box is-child message has-background-primary-light">
                    <div class=" menu-label has-text-centered has-text-weight-bold">
                        <?php
                            # compte les tâches terminées du collaborateur connecté ; 
                            $sql_count = "SELECT COUNT(tache.id) FROM agence.tache
                                          WHERE tache.etat = 'termine' AND
                                          tache.id_collaborateur = $id_collab;" ;
                            $sql_count = mysqli_query($conn,$sql_count) ;
                            $sql_count= mysqli_fetch_array($sql_count) ;
                            $nb = intval($sql_count['COUNT(tache.id)']) ;
                            echo $nb ;
                        ?>
                        t&acirc;che(s) termin&eacute;e(s)
                        <i class="fas fa-hourglass-end"></i>
                        
                    </div>
                </section>
                 <section class="box">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Description</th>
                                <th scope="col"></th>
                                <!-- <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th> -->
                            </tr>
                        </thead>
                    <tbody>
                    <?php
                        # affiche les tâches terminées du collaborateur connecté ;
                        $sql_tache = "SELECT * FROM agence.tache
                                       WHERE tache.etat = 'termine' AND
                                       tache.id_collaborateur = $id_collab;";
                        $sql_tache = mysqli_query($conn,$sql_tache) ;
                        $i = 1 ;//compteur
                        while ($tache = mysqli_fetch_array($sql_tache,MYSQLI_ASSOC)) {
                            
                    ?>                             
                            <tr class="has-background-success-light has-text-success">
                                <th scope="row"><?php echo $i++ ;?></th>
                                <td><p class="is-uppercase"><?php echo $tache['nom'] ; ?></p></td>
                                <td><span class=""><?php echo $tache['explication']; ?></span></td>
                                
                                <td>
                                    <a data-id="<?php echo $tache['id'] ; ?>" onclick="getId(this)"data-toggle="tooltip" data-placement="top" title="G&eacute;rer" data-izimodal-open="#gestion-tache" data-iziModal-transitionOut="fadeOutDown" data-izimodal-transitionin="fadeInDown" style="float: right; display: inline-flex;">
                                        <i class="fas fa-cogs"></i>
                                    </a>
                                </td>
                            </tr>                                                       
                     <?php }?>        
                        </tbody>
                    </table>
                </section>
                
            </main>
        </div>       
    </div>
    <?php 
        include '../modals.php'; 
        include '../script-js.php';
    ?>
</body>
</html>