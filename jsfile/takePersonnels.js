// take all value inside input
const identifiantM = document.querySelector('#identifiantM');
const nomPersonnel = document.querySelector('#nomPersonnel');
const telephone = document.querySelector('#telephone');
const titre = document.querySelector('#titre');
const salaire = document.querySelector('#salaire');
const poste = document.querySelector('#poste');
const password = document.querySelector('#password');

const btn = document.querySelector('#envoie');

const nomVide = document.querySelector('#nomVide');
const passwordVide = document.querySelector('#PasswordVide');
const posteVide = document.querySelector('#PosteVide');
const telephoneVide = document.querySelector('#telephoneVide');


let feedback = '';
const compareFeedback = `<div class='alert alert-success' role='alert'>
Insertion fait avec success
</div>`;
const type = document.querySelector('#typeFormulaire');
let idPersonnel;
if (type.value === 'update') {
    identifiantM.addEventListener('change', () => {
      const tabValeur = identifiantM.value.split('::');
      nomPersonnel.value = tabValeur[3];
      telephone.value = tabValeur[5];
      idPersonnel = tabValeur[1];
      salaire.value = tabValeur[7];
      poste.value = tabValeur[9];
      password.value = tabValeur[11];
    })
    
  }

const messageComplete = valeur => {
  valeur.textContent = messageVide;
  valeur.style.color = 'red';
}

const enleveMessage = valeur => {
  valeur.textContent = '';
  valeur.style.color = 'balck';
}


const messageVide = 'Veuillez remplir ce champs svp';

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
      if (titre.value === 'data-personnel') {
        xmlhttp.open("GET", "classDataPersonnel.php?q=" + str);
      } else {
        xmlhttp.open("GET", "classPersonnels.php?q=" + str);
      }
    xmlhttp.send();
    }
  }
btn.addEventListener('click', () => {
  // Verifie si tous les champs sont rempli avant l envoie, sinon blocage
  if(nomPersonnel.value == ''){
    messageComplete(nomVide);
    return;
  } else {
    enleveMessage(nomVide);
  }

  if(poste.value == ''){
    messageComplete(posteVide);
    return;
  } else {
    enleveMessage(posteVide);
  }

  if(password.value == ''){
    messageComplete(passwordVide);
    return;
  } else {
    enleveMessage(passwordVide);
  }

  let prend;
  if (type.value == 'update') {
    prend = nomPersonnel.value+"::"+telephone.value+"::"+salaire.value+"::"+poste.value+"::"+password.value+"::"+idPersonnel+"::update";
  } else {
    prend =nomPersonnel.value+"::"+telephone.value+"::"+salaire.value+"::"+poste.value+"::"+password.value+"::add";
  }

  showHint(prend);
  
    nomPersonnel.value =""; 
    telephone.value = "";
    salaire.value = "";
    poste.value = "";
    password.value = "";
   identifiantM.value = "";
    
});