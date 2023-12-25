// take all value inside inputs
const identifiantM = document.querySelector('#identifiantM')
const dates = document.querySelector('#date');
const facture = document.querySelector('#facture');
const factureVide = document.querySelector('#factureVide');
const montant = document.querySelector('#montant');
const stock = document.querySelector('#stock');

const montantVide = document.querySelector('#montantVide')

const btn = document.querySelector('#envoi');

let feedback = '';
const compareFeedback = `<div class='alert alert-success' role='alert'>
Insertion fait avec success
</div>`; 
const typeForm = document.querySelector('#typeFormulaire');
let idPaiements;
if (typeForm.value == 'update') {
  identifiantM.addEventListener('change', () => {
    const tabValeur = identifiantM.value.split('::');
   dates.value = tabValeur[13]
    facture.value = `ID ::${tabValeur[3]}:: Date ::${tabValeur[9]}:: client ::${tabValeur[5]}:: total = ::${tabValeur[7]}:: montant deja payé =::${tabValeur[15]}`;
    montant.value = tabValeur[11];
    idPaiements = tabValeur[1];
  });
}
const messageVide = 'Veuillez remplir ce champs svp'
const messageComplete = valeur => {
    valeur.textContent = messageVide;
    valeur.style.color = 'red';
  }

  const messageError = (valeur, messageVide) => {
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
    xmlhttp.open("GET", "classPaiements.php?q=" + str);
    xmlhttp.send();
    }
  }

btn.addEventListener('click', () => {
    if(facture.value == ''){
        messageComplete(factureVide);
        return;
    } else {
        enleveMessage(factureVide);
    }
  
      if(montant.value == ''){
        messageComplete(montantVide);
        return;
      } else {
        enleveMessage(montantVide);
      }
     const total_facture = facture.value.split('::')[7];
     const montant_deja_paye = facture.value.split('::')[9];

     if((((montant.value*1) + (montant_deja_paye*1)) > total_facture) && typeForm.value == "add"){
        messageError(montantVide, 'le montant superieur au total de la facture');
        return;
      } else {
        enleveMessage(montantVide);
      }
      
  // prendre uniquement les id
  let operation = facture.value.split('::')[1];
  let prend;
  if (typeForm.value == 'update') {
    prend = dates.value+"::"+montant.value+"::"+operation+"::"+stock.value+"::"+idPaiements+"::update";
  } else {
    prend = dates.value+"::"+montant.value+"::"+operation+"::"+stock.value+"::add";
  }
 
  showHint(prend);
    montant.value = "";
    facture.value = "";
    identifiantM.value = "";
});