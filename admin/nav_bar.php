<!-- bar de navigation, sera inclu dans tous les fichier où c’est nécessaire -->

<div class="tile is-3 is-vertical is-parent">
    <div id="header" class="tile box is-child">
        <div class="top">
            <span >
                <a style="display: inline-flex; color:red;" onclick="<?php //session_destroy(); //header("location: index.php"); ?>" class="" href="//webapp/close-session.php">
                    <i class="fas fa-power-off"> Fermer</i>
                </a>
            </span>
            <!-- Logo -->
            <div id="logo">
                <span class="image avatar48"><img src="//webapp/images/logo.png" class="img-fluid" alt=""/></span>
                <h1 id="">
                    <?php echo $_SESSION["admin"]["prenom"].'&nbsp;'.$_SESSION["admin"]["nom"];?>
                </h1>
                <p>Chef de Projet</p>
           </div>
            <!-- Nav -->
                <div>
                    <input class="input is-rounded" type="search" placeholder="Rechercher">
                </div>
                    <aside class="menu">
                        <p class="menu-label">
                            CLIENTS
                        </p>
                        <ul class="menu-list">
                            <li><a id="client_actif" href="//webapp/admin/clients/clients_actifs.php" >Actifs</a></li>
                            <li>
                                <a  data-izimodal-open="#nouv-cli" data-iziModal-transitionOut="fadeOutDown" data-izimodal-transitionin="fadeInDown">
                                    Nouveau
                                </a>
                            </li>
                            <li><a id="all_client" href="//webapp/admin/clients/clients_tous.php" >Tous nos Clients</a></li>
                        </ul>
                        <p class="menu-label" style="text-align: center;">
                            GESTION INTERNE
                        </p>
                        <p class="menu-label">
                            PROJETS
                        </p>
                        <ul class="menu-list">
                            <li>
                                <a data-izimodal-open="#nouv-proj" data-iziModal-transitionOut="fadeOutDown" data-izimodal-transitionin="fadeInDown">
                                    Nouveau Projet
                                </a>
                            </li>
                            <li>
                                <a class="is-active" href="//webapp/admin/admin.php" id="ges_proj">G&eacute;rer vos projets</a>
                                <ul>
                                    <li><a href="//webapp/admin/projets/en_cours.php">En Cours</a></li>
                                    <li><a href="//webapp/admin/projets/termines.php">Terminés</a></li>
                                    <li><a href="//webapp/admin/projets/a_venir.php">&Agrave; Venir</a></li>
                                </ul>
                            </li>
                        </ul>
                        <p class="menu-label">
                            COLLABORATEURS
                        </p>
                        <ul class="menu-list">
                            <!-- <li><a data-id="< //echo $_SESSION["user"]["id"]; ?>" onclick="getId(this)" data-izimodal-open="#nouv-collab" data-iziModal-transitionOut="fadeOutDown" data-izimodal-transitionin="fadeInDown">Nouveau</a></li> -->
                            <li><a href="//webapp/admin/collaborateurs/collab_actifs.php">En Activit&eacute;</a></li>
                            <li><a href="//webapp/admin/collaborateurs/collab_tous.php">Tous</a></li>
                        </ul>
                        </aside>
                </nav>
        </div>
    </div>
    
</div>


