// take all value inside input
const identifiantM = document.querySelector('#identifiantM');
const nomPersonnel = document.querySelector('#nomPersonnel');
const telephone = document.querySelector('#telephone');
const titre = document.querySelector('#titre');

const adresse = document.querySelector('#adresse');
const code_postale = document.querySelector('#code_postale');
const email = document.querySelector('#email');

const btn = document.querySelector('#envoie');

const nomVide = document.querySelector('#nomVide');
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
      adresse.value = tabValeur[7];
      code_postale.value = tabValeur[9];
      email.value = tabValeur[11];
      idPersonnel = tabValeur[1];
      
    })
    
  }

const messageComplete = valeur => {
  valeur.textContent = messageVide;
  valeur.style.color = 'red';
}

const enleveMessage = valeur => {
  valeur.textContent = '';
  valeur.style.color = 'black';
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
      
        xmlhttp.open("GET", "classPersonnels.php?q=" + str);
      
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

 

  let prend;
  if (type.value == 'update') {
    prend = nomPersonnel.value+"::"+telephone.value+"::"+adresse.value+"::"+code_postale.value+"::"+email.value+"::"+idPersonnel+"::update";
  } else {
    prend =nomPersonnel.value+"::"+telephone.value+"::"+adresse.value+"::"+code_postale.value+"::"+email.value+"::add";
  }

  showHint(prend);
  
    nomPersonnel.value =""; 
    telephone.value = "";
    adresse.value = "";
    code_postale.value = "";
    email.value = "";
    
   identifiantM.value = "";
    
});