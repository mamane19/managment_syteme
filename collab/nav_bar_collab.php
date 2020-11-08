<!-- bar de navigation du collaboateur, sera inclu dans tous les fichier où c’est nécessaire  -->
<div class="tile is-3 is-vertical is-parent">
    <div id="header" class="tile box is-child">
        <div class="top">
            <span>
                <a style="display: inline; color:red ;" class="" href="//webapp/close-session.php">
                    <i class="fas fa-power-off">Fermer</i>
                </a>
            
            </span>
            
            <!-- Logo -->
            <div id="logo">
                <span class="image avatar48"><img src="../images/logo.png" class="img-fluid" alt=""/></span>
                <h1 class="is-capitalized">
                    <?php echo $_SESSION["collab"]["prenom"].'&nbsp;'.$_SESSION["collab"]["nom"];?>
                </h1>
                <p>
                    Collaborateur
                </p>
           </div> <br> 
            <!-- Nav -->
                <div>
                    <input class="input is-rounded" type="search" placeholder="Rechercher">
                </div>
                    <aside class="menu">
                        
                        <br> <br> <br> <br>
                        <p class="menu-label">
                            T&Agrave;CHES
                        </p>
                        <ul class="menu-list">
                            <!-- <li>
                                <a data-izimodal-open="#alert-tache" data-iziModal-transitionOut="fadeOutDown" data-izimodal-transitionin="fadeInDown">
                                    Signaler une t&acirc;che
                                </a>
                            </li> -->
                            <li>
                                <a class="is-active" href="collab.php">G&eacute;rer vos t&acirc;ches</a>
                                <ul>
                                    <li><a href="tache-en-attente.php" >En Attente</a></li>
                                    <li><a href="tache-en-cours.php" >En Cours</a></li>
                                    <li><a href="tache-termine.php" >Terminées</a></li>
                                </ul>
                            </li>
                        </ul>
                        </aside>
                </nav>
        </div>
    </div>
    
</div>