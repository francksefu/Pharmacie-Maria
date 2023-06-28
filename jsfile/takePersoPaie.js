// take all value inside inputs
const identifiantM = document.querySelector('#identifiantM')
const datesout = document.querySelector('#datesout');
const type = document.querySelector('#type');
const montant = document.querySelector('#montant');
const motif = document.querySelector('#commentaire');
const personnel = document.querySelector('#nom');
const montantVide = document.querySelector('#montantVide')
let idDataPersonnel ='';
const btn = document.querySelector('#envoie');

let feedback = '';
const compareFeedback = `<div class='alert alert-success' role='alert'>
Insertion fait avec success
</div>`; 
const typeForm = document.querySelector('#typeFormulaire');
let idCaisse;
if (typeForm.value == 'update') {
  identifiantM.addEventListener('change', () => {
    const tabValeur = identifiantM.value.split('::');
    datesout.value = tabValeur[3];
    type.value = tabValeur[9];
    montant.value = tabValeur[7];
    motif.value = tabValeur[13];
    idCaisse = tabValeur[1];
    nom.value = `ID::${tabValeur[11]}:: Nom ::${tabValeur[5]}:: Telephone::${tabValeur[15]}`;
    idDataPersonnel = nom.value.split('::')[1];
  });
}
const messageVide = 'Veuillez remplir ce champs svp'
const messageComplete = valeur => {
    valeur.textContent = messageVide;
    valeur.style.color = 'red';
  }

  const enleveMessage = valeur => {
    valeur.textContent = '';
    valeur.style.color = 'balck';
  }
// Use ajax to insere it in the BD (communication with CRUD file)

function showHint(str) {
    if (str.length == 0) {
      document.getElementById("txtHint").innerHTML = "";
      return;
    } else {
      const xmlhttp = new XMLHttpRequest();
      xmlhttp.onload = function() {
        feedback = this.responseText;
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    xmlhttp.open("GET", "classPersoPaie.php?q=" + str);
    xmlhttp.send();
    }
  }

btn.addEventListener('click', () => {
    
   
      if(montant.value == ''){
        messageComplete(montantVide);
        return;
      } else {
        enleveMessage(montantVide);
      }
  // prendre uniquement les id
  idDataPersonnel = nom.value.split('::')[1];
  let prend;
  if (typeForm.value == 'update') {
    prend = montant.value+"::"+motif.value+"::"+type.value+"::"+datesout.value+"::"+idDataPersonnel+"::"+idCaisse+"::update";
  } else {
    prend = montant.value+"::"+motif.value+"::"+type.value+"::"+datesout.value+"::"+idDataPersonnel+"::add";
  }
  
  showHint(prend);
    montant.value = "";
    motif.value = "";
    identifiantM.value = "";
    nom.value = "";
});