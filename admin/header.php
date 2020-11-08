<!-- en-tête admin , sera inclu dans tous les fichier où c’est nécessaire  -->
<div class="tile is-child">
    <div class="box" style="background-color: rgba(203, 255, 239, 0.185); color:gray;">
        <header class="row" >
        <!-- Services item -->
            <div class="col-1">
                <div class="services-item wow fadeInDown" data-wow-delay="0.2s">
                    <div class="">
                        <img src="//webapp/images/logo.png" alt="" style="max-width: 90px; height: auto;" class="img-fluid logo">
                    </div>
                </div>
            </div>

            <div class="col-4" style="padding-top: 2px;">
                <h5 class="h5">GESTIONNAIRE DES TACHES</h5>
                <p class="h6">Agence de Communication Digitale &bull; F&egrave;s</p>
            </div>

            <div class="col-3" style="padding-top: 2px;">
                <h5 class="h5" id="temps"></h5>
            </div>
            <div class="col-2">
                <div class="clock">
                    <div class="clock-face">
                        <div class="hand hour-hand"></div>
                        <div class="hand min-hand"></div>
                        <div class="hand second-hand"></div>
                    </div>
                </div>
            </div>
            <div class="col-2" style="padding-top: 2px;">
                <h5 class="h5">Situation</h5>
                <p class="h6">
                    <?php
                            $respon = $_SESSION["admin"]["id"] ;
                            # cherche tous les projets à venir de l’admin connecté ;
                            $sql_count = "SELECT COUNT(projet.id) FROM agence.projet
                                          WHERE projet.etat = 'a_venir'
                                          AND projet.id_responsable = $respon;" ;
                            $sql_count = mysqli_query($conn,$sql_count) ;
                            $sql_count= mysqli_fetch_array($sql_count) ;
                            $a_venir = intval($sql_count['COUNT(projet.id)']) ;

                            $sql_count = "SELECT COUNT(projet.id) FROM agence.projet
                                          WHERE projet.etat = 'en_cours'
                                          AND projet.id_responsable = $respon ;" ;
                            $sql_count = mysqli_query($conn,$sql_count) ;
                            $sql_count= mysqli_fetch_array($sql_count) ;
                            $en_cours = intval($sql_count['COUNT(projet.id)']) ;
                            
                            echo $en_cours."&nbsp;projet(s) en cours,&nbsp;".$a_venir."&nbsp;&agrave; venir" ;
                    
                    ?> 

                </p>
                <p></p>
            </div>
        </header>
    </div>
</div>