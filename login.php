<body>
    <div class="tile is-ancestor">
    <div class="tile is-parent is is-vertical">
        <div class="tile box" style="margin:20%;padding-left:22%;">
            <a href="#" class="button is-rounded is-info is-outlined" data-izimodal-open="#modal" data-iziModal-transitionOut="fadeOutDown" data-izimodal-transitionin="fadeInDown">Se connecter</a>
            
            <a href="#" class="button is-rounded is-outlined is-info" data-izimodal-open="#another-modal"  data-izimodal-zindex="20000" data-izimodal-preventclose="">S’inscrire</a>
        </div>
        <div>
            <span><?php if(!empty($msg_err)){echo $msg_err ;} ?></span>
        </div>
    </div>
    </div>
    
  <!-- boite modale de connexion -->  
<div id="modal">
    <button class="button is-outlined is-danger" style="float: right;" data-izimodal-close="">x</button>
    <form class="message-body box" action="user.php" method="post">
        <fieldset>
            <table>
                <legend class="menu-label">Se connecter</legend>
                <tr>
                    <td><label for="username">Nom d’utilisateur :</label></td>
                    <td>
                        <input required type="text" name="username" id="username">
                    </td>
                </tr>
                <tr>
                    <td><label for="user_pwd">Mot de passe :</label></td>
                    <td><input required type="password" name="pwd" id="user_pwd"></td>
                </tr>
                <tr>
                    <td><input type="reset" class="button is-rounded is-outlined" value="Effacer"></td>
                    <td><input type="submit" class="button is-rounded is-outlined is-info" name="login" value="Se Connecter"></td>
                </tr> <br>
                <tr>
                    <td><span>Vous n’avez pas de compte ?</span></td>
                    <td><a href="#" data-izimodal-open="#another-modal"  data-izimodal-zindex="20000" data-izimodal-preventclose="">S’inscrire</a></td>
                </tr>
            </table>
        </fieldset>
    </form>
</div>
 

  <!-- boite modale d’inscription -->     
<div id="another-modal">
    <button class="button is-outlined is-danger" style="float: right;" data-izimodal-close="" data-izimodal-transitionout="bounceOutDown">x</button>

    <form class="message-body is-success box" action="register.php" method="post" >
        <fieldset>
            <table>
                <legend class="menu-label">S’inscrire</legend>
                <tr>
                    <td><label for="">Vous &ecirc;tes :</label></td>
                    <td>
                        <select name="statut" id="">
                            <option value="collaborateur">Collaborateur</option>
                            <option value="admin">Chef de Projet</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="nom">Nom :</label></td>
                    <td><input required type="text" name="nom" id="nom"></td>
                </tr>
                <tr>
                    <td><label for="prenom">Prenom :</label></td>
                    <td><input required type="text" name="prenom" id="prenom"></td>
                </tr>
                <tr>
                    <td><label for="tel">T&eacute;l&eacute;phone :</label></td>
                    <td><input type="tel" name="tel" id="tel"></td>
                </tr>
                <tr>
                    <td><label for="email">E-mail :</label></td>
                    <td><input required type="email" name="email" id="email"></td>
                </tr>
                <tr>
                    <td><label for="username">Nom d’utilisateur :</label></td>
                    <td><input required type="text" name="username" id="username"></td>
                </tr>
                <tr>
                    <td><label for="pwd">Mot de passe :</label></td>
                    <td><input required type="password" name="pwd" id="pwd"></td>
                </tr>
                <tr>
                    <td><input type="reset" class="button is-rounded is-outlined" value="Effacer"></td>
                    <td><input type="submit" class="button is-rounded is-outlined is-info" value="Soumettre"></td>
                </tr>
                <tr>
                    <td><span>Vous avez d&eacute;j&agrave; un compte ?</span></td>
                    <td><a data-izimodal-open="#modal" data-iziModal-transitionOut="fadeOutDown" data-izimodal-transitionin="fadeInDown">Se connecter</a></td>
                </tr>
            </table>
        </fieldset>
    </form>
 </div>

    


    <script src="./js/jquery-2.x-git.min.js"></script>
    <script src="./js/iziModal.js" type="text/javascript"></script>
    <script src="./js/modal.js" type="text/javascript"></script>
</body>

<?php include 'script-js.php'; ?>