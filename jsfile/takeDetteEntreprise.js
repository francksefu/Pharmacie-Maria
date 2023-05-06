const dateP = document.querySelector('#date');
const choisir = document.querySelector('#choisir');
const valeur = document.querySelector('#valeur')
const valeurVide = document.querySelector('#valeurVide');
const motif = document.querySelector('#motif');
const montant = document.querySelector('#montant');
const montantVide = document.querySelector('#montantVide');

const typeForm = document.querySelector('#typeFormulaire');
const btn = document.querySelector('#envoi');

const messageVide = 'Veuillez remplir ce champs svp'
const messageComplete = valeur => {
    valeur.textContent = messageVide;
    valeur.style.color = 'red';
  }

  const enleveMessage = valeur => {
    valeur.textContent = '';
    valeur.style.color = 'black';
  }

  function showHint(str) {
    if (str.length == 0) {
      document.getElementById("txtHint").innerHTML = "";
      return;
    } else {
      const xmlhttp = new XMLHttpRequest();
      xmlhttp.onload = function() {
        //feedback = this.responseText;
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    xmlhttp.open("GET", "classDetteEntreprise.php?q=" + str);
    xmlhttp.send();
    }
  }

  btn.addEventListener('click', () => {
    if (valeur.value == '') {
      messageComplete(valeurVide);
      return;
    } else {
      enleveMessage(valeurVide)
    }

    if (montant.value == '') {
      messageComplete(montantVide);
      return;
    } else {
        enleveMessage(montantVide)
    }

    if (typeForm.value == 'update') {
        take = choisir.value+"::"+valeur.value+"::"+montant.value+"::"+(valeur.value - montant.value)+"::"+motif.value+"::"+dateP+"::update";
    } else {
      take = choisir.value+"::"+valeur.value+"::"+montant.value+"::"+(valeur.value - montant.value)+"::"+motif.value+"::"+dateP+"::update";
    }

    showHint(take);
  
    valeur.value = "0";
    montant.value = "0";
    motif.value = "";
  });
