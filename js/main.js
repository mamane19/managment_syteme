

// date 
var dt = new Date();

var mois = ["janvier","Février","mars","avril","mai ","juin","juillet","août","septembre","octobre","novembre","décembre"];

var jours = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];

document.getElementById("temps").innerHTML = jours[dt.getDay()]+" "+dt.getDate()+" "+mois[dt.getMonth()]+" "+dt.getFullYear() ;

// get the id of the clicked element and use AJAX to send data to the server in order to do some changes ;
var id ;
function getId(proj) {
  id = proj.getAttribute("data-id") ;
  id = parseInt(id) ;
}
/* ====================================Projets======================== */
function deleteProj() {
   
  let xhttp = new XMLHttpRequest();
  
  xhttp.open("GET", "//webapp/admin/projets/delete-proj.php?id="+id);
  xhttp.send();
  
}
function endProj() {
  let xhttp = new XMLHttpRequest();
  
  xhttp.open("GET", "//webapp/admin/projets/end-proj.php?id="+id);
  xhttp.send();
}
function startProj() {
  let xhttp = new XMLHttpRequest();
  
  xhttp.open("GET", "//webapp/admin/projets/start-proj.php?id="+id);
  xhttp.send();
}
function progProj() {
  let xhttp = new XMLHttpRequest();
  
  xhttp.open("GET", "//webapp/admin/projets/prog-proj.php?id="+id);
  xhttp.send();
}
function setDelai(){
  let xhttp = new XMLHttpRequest();
  let delai = document.getElementById("new_delai").value ;
  //delai = Date.parse(delai) ;
  xhttp.open("GET", "//webapp/admin/projets/set-delai.php?id="+id+"&delai="+delai);
  xhttp.send();
}

/*=================================Phase================================ */
function nouvPhase(){
  let xhttp = new XMLHttpRequest();
  
  let phase = document.getElementById("nom_phase").value ;

  xhttp.open("GET", "//webapp/admin/phase/nouv-phase.php?id="+id+"&nom="+phase);
  xhttp.send();
}
function deletePhase(){
  let xhttp = new XMLHttpRequest();

  xhttp.open("GET", "//webapp/admin/phase/delete-phase.php?id="+id);
  xhttp.send();
}

/* =================================Tâche============================= */
/* var id_collab ;
function collabTache(selected) {
  id_collab = selected.getAttribute("value") ;
  id_collab = parseInt(id_collab) ;
  alert(id_collab) ;
} */
function nouvTache(){
  let xhttp = new XMLHttpRequest();
  
  let tache = document.getElementById("nom_tache").value ;
  let id_collab = document.getElementById("selected").value ;
  
  id_collab = parseInt(id_collab) ;
  
  xhttp.open("GET", "//webapp/admin/tache/nouv-tache.php?phase_tache="+id+"&collab_tache="+id_collab+"&nom_tache="+tache);
  xhttp.send();
}
function updateTache(){
  let xhttp = new XMLHttpRequest();
  
  let collab = document.getElementById("new_collab").value ;
    
  collab = parseInt(collab) ;
  
  xhttp.open("GET", "//webapp/admin/tache/update-tache.php?tache="+id+"&collab="+collab);
  xhttp.send();
}
function updateTacheDescrip() {
  let comment = document.getElementById("description").value ;
  
  let xhttp = new XMLHttpRequest();
  
  xhttp.open("GET", "//webapp/admin/tache/descrip-tache.php?tache="+id+"&comment="+comment);
  xhttp.send();
}
function deleteTache(){
  let xhttp = new XMLHttpRequest();
    
  xhttp.open("GET", "//webapp/admin/tache/delete-tache.php?tache="+id);
  xhttp.send();
}
/* =================================Client================================= */
function deleteClient(){
  let xhttp = new XMLHttpRequest();
  
  xhttp.open("GET", "//webapp/admin/clients/delete-client.php?client="+id);
  xhttp.send();
}
/* ===============================Admin::Collab();============================= */
function deleteCollab(){
  let xhttp = new XMLHttpRequest();
  
  xhttp.open("GET", "//webapp/admin/collaborateurs/delete-collab.php?collab="+id);
  xhttp.send();
}

/* function addCollab() {
  let id_collab = document.getElementById("add_collab").value ;
  id_collab = parseInt(id_collab) ;

  let xhttp = new XMLHttpRequest();
  
  xhttp.open("GET", "nouv_collab.php?collab="+id_collab+"&respon="+id);
  xhttp.send();
} */

/* ============================= Collab::Collab() ; */
function updateTacheState(btn) {
  let etat = btn.getAttribute("value") ;
  
  let xhttp = new XMLHttpRequest();
  
  xhttp.open("GET", "../collab/collab-update-tache.php?tache="+id+"&etat="+etat);
  xhttp.send();
}

function updateTacheObs() {
  let comment = document.getElementById("observation").value ;
  
  let xhttp = new XMLHttpRequest();
  
  xhttp.open("GET", "../collab/collab-alert-tache.php?tache="+id+"&comment="+comment);
  xhttp.send();
}

