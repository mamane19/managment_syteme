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
                        <p>TOUS NOS CLIENTS</p>
                        <?php
                            
                            # tous les clients de la société ; 
                            $sql_count = "SELECT COUNT(client.id) FROM agence.client;" ;
                            $sql_count = mysqli_query($conn,$sql_count) ;
                            $sql_count= mysqli_fetch_array($sql_count) ;
                            $nb = intval($sql_count['COUNT(client.id)']) ;
                            echo $nb ;
                        ?>
                        client(s) au total  <!--< leur nombre >-->
                        <i class="fas fa-user-check"></i>
                    </div>
                </section >
                <section class="box">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Statut</th>
                                <th scope="col">T&eacute;l&eacute;phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Nombre de projets</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                    <tbody>
                    <?php
                        # les clients et leurs contact ;
                        $sql_client = "SELECT * FROM agence.client;";
                        $sql_client = mysqli_query($conn,$sql_client) ;
                        $i = 1 ;//compteur
                        while ($client = mysqli_fetch_array($sql_client,MYSQLI_ASSOC)) {
                            
                            #contact du client
                            $id_contact = $client['id_contact'] ;
                            $sql_contact = "SELECT * FROM agence.contact
                                            WHERE contact.id = $id_contact ;" ;
                            $sql_contact = mysqli_query($conn,$sql_contact) ;
                            $contact = mysqli_fetch_array($sql_contact, MYSQLI_ASSOC) ;
                            
                            #projets du clients 
                            $id_client = $client['id'] ;
                            $sql_proj = "SELECT * FROM agence.projet
                                            WHERE projet.id_client = $id_client;";
                            $etat_proj = mysqli_query($conn,$sql_proj) ;
                            $sql_proj = mysqli_query($conn,$sql_proj) ;

                            # nombre de projets (à venir, en cours, ou terminés) du client
                            $nombre_projet = "SELECT COUNT(projet.id) FROM agence.projet
                                               WHERE projet.id_client = $id_client;" ;
                            $nombre_projet = mysqli_query($conn,$nombre_projet) ;
                            $nombre_projet = mysqli_fetch_array($nombre_projet, MYSQLI_ASSOC) ;
                            # parmi tous les clients, si un client a au moins un projet en cours, $etat = true ;                            
                            $etat = false ;
                            while ($proj_etat = mysqli_fetch_array($etat_proj, MYSQLI_ASSOC)) {
                                if ($proj_etat['etat']=="en_cours") {
                                    $etat = true ;
                                    break ;
                                }
                            }
                    ?> 
                            <tr>
                                <th scope="row"><?php echo $i++ ;?></th>
                                <td><p class="is-uppercase"><?php echo $client['nom'] ; ?></p></td>
                                <td><span class="menu-label"><?php echo $client['statut']; ?></span></td>
                                <td><?php echo $contact['tel'].'';?></td>
                                <td><?php echo $contact['email'];?></td>
                                <td><?php echo $nombre_projet['COUNT(projet.id)'];?></td>
                                <td>
                                    <!--< si $etat, alors empêche de supprimer le client ; >-->
                                    <?php if ($etat) {?>
                                        <a data-toggle="tooltip" data-placement="top" title="Supprimer" data-izimodal-open="#not-delete-client" data-iziModal-transitionOut="fadeOutDown" data-izimodal-transitionin="fadeInDown">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    <?php } 
                                    else {?>
                                        <a data-id="<?php echo $client['id'] ; ?>" onclick="getId(this)" data-toggle="tooltip" data-placement="top" title="Supprimer" data-izimodal-open="#delete-client" data-iziModal-transitionOut="fadeOutDown" data-izimodal-transitionin="fadeInDown">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    <?php }?>
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
        include '../../modals.php'; 
        include '../../script-js.php';
    ?>
</body>
</html>