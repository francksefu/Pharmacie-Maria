// take all value inside inputs
const identifiantM = document.querySelector('#identifiantM')
const chilling = document.querySelector('#chilling');
const rwandais = document.querySelector('#rwandais');
const cdf = document.querySelector('#cdf');

const chillingVide = document.querySelector('#chillingVide');
const rwandaisVide = document.querySelector('#rwandaisVide');
const cdfVide = document.querySelector('#cdfVide')

const btn = document.querySelector('#envoie');

let feedback = '';
const compareFeedback = `<div class='alert alert-success' role='alert'>
Insertion fait avec success
</div>`; 
const typeForm = document.querySelector('#typeFormulaire');
let idChange;
if (1) {
  identifiantM.addEventListener('change', () => {
    const tabValeur = identifiantM.value.split('::');
    cdf.value = tabValeur[7];
    chilling.value = tabValeur[3];
    rwandais.value = tabValeur[5];
    idChange = tabValeur[1];
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
    xmlhttp.open("GET", "classTaux.php?q=" + str);
    xmlhttp.send();
    }
  }

btn.addEventListener('click', () => {
      if(chilling.value == ''){
        messageComplete(chillingVide);
        return;
      } else {
        enleveMessage(chillingVide);
      }

      if(rwandais.value == ''){
        messageComplete(rwandaisVide);
        return;
      } else {
        enleveMessage(rwandaisVide);
      }

      if(cdf.value == ''){
        messageComplete(cdfVide);
        return;
      } else {
        enleveMessage(cdfVide);
      }
  // prendre uniquement les id
  
  let prend;
  if (typeForm.value == 'update') {
    prend = idChange+"::"+chilling.value+"::"+rwandais.value+"::"+cdf.value+"::update";
  }

  showHint(prend);
    chilling.value = "";
    rwandais.value = "";
    cdf.value = "";
    identifiantM.value = "";
});