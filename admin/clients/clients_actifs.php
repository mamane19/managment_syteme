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
                        <p>CLIENTS EN ACTIVIT&Eacute;</p>
                        <?php
                            
                            # clients ayant au moins un projets en cours auprès de l’admin connecté ;
                            $sql_count = "SELECT COUNT(projet.id_client) FROM agence.projet
                                          WHERE projet.etat = 'en_cours'
                                          AND projet.id_responsable = $id_responsable;" ;
                            $sql_count = mysqli_query($conn,$sql_count) ;
                            $sql_count= mysqli_fetch_array($sql_count) ;
                            $nb = intval($sql_count['COUNT(projet.id_client)']) ;
                            echo $nb ;
                        ?>
                        client(s) au total <!--< leur nombre >-->
                        <i class="button is-loading is-warning"></i>
                        <i class="fas fa-user-check"></i>
                    </div>
                </section>
                    <div class="row">
                        <?php
                            # les projets en question ;
                            $sql_proj = "SELECT * FROM agence.projet
                                         WHERE projet.etat = 'en_cours'
                                         AND projet.id_responsable = $id_responsable;" ;
                            $sql_proj = mysqli_query($conn,$sql_proj) ;
                            
                            while ($proj_encours = mysqli_fetch_array($sql_proj, MYSQLI_ASSOC)) {
                               
                                $id_client = $proj_encours['id_client'] ;
                                $sql_client = "SELECT * FROM agence.client
                                            WHERE client.id = $id_client ;";
                                $sql_client = mysqli_query($conn,$sql_client) ;
                                
                                $client = mysqli_fetch_array($sql_client,MYSQLI_ASSOC) ;
                                    
                                    #contact du client
                                    $id_contact = $client['id_contact'] ;
                                    $sql_contact = "SELECT * FROM agence.contact
                                                    WHERE contact.id = $id_contact ;" ;
                                    $sql_contact = mysqli_query($conn,$sql_contact) ;
                                    $contact = mysqli_fetch_array($sql_contact, MYSQLI_ASSOC) ;
                        ?> 
                            <div class="col-4">
                                <div class="tile is-vertical is-parent">
                                    <article class="tile is-child box message is-warning">
                                        <div class="message-header">
                                            <p class="has-text-right is-uppercase"><?php echo $client['nom'].' &bull; '.$client['statut'] ; ?></p>
                                            <i class="fas fa-user-check"></i>
                                        </div>
                                        <div class="message-body">
                                            <table>
                                                <tr>
                                                    Tel: <?php echo $contact['tel'].'';?> <br>
                                                
                                                    Email: <?php echo $contact['email'];?>
                                                </tr>
                                                <tr>
                                                    <th>Projets</th>
                                                    <th></th>
                                                </tr>           
                                                <tr class="menu-label">
                                                    <td><?php echo $proj_encours['nom']; ?>&nbsp;&nbsp;</td>
                                                    <td><center><?php echo $proj_encours['type']; ?></center></td>
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