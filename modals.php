<!-- all the modal boxes are here -->
<!-- la soumission de certains formulaires est faite avec AJAX, 
      voir la fonction correspondante dans main.js -->
<!-- boite modale d’ajout de phase -->
<div id="nouv-phase"> 
    <header class="modal-card-head">
        <p class="modal-card-title">Phase</p>
    </header>
    <center>
        <form class="box">
            <fieldset>
                <table>
                    <legend>Ajouter une nouvelle phase &agrave; ce projet</legend>
                    <tr><span class="has-text-danger">*</span> Obligatoire</tr>
                    <tr>
                        <td><label for="nom_phase">Nom phase :</label></td>
                        <td>
                            <input required type="text" name="nom_phase" id="nom_phase" placeholder="donnez un nom &agrave; la phase">
                            <span class="has-text-danger">*</span>
                        </td>
                    </tr>
                    <tr>
                        <td><button class="button is-small is-rounded" data-izimodal-close="" >Annuler</button>
                        <td><button onclick="nouvPhase()" class="button is-small is-rounded is-info">Insérer</button>
                    </tr> 
                </table>
            </fieldset>
        </form>
    </center>
</div>

<!-- boite modale de création de projet -->
<div id="nouv-proj"> 
    <header class="modal-card-head">
        <p class="modal-card-title">Projet</p>
        <button class="delete" data-izimodal-close="" ></button>
    </header>
    <center>
        <form class="box message-body" action="nouv_proj.php" method="post">
            <fieldset>
                <table>
                    <legend>Cr&eacute;er un nouveau projet</legend>
                    <tr><span class="has-text-danger">*</span> Obligatoire</tr>
                    <tr>
                        <td><label for="type_projet">Type :</label></td>
                        <td>
                            <input required type="text" name="type_projet">
                            <span class="has-text-danger">*</span>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="nom_projet">Nom :</label></td>
                        <td>
                            <input required type="text" name="nom_projet">
                            <span class="has-text-danger">*</span>
                        </td>
                    </tr>
                    <tr><span class="error"><?php?></span></tr>
                    <tr>
                        <td><label for="etat_projet">Etat :</label></td>
                        <td>
                            <select required name="etat_projet">
                                <option value="a_venir">&agrave; venir</option>
                                <option value="en_cours">en cours</option>
                                <option value="termine">termin&eacute;</option>
                            </select>
                            <span class="has-text-danger">*</span>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="delai">D&eacute;lai :</label></td>
                        <td>
                            <input required type="date" name="delai">
                            <span class="has-text-danger">*</span>
                        </td>
                    </tr>
                    <tr><span class="error"><?php?></span></tr>
                    <tr>
                        <td><label for="collab_tache">Maitre d’ouvrage :</label></td>
                        <td>
                            <select name="m_ouvrage">
                                <option>Choisir</option>
                            <?php 
                                $sql_choice = "SELECT * FROM agence.client ;" ;
                                $sql_choice = mysqli_query($conn,$sql_choice);
                                
                                while ($choice = mysqli_fetch_array($sql_choice,MYSQLI_ASSOC)) {
                                
                            ?>
                                <option value="<?php echo $choice['id']; ?>"><?php echo $choice['nom'] ;?></option>
                            <?php } ?>
                            </select>
                            <span class="has-text-danger">*</span>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="reset" class="button is-small is-rounded" value="Effacer tout"></td>
                        <td><input type="submit" class="button is-small is-rounded is-info" value="Créer"></td>
                    </tr> <br>
                </table>
            </fieldset>
        </form>
    </center>
</div>

<!-- boite modale d’ajout de client-->
<div id="nouv-cli"> 
    <header class="modal-card-head">
        <p class="modal-card-title">Client</p>
        <button class="delete" data-izimodal-close="" ></button>
    </header>
    <form class="box message-body" action="nouv_client.php" method="post">
        <fieldset>
        <table>
            <legend>Ins&eacute;rer un nouveau client</legend>
            <tr><span class="has-text-danger">*</span> Obligatoire</tr>
            <tr>
                <td><label for="nom_client">Nom :</label></td>
                <td>
                    <input required type="text" name="nom_client">
                    <span class="has-text-danger">*</span>
                </td>
            </tr>
            <tr><span class="error"><?php?></span></tr>
            <tr>
                <td><label for="statut_client">Statut :</label></td>
                <td><input type="text" name="statut_client" ></td>
            </tr>
            <tr>
                <td><label for="tel_client">Tel :</label></td>
                <td><input type="tel" name="tel_client" ></td>
            </tr>
            <tr>
                <td><label for="email_client">Email :</label></td>
                <td>
                    <input required type="email" name="email_client">
                    <span class="has-text-danger">*</span>
                </td>
            </tr>
            <tr>
                <td><input type="reset" class="button is-small is-rounded" value="Effacer tout"></td>
                <td><input type="submit" class="button is-small is-rounded is-info" value="Insérer"></td>
            </tr> <br>
        </table>
        </fieldset>
    </form>
</div>

<!-- boite modale d’ajout de chef de projet à un collaborateur::désactivé -->
<!-- <div id="nouv-collab"> 
    <header class="modal-card-head">
        <p class="modal-card-title">Collaborateur</p>
    </header>
    <center>
        <form class="box message-body">
            <fieldset>
                <table>
                    <legend>Ajouter un collaborateur</legend>
                    <tr><span class="has-text-danger">*</span> Obligatoire</tr>
                    <tr>
                        <td><label for="collab_tache">Collaborateur :</label></td>
                        <td>
                            <select id="add_collab">
                                <option>Choisir</option>
                            <?php 
                                $sql_choice = "SELECT * FROM agence.collaborateur ;" ;
                                $sql_choice = mysqli_query($conn,$sql_choice);
                                
                                while ($choice = mysqli_fetch_array($sql_choice,MYSQLI_ASSOC)) {
                                
                            ?>
                                <option value="<?php echo $choice['id']; ?>"><?php echo $choice['prenom'].'&nbsp;'.$choice['nom'] ;?></option>
                            <?php } ?>
                            </select>
                            <span class="has-text-danger">*</span>
                        </td>
                    </tr>
                
                    <tr>
                        <td><button class="button is-small is-rounded" data-izimodal-close="" >Annuler</button></td>
                        <td><button onclick="addCollab()" class="button is-small is-rounded is-info">Insérer</button>
                    </tr> <br>
                </table>
            </fieldset>
        </form>
    </center>
</div>  -->

<!-- boite modale de gestion de tâches par l’administrateur -->
<div id="manage-tache">
    <header class="modal-card-head">
        <p class="modal-card-title">T&acirc;che</p>
        <button class="delete" data-izimodal-close=""></button>
    </header>
    <center>
        <form>
            <fieldset>
                <table>
                    <legend>Changer de collaborateur</legend>
                    <tr><span class="has-text-danger">*</span> Obligatoire</tr>
                    <tr>
                        <td><label for="collab_tache">Collaborateur :</label></td>
                        <td>
                            <select  id="new_collab">
                                <option>Choisir</option>
                            <?php 
                                $sql_choice = "SELECT * FROM agence.collaborateur ;" ;
                                $sql_choice = mysqli_query($conn,$sql_choice);
                                
                                while ($choice = mysqli_fetch_array($sql_choice,MYSQLI_ASSOC)) {
                                
                            ?>
                                <option value="<?php echo $choice['id']; ?>"><?php echo $choice['prenom'].'&nbsp;'.$choice['nom'] ;?></option>
                            <?php } ?>
                            </select>
                            <span class="has-text-danger">*</span>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="reset" class="button is-small is-rounded" value="Effacer tout"></td>
                        <td><button onclick="updateTache()" class="button is-small is-rounded is-info">Insérer</button></td>
                    </tr> <br>
                </table>
            </fieldset>
        </form>
        <hr width="80%" align="center">
        <form >
            <fieldset>
                <table>
                    <legend>D&eacute;crire cette t&acirc;che</legend> <br>
                    <tr><label for="description"></label></tr>
                    <tr><textarea wrap="" placeholder="D&eacute;crire ici.." id="description" name="description" rows="4" cols="50" required></textarea></tr>
                    <br>
                    <tr>
                        <button type="reset" class="button is-small is-rounded">Effacer tout</button>
                    </tr>
                    <tr>
                        <button onclick="updateTacheDescrip()" class="button is-small is-rounded is-success"><i class="fas fa-paper-plane"></i></button>
                    </tr> 
                </table>
            </fieldset>
        </form><br>
        <hr width="80%" align="center">
        <form>
            <fieldset>
                <table>
                    <legend>Supprimer cette t&acirc;che</legend>
                    <tr>
                        <span class="has-text-danger">Attention ! Cette op&eacute;ration est irr&eacute;versible</span> <br>
                    <tr>
                        <td><button class="button is-small is-rounded" data-izimodal-close="" >Annuler</button></td>
                        <td><button onclick="deleteTache()" class="button is-small is-rounded is-danger">Supprimer</button></td>
                    </tr> <br>
                </table>
            </fieldset>
        </form> <br>
    </center>
</div>

<!-- boite modale de gestion de tâches par le collaborateur -->
<div id="gestion-tache">
    <header class="modal-card-head">
        <p class="modal-card-title">T&acirc;che</p>
        <button class="delete" data-izimodal-close=""></button>
    </header>
    <center>
        <form>
            <fieldset>
                <table>
                    <legend><i class="fas fa-edit">G&eacute;rer</i></legend><br>
                    <button class="button is-info is-outlined" onclick="updateTacheState(this)" value="en_attente"><i class="fas fa-stopwatch"></i>Attendre</button>
                    <button class="button is-warning is-outlined" onclick="updateTacheState(this)" value="en_cours"><i class="fas fa-hourglass-start"></i>D&eacute;marrer</button>
                    <button class="button is-success is-outlined" onclick="updateTacheState(this)" value="termine"><i class="fas fa-hourglass-end"></i>Terminer</button>
                </table>
            </fieldset>
        </form>
        <hr width="80%" align="center">
        <form >
            <fieldset>
                <table>
                    <legend><i class="fas fa-bullhorn"> Signaler cette t&acirc;che</i></legend> <br>
                    <tr><label for="observation"></label></tr>
                    <tr><textarea wrap="" placeholder="D&eacute;crivez le probl&egrave;me ici.." id="observation" name="observation" rows="4" cols="50" required></textarea></tr>
                    <br>
                    <tr>
                        <button type="reset" class="button is-small is-rounded">Effacer tout</button>
                    </tr>
                    <tr>
                        <button onclick="updateTacheObs()" class="button is-small is-rounded is-success"><i class="fas fa-paper-plane"></i></button>
                    </tr> 
                </table>
            </fieldset>
        </form><br>
    </center>
</div>

<!-- boite modale d’ajout de tâches -->
<div id="nouv-tache">
    <header class="modal-card-head">
        <p class="modal-card-title">T&acirc;che</p>
        <button class="delete" data-izimodal-close=""></button>
    </header>
    <center>
        <form class="box">
            <fieldset>
                <table>
                    <legend>Ajouter une nouvelle t&acirc;che</legend>
                    <tr><span class="has-text-danger">*</span> Obligatoire</tr>
                    <tr>
                        <td><label for="nom_tache">Nom t&acirc;che :</label></td>
                        <td>
                            <input required type="text" id="nom_tache">
                            <span class="has-text-danger">*</span>
                        </td>
                    </tr>
                    <tr><span class="error"><?php?></span></tr>
                    <tr>
                        <td><label for="collab_tache">Collaborateur :</label></td>
                        <td>
                            <select  id="selected">
                                <option>Choisir</option>
                            <?php 
                                $sql_choice = "SELECT * FROM agence.collaborateur ;" ;
                                $sql_choice = mysqli_query($conn,$sql_choice);
                                
                                while ($choice = mysqli_fetch_array($sql_choice,MYSQLI_ASSOC)) {
                                
                            ?>
                                <option value="<?php echo $choice['id']; ?>"><?php echo $choice['prenom'].'&nbsp;'.$choice['nom'] ;?></option>
                            <?php } ?>
                            </select>
                            <span class="has-text-danger">*</span>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="reset" class="button is-small is-rounded" value="Effacer tout"></td>
                        <td><button onclick="nouvTache()" class="button is-small is-rounded is-info">Insérer</button></td>
                    </tr> <br>
                </table>
            </fieldset>
        </form>
    </center>
</div>

<!-- boite modale de gestion de délai -->
<div id="delai">
    <center>
        <form class="box">
            <fieldset>
                <table>
                    <legend>Changer le d&eacute;lai de ce projet</legend>
                    <tr><span class="has-text-danger">*</span> Obligatoire</tr>
                    <tr>
                        <td><label for="new_delai">Nouveau d&eacute;lai :</label></td>
                        <td>
                            <input required type="date" name="new_delai" id="new_delai">
                            <span class="has-text-danger">*</span>
                        </td> <br>
                    </tr>
                    <tr>
                        <td>
                            <button class="button is-small is-rounded" data-izimodal-close="" >Annuler</button>
                        </td>
                        <td>
                            <button onclick="setDelai()" class="button is-small is-rounded is-info">Changer</button>
                        </td> 
                    </tr>
                </table>
            </fieldset>
        </form>
    </center>
</div>


<!-- début boites modales programmation de projet: à venir, en cours, terminés -->
<div id="program">
    <center>
        <form class="box">
            <fieldset>
                <table>
                    <legend class="has-text-centered">Voulez-vous reprogrammer ce projet ?</legend> <br>
                    <tr>
                        <button class="button is-rounded" data-izimodal-close="" >Annuler</button>
                    </tr>
                    <tr>
                        <button onclick="progProj()" class="button is-rounded is-info">Confirmer</button>
                    </tr> <br> 
                </table>
            </fieldset>
        </form>
    </center>
</div>
<div id="start">
    <center>
        <form class="box">
            <fieldset>
                <table>
                    <legend class="has-text-centered">Voulez-vous d&eacute;marrer ce projet ?</legend> <br>
                    <tr>
                        <button class="button is-rounded" data-izimodal-close="" >Annuler</button>
                    </tr>
                    <tr>
                        <button onclick="startProj()" class="button is-rounded is-warning">Confirmer</button>
                    </tr> <br> 
                </table>
            </fieldset>
        </form>
    </center>
</div>
<div id="end">
    <center>
        <form class="box">
            <fieldset>
                <table>
                    <legend class="has-text-centered">Voulez-vous terminer ce projet ?</legend> <br>
                    <tr>
                        <button class="button is-rounded" data-izimodal-close="" >Annuler</button>
                    </tr>
                    <tr>
                        <button onclick="endProj()" class="button is-rounded is-success">Confirmer</button>
                    </tr> <br> 
                </table>
            </fieldset>
        </form>
    </center>
</div>
<!-- fin boites modal programmation de projet: à venir, en cours, terminés -->


<!-- boite modale de suppression de phase -->
<div id="delete-phase">
    <center>
        <form class="box">
            <fieldset>
                <table>
                    <legend>Supprimer cette phase</legend>
                    <tr>
                        <span class="has-text-danger">Attention ! Cette op&eacute;ration est irr&eacute;versible</span> <br>
                        <span class="has-text-danger">Les t&acirc;ches affect&eacute;es seront aussi supprim&eacute;es</span>
                    <tr>
                        <td><button class="button is-small is-rounded" data-izimodal-close="" >Annuler</button></td>
                        <td><button onclick="deletePhase()" class="button is-small is-rounded is-danger">Supprimer</button></td>
                    </tr> <br> 
                </table>
            </fieldset>
        </form>
    </center>
</div>

<!-- boite modale de suppression de projet -->
<div id="delete">
    <center>
        <form class="box">
            <fieldset>
                <table>
                    <legend>Supprimer ce projet</legend>
                    <tr><span class="has-text-danger">Attention ! Cette op&eacute;ration est irr&eacute;versible</span></tr>
                    <tr>
                        <td><button class="button is-small is-rounded" data-izimodal-close="" >Annuler</button></td>
                        <td><button onclick="deleteProj()" class="button is-small is-rounded is-danger">Supprimer</button></td>
                    </tr> <br> 
                </table>
            </fieldset>
        </form>
    </center>
</div>

<!--débu boite modale de suppression de client -->
<div id="delete-client">
    <center>
        <form class="box">
            <fieldset>
                <table>
                    <legend>Supprimer ce client</legend>
                    <tr><span class="has-text-danger">Attention ! Cette op&eacute;ration est irr&eacute;versible</span></tr> <br>
                    <tr>
                        <button class="button is-small is-rounded" data-izimodal-close="" >Annuler</button>
                    </tr>
                    <tr>
                        <button onclick="deleteClient()" class="button is-small is-rounded is-danger">Supprimer</button>
                    </tr> 
                </table>
            </fieldset>
        </form>
    </center>
</div>
<div id="not-delete-client">
    <center>
        <form class="box">
            <fieldset>
                <table>
                    <legend>Supprimer un client</legend> <br>
                    <th style="color:red">Vous ne pouvez pas supprimer ce client car il a un projet en cours</th>
                </table>
            </fieldset>
        </form>
    </center>
</div>
<!-- fin boite modale de suppression de client -->


<!-- début boites modales de suppression de collaborateur -->
<div id="delete-collab">
    <center>
        <form class="box">
            <fieldset>
                <table>
                    <legend>Supprimer ce collaborateur</legend>
                    <tr><span class="has-text-danger">Attention ! Cette op&eacute;ration est irr&eacute;versible</span></tr> <br>
                    <tr>
                        <button class="button is-small is-rounded" data-izimodal-close="" >Annuler</button>
                    </tr>
                    <tr>
                        <button onclick="deleteCollab()" class="button is-small is-rounded is-danger">Supprimer</button>
                    </tr> 
                </table>
            </fieldset>
        </form>
    </center>
</div>
<div id="not-delete-collab">
    <center>
        <form class="box">
            <fieldset>
                <table>
                    <legend>Supprimer un client</legend> <br>
                    <th style="color:red">Vous ne pouvez pas supprimer ce collaborateur car il a une t&acirc;che en cours de r&eacute;alisation</th>
                </table>
            </fieldset>
        </form>
    </center>
</div>
<!-- fin boites modales de suppression de collaborateur -->

<!--début boites modales de gestion de tâches de collaborateur -->
<div id="alert-tache">
   <center>
        <form class="box">
            <fieldset>
                <table>
                    <legend>D&eacute;crivez le probl&egrave;me</legend> <br>
                    <tr><label for="observation"></label></tr>
                    <tr><textarea wrap="" placeholder="&eacute;crire ici.." name="observation" rows="4" cols="50" required></textarea></tr>
                    <br>
                    <tr>
                        <button class="button is-small is-rounded" data-izimodal-close="" >Annuler</button>
                    </tr>
                    <tr>
                        <button class="button is-small is-rounded is-success"><i class="fas fa-paper-plane"></i></button>
                    </tr> 
                </table>
            </fieldset>
        </form>
    </center>
</div>
<div id="obs-tache">
    <center>
        <form class="box">
            <fieldset>
                <table class="table table-borderless">
                    <legend>Description du probl&egrave;me</legend> <br>
                    <tr class="has-text-danger-light">
                        <?php 

                            echo $tache['observation'] ;
                        ?>
                    </tr>
                </table>
            </fieldset>
        </form>
    </center>
</div>
<!-- fin boites modales de gestion de tâches de collaborateur -->
