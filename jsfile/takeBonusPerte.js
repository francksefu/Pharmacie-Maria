const dateP = document.querySelector('#date');
const produit = document.querySelector('#produit');
const produitVide = document.querySelector('#produitVide')
const quantiteGagne = document.querySelector('#quantite-gagne');
const quantiteGagneVide = document.querySelector('#quantiteGVide');
const quantitePerdu = document.querySelector('#quantite-perdu');
const quantitePerduVide = document.querySelector('#quantitePVide');
const motif = document.querySelector('#motif');

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
    xmlhttp.open("GET", "classBonusPete.php?q=" + str);
    xmlhttp.send();
    }
  }

  btn.addEventListener('click', () => {
    if (produit.value == '') {
      messageComplete(produitVide);
      return;
    } else {
      enleveMessage(produitVide)
    }

    if (quantiteGagne.value == '') {
      messageComplete(quantiteGagneVide);
      return;
    } else {
        enleveMessage(quantiteGagneVide)
    }

    if (quantitePerdu.value == '') {
      messageComplete(quantitePerduVide);
      return;
    } else {
      enleveMessage(quantitePerduVide)
    }

    let tab = produit.value.split('::');
    let idProduit = tab[1];
    let take;

    if (typeForm.value == 'update') {
        take = idProduit+"::"+quantiteGagne.value+"::"+quantitePerdu.value+"::"+motif.value+"::"+dateP.value+"::update";
    } else {
        take = idProduit+"::"+quantiteGagne.value+"::"+quantitePerdu.value+"::"+motif.value+"::"+dateP.value+"::add";
    }

    showHint(take);
  
    produit.value =""; 
    quantiteGagne.value = "0";
    quantitePerdu.value = "0";
    motif.value = "";
  });
